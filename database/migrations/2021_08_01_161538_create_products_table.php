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
            $table->string('name');
            $table->string('url_key')->nullable(false)->unique();
            $table->string('sku')->nullable(false)->unique();
            $table->string('image_name')->nullable(true);
            $table->string('image_path')->nullable(true);
            $table->text('description')->nullable(true);
            $table->integer('author_id')->nullable(true);
            $table->integer('price')->nullable(false);
            $table->integer('import_price')->nullable(false);
            $table->integer('qty')->nullable(false);
            $table->integer('category_id')->nullable(false);
            $table->integer('state')->default(1);
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
