<?php declare(strict_types=1);

namespace nnikitos95\WebViewDetector\Detector;

interface DetectorInterface
{
    /**
     * @return DetectResult
     */
    public function detect(): DetectResult;
}