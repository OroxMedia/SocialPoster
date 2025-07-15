<?php

namespace Orox\SocialPoster;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Orox\SocialPoster\Skeleton\SkeletonClass
 */
class SocialPosterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'socialposter';
    }
}
