<?php

namespace Orox\SocialPoster\Contracts;


use Orox\SocialPoster\Enums\SocialPlatform;

interface SocialMediaStrategy
{
    public function post(SocialMediaPostable $model, string $account): string;

    public function getPlatform(): SocialPlatform;
}