<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_visit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            // $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->timestamp('visit_date')->nullable();
            $table->text('location')->nullable();
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
        Schema::dropIfExists('sales_visit');
    }
}
