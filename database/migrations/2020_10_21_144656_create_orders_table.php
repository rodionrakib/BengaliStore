<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('address_id'); // shipping address id 
            $table->double('amount');
            $table->string('transaction_id')->unique();
            $table->string('status')->nullable();
            $table->string('currency')->default('BDT');
            $table->string('cus_name');
            $table->string('cus_email')->nullable();
            $table->string('cus_addr1');
            $table->string('cus_city')->nullable();
            $table->string('cus_postcode')->nullable();
            $table->string('cus_phone');
            $table->string('error')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
