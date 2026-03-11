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
        Schema::create('user_video_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id');
            $table->foreignId('user_id');
            $table->timestamp('access_start');
            $table->timestamp('access_expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_video_access');
    }
};
