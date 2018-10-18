<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByUserAgentDetectorService implements DetectorInterface
{
    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var ByUserAgentDetectorInterface[]
     */
    protected $detectors = [];

    public function __construct()
    {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
    }

    public function detect(): bool
    {
        foreach ($this->detectors as $detector) {
            if ($detector->detect($this->userAgent)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param ByUserAgentDetectorInterface $detector
     * @return ByUserAgentDetectorService
     */
    public function addDetector(ByUserAgentDetectorInterface $detector): self
    {
        $this->userAgent[] = $detector;
        return $this;
    }
}