<?php

use nnikitos95\WebViewDetector\Detector\ByXRequestedWithHeaderDetector;
use PHPUnit\Framework\TestCase;

class ByXRequestedWithHeaderDetectorTest extends TestCase
{
    public function testDetect()
    {
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'test';
        $detector = new ByXRequestedWithHeaderDetector();
        $this->assertTrue($detector->detect());
    }
}
