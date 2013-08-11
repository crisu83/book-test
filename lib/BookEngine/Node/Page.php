<?php

namespace BookEngine\Node;

class Page extends Node implements PageInterface
{
    /**
     * @var int
     */
    protected $width = 1754;

    /**
     * @var int
     */
    protected $height = 1240;

    /**
     * @var string
     */
    protected $bgColor = '#fff';

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getBgColor()
    {
        return $this->bgColor;
    }

    /**
     * @param string $bgColor
     */
    public function setBgColor($bgColor)
    {
        $this->bgColor = $bgColor;
    }
}