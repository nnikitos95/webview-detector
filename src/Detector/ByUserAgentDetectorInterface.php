<?php

namespace nnikitos95\WebViewDetector\Detector;

interface ByUserAgentDetectorInterface
{
    /**
     * @param string $userAgent
     * @return DetectResult
     */
    public function detect(string $userAgent): DetectResult;
}