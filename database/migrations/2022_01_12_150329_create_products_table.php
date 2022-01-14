<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name', 100);
            $table->decimal('price');
            $table->decimal('stock');
            $table->decimal('discount')->nullable();
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
