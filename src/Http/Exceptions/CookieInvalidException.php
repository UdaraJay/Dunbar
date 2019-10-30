<?php

namespace UdaraJay\Dunbar\Http\Exceptions;

/**
 * Exception class
 */
class CookieInvalidException extends ProxyException {

    public function __construct($parameter) {
        $this->httpStatusCode = 500;
        $this->errorType = 'proxy_cookie_invalid';
        parent::__construct(trans('dunbar::messages.proxy_cookie_invalid', array('param' => $parameter)));
    }

}
