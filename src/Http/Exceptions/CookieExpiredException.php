<?php

namespace UdaraJay\Dunbar\Http\Exceptions;

/**
 * Exception class
 */
class CookieExpiredException extends ProxyException {

    public function __construct() {
        $this->httpStatusCode = 403;
        $this->errorType = 'proxy_cookie_expired';
        parent::__construct(trans('dunbar::messages.proxy_cookie_expired'));
    }

}
