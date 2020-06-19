<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audit_id');
            $table->integer('kategori_id');
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
        Schema::dropIfExists('kategori_nilai');
    }
}
