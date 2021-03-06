<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diaudit');
            $table->text('lingkup_audit');
            $table->text('jenis_usaha');
            $table->text('tujuan');
            $table->integer('auditor');
            $table->timestamp('jadwal');
            $table->integer('jenis_id');
            $table->integer('manajer')->nullable();
            $table->integer('supervisor')->nullable();
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
        Schema::dropIfExists('audit');
    }
}
