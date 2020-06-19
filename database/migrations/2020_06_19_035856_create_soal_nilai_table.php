<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audit_id');
            $table->integer('soal_id');
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
        Schema::dropIfExists('soal_nilai');
    }
}
