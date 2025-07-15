<?php

namespace Orox\SocialPoster\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Orox\SocialPoster\Drivers\Instagram\InstagramConfig;
use RuntimeException;
use Throwable;

/**
 * Class InstagramService
 */
class InstagramService
{
    private readonly ?string $page_id;

    private readonly ?string $user_token;

    private Client $client;

    public function __construct(InstagramConfig $config)
    {
        $this->page_id = $config->getPageId();
        $this->user_token = $config->getPageToken();
        $this->client = new Client([
            'base_uri' => 'https://graph.facebook.com/v21.0/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->user_token,
            ],
        ]);
    }

    /**
     * @throws Exception
     */
    public function createPostWithText($text): never
    {
        throw new Exception('Text only posts are not supported on Instagram');
    }

    public function createPostWithTextAndImage($text, $image): string
    {
        try {
            $response = $this->client->post(sprintf('%s/media', $this->page_id), [
                'json' => [
                    'image_url' => $image,
                    'caption' => $text,
                ],
            ]);

            $body = $response->getBody()->getContents();
            $container = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Invalid JSON response: ' . json_last_error_msg());
            }

            if (empty($container['id'])) {
                throw new RuntimeException('Failed to create media object: No ID returned');
            }

            $publishResponse = $this->client->post(sprintf('%s/media_publish', $this->page_id), [
                'json' => [
                    'creation_id' => $container['id'],
                ],
            ]);

            return json_decode($publishResponse->getBody()->getContents(), true)['id'];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handles HTTP client errors
            Log::error('HTTP request to Instagram API failed', [
                'message' => $e->getMessage(),
                'request' => $e->getRequest()?->getBody()?->getContents(),
                'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ]);
            throw new RuntimeException('Failed to post to Instagram due to an HTTP error.', 0, $e);
        } catch (Throwable $e) {
            // Handles all other exceptions
            Log::error('Unexpected error during Instagram post', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw new RuntimeException('An unexpected error occurred while posting to Instagram.', 0, $e);
        }
    }
}
