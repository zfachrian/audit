<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_soal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_id');
            $table->text('kategori_soal');
            $table->integer('total_diperiksa')->nullable();
            $table->integer('total_tdksesuai')->nullable();
            $table->integer('persentase')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_soal');
    }
}
