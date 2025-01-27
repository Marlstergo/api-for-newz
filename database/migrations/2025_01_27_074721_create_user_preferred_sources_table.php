<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_preferred_sources', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('source_id')->constrained()->onDelete('cascade');
            $table->primary(['user_id', 'source_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_preferred_sources');
    }
};