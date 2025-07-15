<?php

namespace Orox\SocialPoster\Drivers\Facebook\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreatePost extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $content,
        protected ?string $imageUrl = null
    ) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        if ($this->imageUrl) {
            return '/photos';
        }

        return '/feed';
    }

    protected function defaultBody(): array
    {
        if ($this->imageUrl) {
            return [
                'caption' => $this->content,
                'url' => $this->imageUrl,
            ];
        }

        return [
            'message' => $this->content,
        ];
    }
}
