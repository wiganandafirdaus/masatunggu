<?php

namespace App\Http\Controllers;

use App\Models\Prediktor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Log;

class PrediktorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestPrediktor = Prediktor::latest()->first();

        return view('welcome', compact('latestPrediktor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store method called', $request->all());

        $request->validate([
            'masa_studi' => 'required|integer|min:1|max:17',
            'provinsi' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'ipk' => 'required|numeric|min:0|max:4',
            'toefl' => 'required|integer|min:0|max:677',
            'jenis_kelamin' => 'required|boolean',
            'sskm' => 'required|integer|min:100',
            'nilai_kp' => 'required|string|max:10',
            'nilai_ta' => 'required|string|max:10',
            'magang' => 'required|boolean',
            'masa_carikerja' => 'required|string|max:255',
            'jml_lamaran' => 'required|integer|min:0',
        ]);

        Log::info('Validation passed');

        // Call Python script for prediction first
        $inputData = $request->only([
            'masa_studi', 'provinsi', 'prodi', 'ipk', 'toefl', 'jenis_kelamin',
            'sskm', 'nilai_kp', 'nilai_ta', 'magang', 'masa_carikerja', 'jml_lamaran'
        ]);

        $pythonCmd = 'C:\laragon\www\masatunggu\venv\Scripts\python.exe';
        $tempFile = tempnam(sys_get_temp_dir(), 'predict_') . '.json';
        file_put_contents($tempFile, json_encode($inputData));
        $output = shell_exec($pythonCmd . ' ' . base_path('Script/predict.py') . ' "' . $tempFile . '"');
        unlink($tempFile);

        Log::info('Python prediction process started');
        Log::info('Shell exec output: ' . $output);

        if ($output) {
            $result = json_decode($output, true);
            if ($result && $result['ok']) {
                $prediction = $result['prediksi_masa_tunggu'];
                if (!is_numeric($prediction) || $prediction < 0) {
                    Log::error('Invalid prediction value: ' . $prediction);
                    return back()->with('error', 'Prediksi gagal: nilai tidak valid');
                }
                Log::info('Prediction successful: ' . $prediction);
                // Flash prediction and input data to session for display
                session()->flash('prediction', $prediction);
                session()->flash('inputData', $inputData);
                // Return view with latest prediktor
                $latestPrediktor = Prediktor::latest()->first();
                return view('welcome', compact('latestPrediktor'));
            } else {
                $errorMsg = $result ? $result['error'] : 'Invalid JSON output';
                Log::error('Prediction failed: ' . $errorMsg);
                return back()->with('error', 'Prediksi gagal: ' . $errorMsg);
            }
        } else {
            Log::error('Process failed: ' . $result->errorOutput());
            return back()->with('error', 'Prediksi gagal: ' . $result->errorOutput());
        }
    }

    public function savePrediction(Request $request)
    {
        $request->validate([
            'prediction' => 'required|numeric',
            'masa_studi' => 'required|integer|min:7|max:17',
            'provinsi' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'ipk' => 'required|numeric|min:0|max:4',
            'toefl' => 'required|integer|min:0|max:677',
            'jenis_kelamin' => 'required|boolean',
            'sskm' => 'required|integer|min:100',
            'nilai_kp' => 'required|string|max:10',
            'nilai_ta' => 'required|string|max:10',
            'magang' => 'required|boolean',
            'masa_carikerja' => 'required|string|max:255',
            'jml_lamaran' => 'required|integer|min:0',
        ]);

        try {
            $data = $request->all();
            $data['predicted_masa_tunggu'] = $request->prediction;
            $prediktor = Prediktor::create($data);
            Log::info('Prediktor saved with prediction: ' . $prediktor->id);
            return back()->with('success', 'Prediksi berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Failed to save prediction: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan prediksi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prediktor $prediktor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prediktor $prediktor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prediktor $prediktor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prediktor $prediktor)
    {
        //
    }
}
