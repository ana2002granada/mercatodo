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
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 100)->unique();
            $table->string('description', 255);
            $table->uuid('uuid')->unique()->nullable();
            $table->string('image')->nullable();
            $table->decimal('price');
            $table->unsignedInteger('stock');
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
        });
        DB::statement('
                create fulltext index products_name_description_fulltext
                on products(name, description);
            ');
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
