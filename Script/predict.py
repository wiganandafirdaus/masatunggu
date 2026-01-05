import sys
import json
from pathlib import Path

import pandas as pd
import joblib


# Folder: storage/app/ml
BASE_DIR = Path(__file__).resolve().parent
MODEL_PATH = BASE_DIR / "model.joblib"
FEATURES_PATH = BASE_DIR / "feature_cols.json"  # opsional tapi direkomendasikan


# Mapping: kolom Laravel/DB -> kolom fitur model (sesuai notebook Anda)
KEY_MAP = {
    "masa_studi": "Masa_Studi",
    "provinsi": "Provinsi",
    "prodi": "Prodi",
    "ipk": "IPK",
    "toefl": "Toefl",
    "jenis_kelamin": "Jenkel",
    "sskm": "SSKM",
    "nilai_kp": "N_KP",
    "nilai_ta": "N_TA",
    "magang": "Magang",
    "masa_carikerja": "Masa_carikerja",
    "jml_lamaran": "Jml_Lamaran",
}

# Default feature cols (fallback jika feature_cols.json tidak ada)
DEFAULT_FEATURE_COLS = [
    "Masa_Studi",
    "Provinsi",
    "Prodi",
    "IPK",
    "Toefl",
    "Jenkel",
    "SSKM",
    "N_KP",
    "N_TA",
    "Magang",
    "Masa_carikerja",
    "Jml_Lamaran",
]

# Untuk normalisasi grade (notebook: ["E","D","C","C+","B","B+","A"])
GRADE_ALIAS = {
    "AB": "B+",
    "BA": "B+",
    "BC": "C+",
    "CB": "C+",
}


def read_input() -> dict:
    if len(sys.argv) > 1:
        # baca dari file
        with open(sys.argv[1], 'r', encoding='utf-8') as f:
            return json.load(f)
    else:
        # baca dari stdin
        raw = sys.stdin.read()
        if not raw.strip():
            raise ValueError("Input kosong. Kirim JSON via stdin.")
        return json.loads(raw)


def load_feature_cols() -> list:
    if FEATURES_PATH.exists():
        cols = json.loads(FEATURES_PATH.read_text(encoding="utf-8"))
        if isinstance(cols, list) and cols:
            return cols
    return DEFAULT_FEATURE_COLS


def to_number(x):
    """Konversi aman untuk angka, toleran '3,45' -> 3.45."""
    if x is None:
        return None
    if isinstance(x, (int, float)):
        return x
    if isinstance(x, str):
        s = x.strip().replace(",", ".")
        if s == "":
            return None
        try:
            # prefer int jika memungkinkan
            if s.isdigit() or (s.startswith("-") and s[1:].isdigit()):
                return int(s)
            return float(s)
        except Exception:
            return None
    return None


def parse_bool01(x, default=None):
    """Return 0/1 atau default."""
    if x is None:
        return default
    if isinstance(x, bool):
        return 1 if x else 0
    if isinstance(x, (int, float)):
        return 1 if int(x) != 0 else 0
    if isinstance(x, str):
        s = x.strip().lower()
        if s in {"1", "true", "ya", "y", "yes", "on"}:
            return 1
        if s in {"0", "false", "tidak", "t", "no", "off"}:
            return 0
        # dukung input jenis kelamin langsung
        if s in {"l", "lk", "laki", "laki-laki", "pria", "cowo", "male", "m"}:
            return 0
        if s in {"p", "pr", "perempuan", "wanita", "cewe", "female", "f"}:
            return 1
    return default


def normalize_grade(x):
    """Normalisasi nilai grade supaya mendekati kategori notebook."""
    if x is None:
        return None
    s = str(x).strip().upper()
    if s == "":
        return None
    # ubah AB/BC -> B+/C+
    s = GRADE_ALIAS.get(s, s)
    # rapikan variasi
    s = s.replace(" ", "")
    return s


def normalize_masa_carikerja(x):
    """
    Notebook Anda mengindikasikan:
    1 = sebelum lulus, 2 = sesudah lulus
    Laravel Anda mungkin kirim '1'/'2' atau teks.
    """
    if x is None:
        return None
    if isinstance(x, (int, float)):
        v = int(x)
        return v if v in (1, 2) else None
    s = str(x).strip().lower()
    if s in {"1", "sebelum", "sebelumlulus", "sebelum_lulus", "pre", "pra"}:
        return 1
    if s in {"2", "sesudah", "sesudahlulus", "sesudah_lulus", "post", "pasca"}:
        return 2
    # kalau string angka lainnya, coba cast
    n = to_number(s)
    if isinstance(n, int) and n in (1, 2):
        return n
    return None


def main():
    try:
        if not MODEL_PATH.exists():
            raise FileNotFoundError(f"model.joblib tidak ditemukan di: {MODEL_PATH}")

        payload = read_input()

        # Map keys dari Laravel -> key model
        mapped = {}
        for k, v in payload.items():
            kk = str(k).strip()
            model_key = KEY_MAP.get(kk, kk)
            mapped[model_key] = v

        # Normalisasi tipe data sesuai kebutuhan pipeline
        # numeric
        mapped["Masa_Studi"] = to_number(mapped.get("Masa_Studi"))
        mapped["IPK"] = to_number(mapped.get("IPK"))
        mapped["Toefl"] = to_number(mapped.get("Toefl"))
        mapped["SSKM"] = to_number(mapped.get("SSKM"))
        mapped["Jml_Lamaran"] = to_number(mapped.get("Jml_Lamaran"))

        # boolean/biner
        mapped["Jenkel"] = parse_bool01(mapped.get("Jenkel"), default=None)  # 0/1
        mapped["Magang"] = parse_bool01(mapped.get("Magang"), default=None)  # 0/1

        # grade
        mapped["N_KP"] = normalize_grade(mapped.get("N_KP"))
        mapped["N_TA"] = normalize_grade(mapped.get("N_TA"))

        # masa_carikerja (1/2)
        mapped["Masa_carikerja"] = normalize_masa_carikerja(mapped.get("Masa_carikerja"))

        feature_cols = load_feature_cols()
        row = {c: mapped.get(c, None) for c in feature_cols}
        df = pd.DataFrame([row], columns=feature_cols)

        # Konsistensi: Masa_carikerja numeric nullable (Int64) seperti notebook
        if "Masa_carikerja" in df.columns:
            df["Masa_carikerja"] = pd.to_numeric(df["Masa_carikerja"], errors="coerce").astype("Int64")

        model = joblib.load(MODEL_PATH)
        if not hasattr(model, 'predict'):
            raise ValueError("Loaded object is not a valid model")
        yhat = float(model.predict(df)[0])

        sys.stdout.write(json.dumps({
            "ok": True,
            "prediksi_masa_tunggu": round(yhat, 6)
        }))
        return

    except Exception as e:
        # Pastikan selalu JSON agar Laravel mudah parse
        sys.stdout.write(json.dumps({
            "ok": False,
            "error": str(e)
        }))
        sys.exit(1)


if __name__ == "__main__":
    main()
