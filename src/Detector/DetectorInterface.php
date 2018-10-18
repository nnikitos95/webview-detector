<?php declare(strict_types=1);

namespace nnikitos95\WebViewDetector\Detector;

interface DetectorInterface
{
    /**
     * @return bool
     */
    public function detect(): bool;
}