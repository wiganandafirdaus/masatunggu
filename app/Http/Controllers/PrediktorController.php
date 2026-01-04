<?php

namespace App\Http\Controllers;

use App\Models\Prediktor;
use Illuminate\Http\Request;

class PrediktorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'masa_studi' => 'required|integer|min:1|max:10',
            'provinsi' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'ipk' => 'required|numeric|min:0|max:4',
            'toefl' => 'required|integer|min:0|max:677',
            'jenis_kelamin' => 'required|boolean',
            'sskm' => 'required|integer|min:0|max:100',
            'nilai_kp' => 'required|string|max:10',
            'nilai_ta' => 'required|string|max:10',
            'magang' => 'required|boolean',
            'masa_carikerja' => 'required|string|max:255',
            'jml_lamaran' => 'required|integer|min:0',
        ]);

        Prediktor::create($request->all());

        return back()->with('success', 'Prediktor berhasil disimpan!');
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
