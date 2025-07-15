<?php

namespace Orox\SocialPoster\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Orox\SocialPoster\Enums\SocialPlatform;

class SocialMediaPost extends Model
{
    protected $fillable = [
        'platform',
        'account',
        'social_platform_id',
    ];

    protected $casts = [
        'platform' => SocialPlatform::class,
    ];

    public function postable(): MorphTo
    {
        return $this->morphTo();
    }
}
