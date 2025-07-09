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
        Schema::create('sliders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
        $table->foreignId('store_id')->nullable()->constrained('stores')->nullOnDelete();
        $table->string('name')->nullable();
        $table->string('title')->nullable();
        $table->text('subtitle')->nullable();
        $table->string('image')->nullable();
        $table->string('link')->nullable();
        $table->boolean('status')->default(1);
        $table->integer('sort_order')->default(0);
        $table->string('button_text')->nullable();
        $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
