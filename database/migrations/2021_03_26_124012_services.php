<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Services extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->text('hostname');
            $table->text('nodes');
            $table->text('password');
            $table->enum('status',['active','inactive','suspend','inprogres','unpaid']);
                $table->foreignId('product_id');
            $table->text('register_date');
            $table->text('end_date');
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
        Schema::dropIfExists('services');
    }
}
