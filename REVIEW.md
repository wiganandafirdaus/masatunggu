# Review Implementasi Aplikasi Prediksi Masa Tunggu Lulusan

## Pendahuluan Project
Aplikasi web berbasis Laravel untuk memprediksi masa tunggu lulusan mendapatkan pekerjaan menggunakan model machine learning Python (scikit-learn + LightGBM). Integrasi dilakukan via subprocess dengan pass data melalui file sementara.

**Tech Stack:**
- Backend: Laravel 12.43.1
- Frontend: Blade templates dengan Bootstrap
- ML: Python 3.10, scikit-learn, LightGBM, pandas
- Database: MySQL
- Environment: Laragon (Windows), Virtualenv Python

## Langkah-Langkah Implementasi

### 1. Setup Environment dan Database
- Jalankan `php artisan migrate` untuk create tabel `prediktors`.
- Setup virtualenv Python di `C:\laragon\www\masatunggu\venv\`.
- Install dependencies Python: pandas, joblib, scikit-learn, lightgbm.

### 2. Integrasi Python Awal (Gagal)
- Gunakan Laravel Process facade untuk run Python script.
- Error: `Unknown named parameter $input` karena versi Laravel tidak support options array di `run()`.
- Solusi sementara: Ganti ke `shell_exec()` dengan echo pipe.

### 3. Perbaikan Integrasi Python (Temp File)
- Error: Escaping issues di Windows dengan `shell_exec()` pipe.
- Solusi: Gunakan temp file untuk pass JSON input ke Python.
- Modifikasi `PrediktorController.php`: Create temp file, write JSON, run Python dengan path file, delete temp.
- Modifikasi `Script/predict.py`: Add `read_input()` function support file input (sys.argv[1]) or stdin.

### 4. Perbaikan UI Display
- Error: Prediction sukses di log tapi tidak tampil di UI.
- Root cause: Controller use `->with()` tapi view check `session('prediction')`.
- Fix: Ganti ke `session()->flash('prediction', $prediction)` dan `session()->flash('inputData', $inputData)`.
- Tambah list input variables di card "Hasil Prediksi Sementara" dengan labels readable.

### 5. Final Testing
- Standalone test Python: Berhasil output JSON prediction.
- UI test: Card tampil dengan prediction value dan list input readable setelah submit form.

## File-file yang Dimodifikasi

### PrediktorController.php
- Method `store()`: Validation, temp file creation, session flash.
- Method `savePrediction()`: Validation dan save ke DB.

### Script/predict.py
- Add `read_input()` function: Support stdin or file input.
- Mapping keys Laravel -> Model (e.g., 'masa_studi' -> 'Masa_Studi').
- Normalization functions untuk data preprocessing.

### resources/views/welcome.blade.php
- Add conditional `@if(session('prediction'))` card display.
- Add list input variables dengan labels dan readable values (e.g., 0/1 -> Laki-laki/Perempuan).

### Dependencies
- Python venv: Install pandas, scikit-learn, lightgbm via pip.
- Laravel: Existing composer dependencies.

## Error yang Diatasi

1. **Database Error**: "Unknown database 'laravel'" → Run migrate.
2. **Process Facade Error**: "Unknown named parameter $input" → Ganti ke temp file.
3. **Python Module Error**: "No module named 'pandas'" → Install dependencies.
4. **UI Not Displaying**: Prediction success tapi no display → Use session flash.
5. **Escaping in Windows**: Pipe echo gagal → Use temp file.
6. **Model Version Warning**: sklearn version mismatch → Ignore (still works).

## Tips Restart Project

1. **Clone/Setup Repo**:
   - Pastikan Laragon running, DB MySQL setup.
   - `composer install` untuk Laravel deps.

2. **Setup Database**:
   - `.env` configure DB connection.
   - `php artisan migrate` untuk create tables.

3. **Setup Python Environment**:
   - `python -m venv venv` (jika belum ada).
   - Activate venv: `venv\Scripts\activate` (Windows).
   - `pip install pandas joblib scikit-learn lightgbm`.

4. **Verify Files**:
   - Model: `Script/model.joblib`, `Script/feature_cols.json`.
   - Script: `Script/predict.py` support file input.

5. **Run & Test**:
   - `php artisan serve`.
   - Akses http://127.0.0.1:8000, isi form, submit → Lihat card prediction dengan input list.

6. **Troubleshooting**:
   - Jika error Process, pastikan Python path dan venv active.
   - Jika UI blank, check session flash di Controller.
   - Log Laravel di `storage/logs/laravel.log` untuk debug.

## Lessons Learned & Best Practices

- **Windows Subprocess**: Hindari pipe echo, gunakan temp file untuk reliable data passing.
- **Laravel Process Facade**: Versi berbeda support berbeda; fallback ke shell_exec atau exec.
- **Session vs View Data**: Use session flash untuk display hasil tanpa redirect.
- **Readable Labels**: Map raw keys ke user-friendly labels di view.
- **Error Handling**: Log exceptions, validate input, handle temp file cleanup.
- **Version Compatibility**: Test model dengan sklearn version yang match untuk hindari warnings.

Dokumentasi ini dibuat pada 2026-01-05 untuk referensi future restart project.</content>
<parameter name="filePath">C:\laragon\www\masatunggu\REVIEW.md