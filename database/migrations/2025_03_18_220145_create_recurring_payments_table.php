<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recurring_payments', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->double('amount');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('payment_day');
            $table->integer('total_installments');
            $table->boolean('status')->default(true);
            $table->foreignId('template_expense_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('frequency_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_payments');
    }
};
