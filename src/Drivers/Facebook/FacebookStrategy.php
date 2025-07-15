<?php

namespace Orox\SocialPoster\Drivers\Facebook;


use Orox\SocialPoster\Contracts\SocialMediaPostable;
use Orox\SocialPoster\Contracts\SocialMediaStrategy;
use Orox\SocialPoster\Enums\SocialPlatform;
use Orox\SocialPoster\Services\FacebookService;
use RuntimeException;

class FacebookStrategy implements SocialMediaStrategy
{
    public const PLATFORM = SocialPlatform::Facebook;
    public function post(SocialMediaPostable $model, string $account): string
    {
        $config = config("socialposter.accounts.facebook.$account");

        if (empty($config)) {
            throw new RuntimeException("Facebook account [$account] not configured.");
        }
        $service = new FacebookService(new FacebookConfig($config));

        if ($image = $model->getSocialMediaImage(self::PLATFORM)) {
            return $service->createPostWithTextAndImage($model->getSocialMediaBody(self::PLATFORM), $image);
        } else {
            return $service->createPostWithText($model->getSocialMediaBody(self::PLATFORM));
        }
    }

    public function getPlatform(): SocialPlatform
    {
        return self::PLATFORM;
    }
}
