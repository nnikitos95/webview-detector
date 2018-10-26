<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByChromeVersionWithZerosInUserAgentDetector implements ByUserAgentDetectorInterface
{
    /**
     * @param string $userAgent
     * @return DetectResult
     */
    public function detect(string $userAgent): DetectResult
    {
        return preg_match('/Chrome\/[0-9]{1,}(\.0){3}/', $userAgent) ?
            DetectResult::true('DETECT BY ZEROS IN CHROME VERSION') : DetectResult::false();
    }
}