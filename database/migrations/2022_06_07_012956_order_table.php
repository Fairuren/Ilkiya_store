<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class OrderTable extends Migration
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

            $table->string('order_number')->unique();
            $table->BigInteger('sub_total');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->BigInteger('total_amount');
            $table->integer('quantity');
            $table->boolead('cod');
            $table->string('transfer_evidence')->nullable();
            $table->enum('payment_status',['pending', 'paid', 'cancelled']);
            $table->enum("status", ['new', 'processing','delivered','received','cancelled']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            // $table->foreign('shipping_id')->references('id')->on('shipping')->onDelete('SET NULL');
            $table->float('ongkir');
            $table->string('email');
            $table->string('city');
            $table->string('phone');
            $table->string('address');
            $table->string('post_code');
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
