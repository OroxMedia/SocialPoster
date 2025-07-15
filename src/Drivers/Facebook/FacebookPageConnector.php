<?php

namespace Orox\SocialPoster\Drivers\Facebook;

use Saloon\Contracts\Authenticator;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class FacebookPageConnector extends Connector
{
    use AcceptsJson;

    public function __construct(
        protected FacebookConfig $facebookConfig,
    ) {}

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return sprintf('https://graph.facebook.com/v22.0/%s', $this->facebookConfig->getPageId());
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }

    protected function defaultAuth(): ?Authenticator
    {
        return new TokenAuthenticator($this->facebookConfig->getPageToken());
    }
}
