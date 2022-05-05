<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentProductTable extends Migration
{
    public function up(): void
    {
        Schema::create('payment_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('count');
            $table->unsignedInteger('amount');
            $table->foreignId('payment_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_product');
    }
}
