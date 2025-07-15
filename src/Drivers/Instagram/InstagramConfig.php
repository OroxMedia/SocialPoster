<?php

namespace Orox\SocialPoster\Drivers\Instagram;


class InstagramConfig
{
    private readonly string $page_token;

    private readonly string $page_id;

    public function __construct(
        array $config
    ) {
        $this->page_token = $config['page_token'];
        $this->page_id = $config['page_id'];
    }

    public function getPageToken(): string
    {
        return $this->page_token;
    }

    public function getPageId(): string
    {
        return $this->page_id;
    }
}
