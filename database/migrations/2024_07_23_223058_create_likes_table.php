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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('post_id')->constrained("posts")->onDelete('cascade')->onUpdate('cascade');

            $table->index('id');
            $table->index('user_id');
            $table->index('post_id');
            
            $table->unique([
                'user_id',
                'post_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
