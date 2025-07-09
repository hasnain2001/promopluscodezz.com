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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
            $table->foreignId('updated_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('code')->nullable();
            $table->integer('top_coupons')->nullable()->default(0);
            $table->integer('clicks')->nullable()->default(0);
            $table->integer('order')->default(0);
            $table->string('ending_date');
            $table->string('status');
            $table->string('authentication')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
