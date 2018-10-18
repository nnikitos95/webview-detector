<?php

namespace nnikitos95\WebViewDetector\Detector;

class DetectorService implements DetectorInterface
{
    /**
     * @var DetectorInterface[]
     */
    protected $detectors = [];

    /**
     * @return bool
     */
    public function detect(): bool
    {
        foreach ($this->detectors as $detector) {
            if ($detector->detect()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param DetectorInterface $detector
     * @return DetectorService
     */
    public function addDetector(DetectorInterface $detector): self
    {
        $this->detectors[] = $detector;
        return $this;
    }
}