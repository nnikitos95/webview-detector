<?php

namespace nnikitos95\WebViewDetector\Detector;

class DetectorService implements DetectorInterface
{
    /**
     * @var DetectorInterface[]
     */
    protected $detectors = [];

    /**
     * @var bool
     */
    protected $isForceDetect = false;

    /**
     * @return DetectResult
     */
    public function detect(): DetectResult
    {
        $message = '';
        $isWebView = false;
        foreach ($this->detectors as $detector) {
            $result = $detector->detect();
            if ($result->isSuccess()) {
                if ($this->isForceDetect) {
                    return $result;
                }

                $isWebView = true;
                $message .= $result->getMessage() . ';';
            }
        }

        if (strlen($message) > 0) {
            $message = substr($message, 0, -1);
        }

        return $isWebView ? DetectResult::true($message) : DetectResult::false();
    }

    /**
     * @param DetectorInterface $detector
     * @return DetectorService
     */
    public function addDetector(DetectorInterface $detector): DetectorService
    {
        $this->detectors[] = $detector;
        return $this;
    }

    /**
     * @param bool $isForceDetect
     * @return DetectorService
     */
    public function setIsForceDetect(bool $isForceDetect): DetectorService
    {
        $this->isForceDetect = $isForceDetect;
        return $this;
    }
}