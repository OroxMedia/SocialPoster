<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaPostsTable
{
    public function up(): void
    {
        Schema::create('social_media_posts', function (Blueprint $table) {
            $table->id();

            // Enum stored as string
            $table->string('platform');
            $table->string('account');

            // Polymorphic relationship
            $table->unsignedBigInteger('social_media_postable_id');
            $table->string('social_media_postable_type');

            $table->string('social_platform_id')->nullable();

            $table->timestamps();

            $table->index(['social_media_postable_id', 'social_media_postable_type'], 'postable_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_media_posts');
    }
}
