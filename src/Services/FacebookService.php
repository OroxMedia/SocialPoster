<?php

namespace Orox\SocialPoster\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Orox\SocialPoster\Drivers\Facebook\FacebookConfig;
use Orox\SocialPoster\Drivers\Facebook\FacebookPageConnector;
use Orox\SocialPoster\Drivers\Facebook\Requests\CreatePost;

class FacebookService
{
    protected FacebookPageConnector $connector;

    private Client $client;

    public function __construct(FacebookConfig $config)
    {
        $this->connector = new FacebookPageConnector($config);
    }

    public function createPostWithText($text)
    {
        if (app()->environment() !== 'production') {
            Log::info('Posting to facebook', ['text' => $text]);

            return [];
        }
        $response = $this->connector->send(new CreatePost($text));

        if ($response->failed()) {
            Log::error('Facebook post failed: ' . $response->body());
        }

        return $response->body();
    }

    public function createPostWithTextAndImage($text, $image): string
    {
        if (app()->environment() !== 'production') {
            Log::info('Posting to facebook', ['text' => $text]);

            return '';
        }
        $response = $this->connector->send(new CreatePost($text, $image));
        if ($response->failed()) {
            Log::error('Facebook post failed: ' . $response->body());
        }

        return $response->json()['id'];
    }
}
