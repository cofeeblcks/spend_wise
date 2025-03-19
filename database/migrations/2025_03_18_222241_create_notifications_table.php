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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('data');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->foreignId('notification_type_id')->constrained();
            $table->dateTime('read_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
