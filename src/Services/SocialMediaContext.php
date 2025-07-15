<?php

namespace Orox\SocialPoster\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Orox\SocialPoster\Contracts\SocialMediaPostable;
use Orox\SocialPoster\Contracts\SocialMediaStrategy;
use Orox\SocialPoster\Traits\HasSocialMediaPosts;
use Throwable;

class SocialMediaContext
{
    protected SocialMediaStrategy $strategy;

    public function setStrategy(SocialMediaStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @throws Throwable
     */
    public function post(SocialMediaPostable $model, string $account): void
    {
        $platform = $this->strategy->getPlatform();
        if (!in_array(HasSocialMediaPosts::class, class_uses_recursive($model::class))) {
            throw new Exception('Model must implement HasSocialMediaPosts');
        }

        //        Log::info('Posting to ' . $platform . ' for ' . $model->getSocialMediaBody($platform));

        DB::transaction(function () use ($model, $platform, $account) {
            $id = $this->strategy->post($model, $account);
            $model->socialMediaPosts()->create([
                'platform' => $platform,
                'account' => $account,
                'social_platform_id' => $id,
            ]);
        });

    }
}