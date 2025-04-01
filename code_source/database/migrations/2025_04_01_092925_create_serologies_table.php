<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('serologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->constrained()->onDelete('cascade');
            $table->enum('tpha', ['positive', 'negative', 'pending'])->nullable();
            $table->enum('hb', ['positive', 'negative', 'pending'])->nullable();
            $table->enum('hc', ['positive', 'negative', 'pending'])->nullable();
            $table->enum('vih', ['positive', 'negative', 'pending'])->nullable();
            $table->enum('result', ['positive', 'negative', 'pending'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serologies');
    }
};
