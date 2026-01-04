<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prediktors', function (Blueprint $table) {
            $table->id();
            $table->integer('masa_studi');
            $table->string('provinsi');
            $table->string('prodi');
            $table->decimal('ipk', 3, 2);
            $table->integer('toefl');
            $table->boolean('jenis_kelamin')->default(false); // false=cowo
            $table->integer('sskm');
            $table->string('nilai_kp');
            $table->string('nilai_ta');
            $table->boolean('magang')->default(false); // false=belum magang
            $table->string('masa_carikerja');
            $table->integer('jml_lamaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediktors');
    }
};
