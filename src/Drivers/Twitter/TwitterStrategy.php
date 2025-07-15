<?php

namespace Orox\SocialPoster\Drivers\Twitter;


use Orox\SocialPoster\Contracts\SocialMediaPostable;
use Orox\SocialPoster\Contracts\SocialMediaStrategy;
use Orox\SocialPoster\Enums\SocialPlatform;
use Orox\SocialPoster\Services\TwitterService;
use RuntimeException;

class TwitterStrategy implements SocialMediaStrategy
{
    public const PLATFORM = SocialPlatform::Twitter;
    public function post(SocialMediaPostable $model, string $account): string
    {
        $config = config("socialposter.accounts.twitter.$account");

        if (empty($config)) {
            throw new RuntimeException("Twitter account [$account] not configured.");
        }

        $twitterService = new TwitterService(new TwitterConfig($config));

        $body = $model->getSocialMediaBody(self::PLATFORM);
        $image = $model->getSocialMediaImage(self::PLATFORM);

        return $image
            ? $twitterService->createPostWithTextAndImage($body, $image)
            : $twitterService->createPostWithText($body);
    }


    public function getPlatform(): SocialPlatform
    {
        return self::PLATFORM;
    }
}
