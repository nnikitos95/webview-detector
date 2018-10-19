<?php

namespace nnikitos95\WebViewDetector\Detector;

class DetectResult
{
    /**
     * @var bool
     */
    protected $result;

    /**
     * @var string
     */
    protected $message;

    /**
     * DetectResult constructor.
     * @param bool $result
     * @param string $message
     */
    protected function __construct(bool $result, string $message = null)
    {
        $this->result = $result;
        $this->message = $message ?? '-';
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return DetectResult
     */
    public static function true(string $message = '-')
    {
        return new self(true, $message);
    }

    /**
     * @return DetectResult
     */
    public static function false()
    {
        return new self(false);
    }
}