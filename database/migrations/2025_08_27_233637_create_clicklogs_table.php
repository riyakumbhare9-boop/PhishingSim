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
        Schema::create('clicklogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column:'user_id')->constrained()->onDelete(action:'cascade');
            $table->foreignId(column:'campaign_id')->constrained()->onDelete(action:'cascade');
            $table->string(column:'ip_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicklogs');
    }
};
