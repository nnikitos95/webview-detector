<?php

use nnikitos95\WebViewDetector\Detector\DetectorInterface;
use nnikitos95\WebViewDetector\Detector\DetectorService;
use nnikitos95\WebViewDetector\Detector\DetectResult;
use PHPUnit\Framework\TestCase;

class DetectorServiceTest extends TestCase
{
    public function getService()
    {
        return new DetectorService();
    }

    public function testEmptyService()
    {
        $service = $this->getService();
        $result = $service->detect();
        $this->assertFalse($result->isSuccess());
    }

    /**
     * @param bool $result
     * @param string|null $message
     * @return DetectorInterface
     */
    public function getDetectorMock(bool $result, string $message = null)
    {
        $resultObject = $result ? DetectResult::true($message): DetectResult::false();
        $mock = $this->createMock(DetectorInterface::class);
        $mock->expects($this->any())
            ->method('detect')
            ->willReturn($resultObject)
        ;

        /*** @var DetectorInterface $mock */
        return $mock;
    }

    public function testServiceWithOneDetector()
    {
        $service = $this->getService();
        $service->addDetector($this->getDetectorMock(true, 'detector'));
        $result = $service->detect();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('detector', $result->getMessage());
    }

    public function testServiceWithTwoDetectorsAndForceDetectOption()
    {
        $service = $this->getService();
        $service->setIsForceDetect(true);
        $service->addDetector($this->getDetectorMock(true, 'detector1'));
        $service->addDetector($this->getDetectorMock(true, 'detector2'));
        $result = $service->detect();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('detector1', $result->getMessage());
    }

    public function testServiceWithTwoDetectors()
    {
        $service = $this->getService();
        $service->addDetector($this->getDetectorMock(true, 'detector1'));
        $service->addDetector($this->getDetectorMock(true, 'detector2'));
        $result = $service->detect();
        $this->assertTrue($result->isSuccess());
        $this->assertEquals('detector1;detector2', $result->getMessage());
    }
}
