<?php

use nnikitos95\WebViewDetector\Detector\DetectResult;
use PHPUnit\Framework\TestCase;

class DetectResultTest extends TestCase
{
    public function testCreateTrue()
    {
        $result = DetectResult::true();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('-', $result->getMessage());
        $result = DetectResult::true('message');
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('message', $result->getMessage());
    }

    public function testCreateFalse()
    {
        $result = DetectResult::false();
        $this->assertFalse($result->isSuccess());
        $this->assertEquals('-', $result->getMessage());
    }
}
