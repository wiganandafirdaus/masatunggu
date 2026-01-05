<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prediktor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'masa_studi',
        'provinsi',
        'prodi',
        'ipk',
        'toefl',
        'jenis_kelamin',
        'sskm',
        'nilai_kp',
        'nilai_ta',
        'magang',
        'masa_carikerja',
        'jml_lamaran',
        'predicted_masa_tunggu',
    ];

    protected $casts = [
        'ipk' => 'decimal:2',
        'jenis_kelamin' => 'boolean',
        'magang' => 'boolean',
        'masa_studi' => 'integer',
        'toefl' => 'integer',
        'sskm' => 'integer',
        'jml_lamaran' => 'integer',
        'predicted_masa_tunggu' => 'decimal:2',
    ];
}
