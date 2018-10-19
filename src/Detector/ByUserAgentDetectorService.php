<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByUserAgentDetectorService implements DetectorInterface
{
    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var bool
     */
    protected $isForceDetect = false;

    /**
     * @var ByUserAgentDetectorInterface[]
     */
    protected $detectors = [];

    public function __construct()
    {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
    }

    /**
     * @return DetectResult
     */
    public function detect(): DetectResult
    {
        if (!$this->userAgent) {
            return DetectResult::false();
        }

        $isWebView = false;
        $message = '';
        foreach ($this->detectors as $detector) {
            $result = $detector->detect($this->userAgent);
            if ($result->isSuccess()) {
                $isWebView = true;
                $message .= $result->getMessage() . ':';
                if ($this->isForceDetect) {
                    break;
                }
            }
        }

        if (strlen($message) > 0) {
            $message = substr($message, 0, -1);
        }

        return $isWebView ? DetectResult::true("{$message}:UA:{$this->userAgent}") : DetectResult::false();
    }

    /**
     * @param ByUserAgentDetectorInterface $detector
     * @return ByUserAgentDetectorService
     */
    public function addDetector(ByUserAgentDetectorInterface $detector): ByUserAgentDetectorService
    {
        $this->detectors[] = $detector;
        return $this;
    }

    /**
     * @param bool $isForceDetect
     * @return ByUserAgentDetectorService
     */
    public function setIsForceDetect(bool $isForceDetect): ByUserAgentDetectorService
    {
        $this->isForceDetect = $isForceDetect;
        return $this;
    }
}