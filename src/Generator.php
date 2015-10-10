<?php

namespace Nathanmac\QRCode;

use Endroid\QrCode\QrCode;

class Generator
{
    /**
     * Default Size
     */
    const DEFAULT_SIZE = 100;

    /**
     * Default Color
     */
    const DEFAULT_COLOR = '000000';

    /**
     * Default background
     *  if false transparent
     */
    const DEFAULT_BACKGROUND = false; // Transparent

    /**
     * @var QrCode|null
     */
    protected $QRGenerator = null;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var size
     */
    protected $size;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var string|bool
     */
    protected $backgroundColor;

    /**
     * Generator constructor.
     *
     * @param string      $content
     * @param int         $size
     * @param string      $color
     * @param string|bool $background
     */
    public function __construct(
        $content,
        $size = self::DEFAULT_SIZE,
        $color = self::DEFAULT_COLOR,
        $background = self::DEFAULT_BACKGROUND
    ) {
        $this->setContent($content);
        $this->setSize($size);
        $this->setColor($color);
        $this->setBackgroundColor($background);
    }

    /**
     * @param string      $content
     * @param int         $size
     * @param string      $color
     * @param string|bool $background
     *
     * @return Generator
     */
    public static function generate(
        $content,
        $size = self::DEFAULT_SIZE,
        $color = self::DEFAULT_COLOR,
        $background = self::DEFAULT_BACKGROUND
    ) {
        return (new self($content, $size, $color, $background))
            ->create();
    }

    /**
     * Gets the content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     *
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Gets the size
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size
     *
     * @param int $size
     */
    public function setSize($size)
    {
        if (is_numeric($size) && $size > 0) $this->size = $size;
    }

    /**
     * Gets the color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Sets the color
     *
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $this->processColor($color, self::DEFAULT_COLOR);
    }

    /**
     * Gets the background color
     *
     * @return bool|string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Sets the background color
     *
     * @param bool|string $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $this->processColor($backgroundColor, self::DEFAULT_BACKGROUND);
    }

    /**
     * Process the Color Value
     *
     * @param string $color
     * @param string $default
     *
     * @return array
     */
    protected function processColor($color, $default)
    {
        // Transparent
        if (false === $color) {
            return array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 255);
        }

        if (! preg_match("/^([0-9a-fA-F]{6}|[0-9a-fA-F]{3})$/", $color)) {
            $color = $default;
        }

        if (strlen($color) === 6) {
            return array(
                'r' => hexdec(substr($color, 0, 2)),
                'g' => hexdec(substr($color, 2, 2)),
                'b' => hexdec(substr($color, 4, 2)),
                'a' => 0
            );
        }

        // Length of 3
        return array(
            'r' => hexdec(substr($color, 0, 1) . substr($color, 0, 1)),
            'g' => hexdec(substr($color, 1, 1) . substr($color, 1, 1)),
            'b' => hexdec(substr($color, 2, 1) . substr($color, 2, 1)),
            'a' => 0
        );
    }

    /**
     * Generates a QRCode
     *
     * @return QrCode
     *
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionUnknownException
     */
    public function create()
    {
        header('Content-Type: image/png');

        return $this->getGenerator()
            ->setText($this->getContent())
            ->setSize($this->getSize())
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor($this->getColor())
            ->setBackgroundColor($this->getBackgroundColor())
            ->render();
    }

    /**
     * Returns the QRCode Generator Instance
     *
     * @codeCoverageIgnore
     *
     * @return QrCode
     */
    protected function getGenerator()
    {
        if (is_null($this->QRGenerator))
            $this->QRGenerator = new QrCode();

        return $this->QRGenerator;
    }
}