<?php

namespace UdaraJay\Dunbar;

use Illuminate\Support\Facades\Facade;

class DunbarFacade extends Facade {

    /**
     * Get the registered name of the component
     * @return string
     * @codeCoverageIgnore
     */
    protected static function getFacadeAccessor() {
        return 'dunbar.proxy';
    }

}
