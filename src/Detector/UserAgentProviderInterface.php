<?php

namespace nnikitos95\WebViewDetector\Detector;

interface UserAgentProviderInterface
{
    /**
     * @return string
     */
    public function getUserAgent(): string;
}