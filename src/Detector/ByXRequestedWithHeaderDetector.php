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
     * @return bool
     */
    public function detect(): bool
    {
        if ($this->headerValue) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return "\"{$this->headerName}\" header detector";
    }
}