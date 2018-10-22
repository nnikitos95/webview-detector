<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByXRequestedWithHeaderDetector implements DetectorInterface
{
    /**
     * @return DetectResult
     */
    public function detect(): DetectResult
    {
        $value = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null;
        if ($value) {
            return DetectResult::true("APP_IN_HEADER:{$value}");
        }

        return DetectResult::false();
    }
}