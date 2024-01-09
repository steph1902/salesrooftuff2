<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('ALTER TABLE sales ALTER COLUMN id DROP DEFAULT;');




        // Schema::create('sales', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('NIK');
        //     $table->string('Nama');
        //     $table->string('TempatLahir');
        //     $table->date('TanggalLahir');
        //     $table->string('AlamatKTP');
        //     $table->string('AlamatDomisili');
        //     $table->string('NomorHandphone');
        //     $table->string('Email');
        //     $table->string('Username');
        //     $table->string('Password');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
