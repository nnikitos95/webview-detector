<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByWVInUserAgentDetector implements ByUserAgentDetectorInterface
{
    /**
     * @param string $userAgent
     * @return DetectResult
     */
    public function detect(string $userAgent): DetectResult
    {
        return preg_match('/wv/', $userAgent) ?
            DetectResult::true('DETECTED BY "WV"') : DetectResult::false();
    }
}