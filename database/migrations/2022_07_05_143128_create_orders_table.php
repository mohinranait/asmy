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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('total_price')->nullable();
            $table->text('address')->nullable();
            $table->integer('payment_method')->default(1)->comment('1=bkash,2=Nagad,3=Roket');
            $table->text('transaction_id')->nullable();
            $table->integer('is_paid')->default(1)->comment('1=COD,2=SSL,3=Mobile bank');
            $table->integer('status')->default(0)->comment('0=pending , 1=delevery,2=cancel,3=proccessing');
            $table->string('district')->nullable();
            $table->string('upzila')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
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
};
