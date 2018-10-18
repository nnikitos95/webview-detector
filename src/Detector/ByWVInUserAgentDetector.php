<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByWVInUserAgentDetector implements ByUserAgentDetectorInterface
{
    /**
     * @param string $userAgent
     * @return bool
     */
    public function detect(string $userAgent): bool
    {
        return preg_match('/wv/', $userAgent);
    }
}