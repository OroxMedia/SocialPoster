<?php

namespace Orox\SocialPoster\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Orox\SocialPoster\Models\SocialMediaPost;

trait HasSocialMediaPosts
{
    public function socialMediaPosts(): MorphMany
    {
        return $this->morphMany(SocialMediaPost::class, 'social_media_postable');
    }
}