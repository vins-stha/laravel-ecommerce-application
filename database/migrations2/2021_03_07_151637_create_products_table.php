<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations2.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->longText('description');
            $table->binary('image');
            $table->longText('extra');
            $table->decimal('price');
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('inStock');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->foreign('brand_id')->references('id')->on('product_brands');


        });
    }

    /**
     * Reverse the migrations2.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
