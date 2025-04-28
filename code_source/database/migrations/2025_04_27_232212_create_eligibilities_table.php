<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eligibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('age_group');
            $table->string('weight_group');
            $table->string('recent_illness');
            $table->string('previous_donation');
            $table->jsonb('medical_conditions')->nullable();
            $table->boolean('is_eligible')->default(false);
            $table->text('ineligibility_reason')->nullable();
            $table->timestamp('check_date')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eligibilities');
    }
};
