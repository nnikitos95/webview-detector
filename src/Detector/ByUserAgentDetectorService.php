<?php

namespace nnikitos95\WebViewDetector\Detector;

class ByUserAgentDetectorService implements DetectorInterface
{
    /**
     * @var bool
     */
    protected $isForceDetect = false;

    /**
     * @var UserAgentProviderInterface
     */
    protected $userAgentProvider;

    public function __construct(UserAgentProviderInterface $provider = null)
    {
        if (!$provider) {
            $provider = new class implements UserAgentProviderInterface {
                /**
                 * @return string|null
                 */
                public function getUserAgent(): ?string
                {
                    return $_SERVER['HTTP_USER_AGENT'] ?? null;
                }
            };
        }

        $this->userAgentProvider = $provider;
    }

    /**
     * @var ByUserAgentDetectorInterface[]
     */
    protected $detectors = [];

    /**
     * @return DetectResult
     */
    public function detect(): DetectResult
    {
        $userAgent = $this->userAgentProvider->getUserAgent();
        if (!$userAgent) {
            return DetectResult::false();
        }

        $isWebView = false;
        $message = '';
        foreach ($this->detectors as $detector) {
            $result = $detector->detect($userAgent);
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

        return $isWebView ? DetectResult::true("{$message}:UA:{$userAgent}") : DetectResult::false();
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