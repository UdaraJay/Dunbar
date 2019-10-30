<?php

namespace UdaraJay\Dunbar\Http\Exceptions;

/**
 * Exception class
 */
class ProxyMissingParamException extends ProxyException {

    public function __construct($parameter) {
        $this->httpStatusCode = 400;
        $this->errorType = 'proxy_missing_param';
        parent::__construct(trans('dunbar::messages.proxy_missing_param', array('param' => $parameter)));
    }

}
