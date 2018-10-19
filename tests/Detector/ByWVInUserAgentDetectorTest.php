<?php

use nnikitos95\WebViewDetector\Detector\ByWVInUserAgentDetector;
use PHPUnit\Framework\TestCase;

class ByWVInUserAgentDetectorTest extends TestCase
{
    public function testDetect()
    {
        $userAgent = 'Mozilla/5.0 (Linux; Android 5.1.1; Nexus 5 Build/LMY48B; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/43.0.2357.65 Mobile Safari/537.36';
        $detector = new ByWVInUserAgentDetector();
        $result = $detector->detect($userAgent);
        $this->assertTrue($result->isSuccess());
        $this->assertEquals("DETECTED BY \"WV\"", $result->getMessage());
    }
}
