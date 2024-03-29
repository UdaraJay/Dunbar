<?php

namespace UdaraJay\Dunbar\Models;

class ProxyResponse {

    private $statusCode = null;
    private $reasonPhrase = null;
    private $protocolVersion = null;
    private $content = null;

    public function __construct($statusCode, $reasonPhrase, $protoVersion, $content) {
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
        $this->protocolVersion = $protoVersion;
        $this->content = $content;
    }

    public function setStatusCode($status) {
        $this->statusCode = $status;
    }

    public function setReasonPhrase($phrase) {
        $this->reasonPhrase = $phrase;
    }

    public function setProtoVersion($proto) {
        $this->protocolVersion = $proto;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getReasonPhrase() {
        return $this->reasonPhrase;
    }

    public function getProtoVersion() {
        return $this->protocolVersion;
    }

    public function getContent() {
        return $this->content;
    }
}
