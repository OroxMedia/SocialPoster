<?php

namespace Orox\SocialPoster\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Noweh\TwitterApi\Client;
use Orox\SocialPoster\Drivers\Twitter\TwitterConfig;
use RuntimeException;
use Throwable;

class TwitterService
{
    private Client $client;

    public function __construct(?TwitterConfig $config = null)
    {
        if (!$config || !($config->getConsumerKey() && $config->getConsumerSecret() && $config->getAccessToken() && $config->getAccessTokenSecret())) {
            $settings = [
                'account_id' => $config->getAccountId(),
                'access_token' => $config->getAccessToken(),
                'access_token_secret' => $config->getAccessTokenSecret(),
                'consumer_key' => $config->getConsumerKey(),
                'consumer_secret' => $config->getConsumerSecret(),
                'bearer_token' => $config->getBearerToken(),
                'free_mode' => false,
                'api_base_uri' => 'https://api.twitter.com/2/',
            ];

            $this->client = new Client($settings);
        } else {
            throw new Exception('Twitter config is not set');
        }
    }

    public function createPostWithText($text): object|array
    {
        try {
            return $this->client->tweet()->create()->performRequest(['text' => $text]);
        } catch (Throwable $e) {
            Log::error('Failed to create Twitter post with text', [
                'text' => $text,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw new RuntimeException('Failed to post text to Twitter.', 0, $e);
        }
    }

    public function createPostWithTextAndImage($text, $image): string
    {
        try {
            Log::info('Uploading image to Twitter', ['image' => $image]);

            $file_data = base64_encode(file_get_contents($image));
            $media_info = $this->client->uploadMedia()->upload($file_data);

            if (empty($media_info['media_id'])) {
                throw new RuntimeException('Media upload failed: No media_id returned.');
            }

            return $this->client->tweet()->create()->performRequest([
                'text' => $text,
                'media' => [
                    'media_ids' => [
                        (string)$media_info['media_id'],
                    ],
                ],
            ], true)->data->id;
        } catch (Throwable $e) {
            Log::error('Failed to create Twitter post with image', [
                'text' => $text,
                'image' => $image,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw new RuntimeException('Failed to post text and image to Twitter.', 0, $e);
        }
    }
}