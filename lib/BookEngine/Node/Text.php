<?php

namespace BookEngine\Node;

use BookEngine\Decorator\Theme\Style;
use BookEngine\Decorator\Theme\Themable;
use BookEngine\Decorator\Translation\Translatable;

class Text extends Element implements Themable, Translatable
{
    /**
     * @var string
     */
    protected $style;

    /**
     * @var string
     */
    protected $fontFile;

    /**
     * @var int
     */
    protected $fontSize;

    /**
     * @var mixed
     */
    protected $fontColor;

    /**
     * @var string
     */
    protected $text = '';

    /**
     * @param array $properties
     */
    public function theme(array $properties)
    {
        foreach ($properties as $name => $value) {
            switch ($name) {
                case 'fontFile':
                    $this->setFontFile($value);
                    break;
                case 'fontSize':
                    $this->setFontSize($value);
                    break;
                case 'fontColor':
                    $this->setFontColor($value);
                    break;
            }
        }
    }

    /**
     * @param string $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param string $fontColor
     */
    public function setFontColor($fontColor)
    {
        $this->fontColor = $fontColor;
    }

    /**
     * @return string
     */
    public function getFontColor()
    {
        return $this->fontColor;
    }

    /**
     * @param string $fontFile
     */
    public function setFontFile($fontFile)
    {
        $this->fontFile = $fontFile;
    }

    /**
     * @return string
     */
    public function getFontFile()
    {
        return $this->fontFile;
    }

    /**
     * @param int $fontSize
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
    }

    /**
     * @return int
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}