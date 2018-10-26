<?php

use nnikitos95\WebViewDetector\Detector\ByChromeVersionWithZerosInUserAgentDetector;
use nnikitos95\WebViewDetector\Detector\ByUserAgentDetectorInterface;
use PHPUnit\Framework\TestCase;

class ByChromeVersionWithZerosInUserAgentDetectorTest extends TestCase
{
    /**
     * @return ByChromeVersionWithZerosInUserAgentDetector
     */
    public function getDetector(): ByUserAgentDetectorInterface
    {
        return new ByChromeVersionWithZerosInUserAgentDetector();
    }

    /**
     * @return array
     */
    public function userAgentSuccessProvider(): array
    {
        return [
            [
                'One digit in version' => 'Mozilla/5.0 (Linux; Android 4.4; Nexus 5 Build/_BuildID_) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/3.0.0.0 Mobile Safari/537.36',
                'Two digits in version' => 'Mozilla/5.0 (Linux; Android 4.4; Nexus 5 Build/_BuildID_) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36',
                'Three digits in version' => 'Mozilla/5.0 (Linux; Android 4.4; Nexus 5 Build/_BuildID_) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/300.0.0.0 Mobile Safari/537.36'
            ]
        ];
    }

    /**
     * @return array
     */
    public function userAgentFailProvider(): array
    {
        return [
            [
                'Empty first digit' => 'Mozilla/5.0 (Linux; Android 4.4; Nexus 5 Build/_BuildID_) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/.0.0.0 Mobile Safari/537.36',
                'Version without three digits' => 'Mozilla/5.0 (Linux; Android 5.1.1; Nexus 5 Build/LMY48B; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/43.0.2357.65 Mobile Safari/537.36',
            ]
        ];
    }

    /**
     * @dataProvider userAgentSuccessProvider
     * @param string $userAgent
     */
    public function testSuccessDetect(string $userAgent)
    {
        $detector = $this->getDetector();
        $result = $detector->detect($userAgent);
        $this->assertTrue($result->isSuccess());
    }

    /**
     * @dataProvider userAgentFailProvider
     * @param string $userAgent
     */
    public function testFailDetect(string $userAgent)
    {
        $detector = $this->getDetector();
        $result = $detector->detect($userAgent);
        $this->assertFalse($result->isSuccess());
    }
}
