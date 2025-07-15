<?php

namespace Orox\SocialPoster\Drivers\Instagram;

use Orox\SocialPoster\Contracts\SocialMediaPostable;
use Orox\SocialPoster\Contracts\SocialMediaStrategy;
use Orox\SocialPoster\Enums\SocialPlatform;
use Orox\SocialPoster\Services\InstagramService;
use RuntimeException;

class InstagramStrategy implements SocialMediaStrategy
{
    public const PLATFORM = SocialPlatform::Instagram;
    public function post(SocialMediaPostable $model, string $account): string
    {
        $config = config("socialposter.accounts.instagram.$account");

        if (empty($config)) {
            throw new RuntimeException("Instagram account [$account] not configured.");
        }
        $service = new InstagramService(new InstagramConfig($config));

        $body = $model->getSocialMediaBody(self::PLATFORM);
        $image = $model->getSocialMediaImage(self::PLATFORM);

        if(!$image) {
            throw new RuntimeException("Instagram image is required");
        }

        return $service->createPostWithTextAndImage(
            $body,
            $image
        );
    }

    public function getPlatform(): SocialPlatform
    {
        return self::PLATFORM;
    }
}