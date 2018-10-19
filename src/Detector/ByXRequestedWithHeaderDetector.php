<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByXRequestedWithHeaderDetector implements DetectorInterface
{
    /**
     * @var string
     */
    protected $headerName = 'HTTP_X_REQUESTED_WITH';

    /**
     * @var null|string
     */
    protected $headerValue = null;

    /**
     * ByXRequestedWithHeaderDetector constructor.
     */
    public function __construct()
    {
        $this->headerValue = $_SERVER[$this->headerName] ?? null;
    }

    /**
     * @return DetectResult
     */
    public function detect(): DetectResult
    {
        if ($this->headerValue) {
            return DetectResult::true("APP_IN_HEADER:{$this->headerValue}");
        }

        return DetectResult::false();
    }
}