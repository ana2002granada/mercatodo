<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 35)->unique();
            $table->string('receipt', 25)->nullable();
            $table->string('payer_document', 35)->nullable();
            $table->string('payer_address', 75)->nullable();
            $table->string('description', 255)->nullable();
            $table->unsignedInteger('amount')->nullable();
            $table->string('status', 255);
            $table->timestamp('paid_at')->nullable();
            $table->string('process_url', 255)->nullable();
            $table->string('request_id', 255)->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}
