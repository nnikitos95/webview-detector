<?php

use nnikitos95\WebViewDetector\Detector\ByUserAgentDetectorInterface;
use nnikitos95\WebViewDetector\Detector\ByUserAgentDetectorService;
use nnikitos95\WebViewDetector\Detector\DetectResult;
use PHPUnit\Framework\TestCase;

class ByUserAgentDetectorServiceTest extends TestCase
{
    protected function setUp()
    {
        $_SERVER['HTTP_USER_AGENT'] = 'test';
    }

    protected function tearDown()
    {
        unset($_SERVER['HTTP_USER_AGENT']);
    }

    /**
     * @param bool $result
     * @param string|null $message
     * @return ByUserAgentDetectorInterface
     */
    public function getDetectorMock(bool $result, string $message = null)
    {
        $resultObject = $result ? DetectResult::true($message): DetectResult::false();
        $mock = $this->createMock(ByUserAgentDetectorInterface::class);
        $mock->expects($this->any())
            ->method('detect')
            ->willReturn($resultObject)
        ;

        /*** @var ByUserAgentDetectorInterface $mock */
        return $mock;
    }

    public function getService()
    {
        return new ByUserAgentDetectorService();
    }

    public function testEmptyService()
    {
        $service = $this->getService();
        $result = $service->detect();
        $this->assertFalse($result->isSuccess());
    }

    public function testServiceWithOneDetector()
    {
        $service = $this->getService();
        $service->addDetector($this->getDetectorMock(true, 'detector'));
        $result = $service->detect();
        $this->assertTrue($result->isSuccess());
    }

    public function testServiceWithTwoDetectorsAndForceDetectOption()
    {
        $service = $this->getService();
        $service->setIsForceDetect(true);
        $service->addDetector($this->getDetectorMock(true, 'detector1'));
        $service->addDetector($this->getDetectorMock(true, 'detector2'));
        $result = $service->detect();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals("detector1:UA:test", $result->getMessage());
    }

    public function testServiceWithTwoDetectors()
    {
        $service = $this->getService();
        $service->addDetector($this->getDetectorMock(true, 'detector1'));
        $service->addDetector($this->getDetectorMock(true, 'detector2'));
        $result = $service->detect();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals("detector1:detector2:UA:test", $result->getMessage());
    }
}
