<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->json('name')->nullable();
            $table->string('slug', 255)->unique();
            $table->json('description')->nullable();
            $table->json('ingredients')->nullable();
            $table->json('images')->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->string('code', 255)->nullable();
            $table->boolean('in_stock')->default(1);
            $table->boolean('is_active')->default(1);
            $table->integer('category_id')->nullable();
            $table->json('seo')->nullable();
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
}
