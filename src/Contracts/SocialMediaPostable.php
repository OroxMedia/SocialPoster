<?php

namespace Orox\SocialPoster\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Orox\SocialPoster\Enums\SocialPlatform;

interface SocialMediaPostable {
    public static function getModelForNextPost(SocialPlatform $platform): ?self;

    public function socialMediaPosts(): MorphMany;

    public function getSocialMediaBody(SocialPlatform $platform): string;

    public function getSocialMediaImage(SocialPlatform $platform): string;
}