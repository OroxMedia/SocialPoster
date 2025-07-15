<?php

namespace Orox\SocialPoster;


use Orox\SocialPoster\Contracts\SocialMediaPostable;
use Orox\SocialPoster\Contracts\SocialMediaStrategy;

class SocialPoster
{
    protected SocialMediaStrategy $strategy;

    public function using(SocialMediaStrategy $strategy): static
    {
        $this->strategy = $strategy;
        return $this;
    }

    public function post(SocialMediaPostable $model, string $account = 'default'): void
    {
        if (!isset($this->strategy)) {
            throw new \RuntimeException('No social media strategy set.');
        }

        $this->strategy->post($model, $account);
    }

    public function postToMultiple(SocialMediaPostable $model, array $strategiesWithAccounts): void
    {
        foreach ($strategiesWithAccounts as [$strategy, $account]) {
            $this->using($strategy)->post($model, $account);
        }
    }
}