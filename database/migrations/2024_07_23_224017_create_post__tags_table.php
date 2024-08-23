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
        Schema::create('post__tags', function (Blueprint $table) {
            //post_idとtag_idを外部キーに設定
            $table->foreignId('post_id')->constrained('posts');   //参照先のテーブル名を
            $table->foreignId('tag_id')->constrained('tags');    //constrainedに記載
            $table->primary(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post__tags');
    }
};
