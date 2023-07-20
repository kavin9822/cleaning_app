<?php

namespace Util;

final class Registry {

    private $data = array();
    // @var array HTTP status codes

    private $httpStatusCode = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required'
    ];

    public function get($key) {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function has($key) {
        return isset($this->data[$key]);
    }

    public function drop($key) {
        unset($this->data[$key]);
    }

    public function setJsonHeader() {
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Content-Type: application/json;charset=UTF-8");
        //header("x-powered-by: whyceeyes.com");
        //header("X-Csrf-Token: whyceeyes.com");
    }

    function setResponseCode($code = 200, $description = null, $data = null, $link = null) {
        $httpStatusCode = intval($code);
        $HttpMessage = $this->httpStatusCode[$httpStatusCode];
        header(trim("HTTP/1.1 $httpStatusCode $HttpMessage"));

        if (!empty($data) || is_array($data)) {
            $ResponceData = $data;
        } else {
            $ResponceData = NULL;
        }

        $respomceBody = [
            'status' => $httpStatusCode,
            'message' => $HttpMessage,
            'description' => $description,
            'data' => $ResponceData,
            'link' => $link
        ];
        
        echo json_encode($respomceBody);
    }

///reg class 
}
