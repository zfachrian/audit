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
            $table->integer('auditor');
            $table->timestamp('jadwal');
            $table->foreign('jenis_id')->references('id')->on('jenis_audit');
            // $table->integer('jenis_id', 10)->unsigned;
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
