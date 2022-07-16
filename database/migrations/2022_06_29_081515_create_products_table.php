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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug');
            $table->integer('quentity')->default(5);
            $table->string('regular_price')->nullable();
            $table->string('offer_price')->nullable();
            $table->text('sort_discription')->nullable();
            $table->text('description')->nullable();
            $table->string('unique_id')->nullable();
            
            $table->integer('is_fiture')->default(0)->comment('0=In-active , 1=Active');
            $table->integer('status')->default(1)->comment('1=active, 0=In-active');

            $table->text('meta_title')->nullable();
            $table->text('meta_discription')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->integer('view_count')->default(0);
            $table->text('main_image')->nullable();
            $table->text('gallary_one')->nullable();
            $table->text('gallary_two')->nullable();
            $table->text('warranty')->nullable();

            $table->unsignedInteger('brand_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->unsignedInteger('color_id')->nullable();
            $table->unsignedInteger('size_id')->nullable();
           
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
        Schema::dropIfExists('products');
    }
};
