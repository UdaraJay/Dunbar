<?php

namespace UdaraJay\Dunbar\Http\Exceptions;

/**
 * Exception class
 */
class MissingClientSecretException extends ProxyException {

    public function __construct($parameter) {
        $this->httpStatusCode = 500;
        $this->errorType = 'missing_client_secret';
        parent::__construct(trans('dunbar::messages.missing_client_secret', array('client' => $parameter)));
    }

}
