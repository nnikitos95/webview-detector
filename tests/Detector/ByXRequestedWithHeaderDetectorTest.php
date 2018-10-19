<?php

use nnikitos95\WebViewDetector\Detector\ByXRequestedWithHeaderDetector;
use PHPUnit\Framework\TestCase;

class ByXRequestedWithHeaderDetectorTest extends TestCase
{
    public function testDetectIfHasHeader()
    {
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'test';
        $detector = new ByXRequestedWithHeaderDetector();
        $result = $detector->detect();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('APP_IN_HEADER:test', $result->getMessage());
    }
}
