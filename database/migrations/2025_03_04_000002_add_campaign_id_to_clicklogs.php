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
        Schema::table('clicklogs', function (Blueprint $table) {
            $table->unsignedBigInteger('campaign_id')->nullable()->after('id');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            
            // Ensure table has visitor tracking fields
            if (!Schema::hasColumn('clicklogs', 'visitor_ip')) {
                $table->string('visitor_ip')->nullable();
            }
            if (!Schema::hasColumn('clicklogs', 'user_agent')) {
                $table->text('user_agent')->nullable();
            }
            if (!Schema::hasColumn('clicklogs', 'referer')) {
                $table->text('referer')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clicklogs', function (Blueprint $table) {
            $table->dropForeign(['campaign_id']);
            $table->dropColumn('campaign_id');
        });
    }
};
