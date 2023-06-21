<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->integer('harga_paket');
            $table->integer('harga_normal');
            $table->enum('jenis', ['Destinasi', 'Wahana']);
            $table->char('village_id', 10)->nullable();
            $table->unsignedBigInteger('destinasi_id')->nullable();
            $table->text('destinasi')->nullable();
            $table->text('wahana')->nullable();
            $table->timestamps();

            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('destinasi_id')->references('id')->on('destinasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket');
    }
};
