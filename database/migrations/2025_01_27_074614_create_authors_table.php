<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('source_author_id')->nullable();
            $table->text('bio')->nullable();
            $table->foreignId('source_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
            $table->unique(['name', 'source_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};