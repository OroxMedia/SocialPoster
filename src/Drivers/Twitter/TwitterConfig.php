<?php

namespace Orox\SocialPoster\Drivers\Twitter;

class TwitterConfig
{
    private readonly string $consumerKey;

    private readonly string $consumerSecret;

    private readonly string $accessToken;

    private readonly string $accessTokenSecret;

    private readonly string $bearerToken;

    private readonly string $accountId;

    public function __construct(array $config)
    {
        $this->consumerKey = $config['consumer_key'];
        $this->consumerSecret = $config['consumer_secret'];
        $this->accessToken = $config['access_token'];
        $this->accessTokenSecret = $config['access_token_secret'];
        $this->accountId = $config['account_id'];
        $this->bearerToken = $config['bearer_token'];
    }

    public function getConsumerKey(): string
    {
        return $this->consumerKey;
    }

    public function getConsumerSecret(): string
    {
        return $this->consumerSecret;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getAccessTokenSecret(): string
    {
        return $this->accessTokenSecret;
    }

    public function getBearerToken(): string
    {
        return $this->bearerToken;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }
}