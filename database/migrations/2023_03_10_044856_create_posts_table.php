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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->boolean('conclued')->nullable();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('type_id')->nullable();
            $table->foreignId('gender_id')->nullable();
            $table->string('name')->index();
            $table->timestamps();
            $table->softDeletes();
            // $table->index(['gender_id', 'name'], 'search');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
