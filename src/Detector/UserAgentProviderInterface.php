<?php

namespace nnikitos95\WebViewDetector\Detector;

interface UserAgentProviderInterface
{
    /**
     * @return string|null
     */
    public function getUserAgent(): ?string;
}