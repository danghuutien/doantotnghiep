<?php

namespace Sudo\Asset\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AssetsFacade.
 *
 * @since 22/07/2015 11:25 PM
 */
class AssetFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Sudo\Asset\MyClass\Asset::class;
    }
}
