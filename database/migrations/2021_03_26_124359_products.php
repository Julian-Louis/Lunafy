<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('billing_name');
            $table->integer('stock')->nullable();
            $table->text('price');
            $table->text('dashboard_display');
            $table->text('front_display');
            $table->enum('type',['webhosting'])->nullable();
            $table->text('nameserver1');
            $table->text('nameserver2');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('products');
    }
}
