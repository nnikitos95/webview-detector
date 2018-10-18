<?php

namespace nnikitos95\WebViewDetector\Detector;

interface ByUserAgentDetectorInterface
{
    /**
     * @param string $userAgent
     * @return bool
     */
    public function detect(string $userAgent): bool;
}