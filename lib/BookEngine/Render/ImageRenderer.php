<?php

namespace BookEngine\Render;

use BookEngine\Exception\Exception;
use BookEngine\Node\Element;
use BookEngine\Node\PageInterface;
use BookEngine\Node\Text;
use Imagine\Image\Box;
use Imagine\Image\Color;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;

class ImageRenderer implements RendererInterface
{
    private $_imagine;

    function __construct()
    {
        $this->_imagine = new \Imagine\Gd\Imagine();
    }

    /**
     * @param PageInterface $page
     * @param bool $show
     * @return \Imagine\Image\ImageInterface
     */
    public function renderPage($page, $show = true)
    {
        $canvas = $this->_imagine->create(
            $this->makeBox($page->getWidth(), $page->getHeight()),
            $this->makeColor($page->getBgColor())
        );
        foreach ($page->getChildren() as $element) {
            $this->renderElement($element, $canvas);
        }
        if ($show) {
            $canvas->show('png');
        }
        return $canvas;
    }

    /**
     * @param Element $element
     * @param ImageInterface $canvas
     * @throws \BookEngine\Exception\Exception
     */
    protected function renderElement(Element $element, ImageInterface $canvas)
    {
        $reflection = new \ReflectionClass(get_class($element));
        $method = 'render' . $reflection->getShortName();
        if (!method_exists($this, $method)) {
            throw new Exception('Failed to render element. Method not found.');
        }
        $this->$method($element, $canvas);
    }

    /**
     * @param Text $element
     * @param ImageInterface $canvas
     */
    protected function renderText(Text $element, ImageInterface $canvas)
    {
        $canvas->draw()->text(
            $element->getText(),
            $this->makeFont(
                $element->getFontFile(),
                $element->getFontSize(),
                $this->makeColor($element->getFontColor())
            ),
            $this->makePoint($element->getX(), $element->getY())
        );
    }

    /**
     * @param int $width
     * @param int $height
     * @return \Imagine\Image\Box
     */
    protected function makeBox($width, $height)
    {
        return new Box($width, $height);
    }

    /**
     * @param string $color
     * @param int $alpha
     * @return \Imagine\Image\Color
     */
    protected function makeColor($color, $alpha = 0)
    {
        return new Color($color, $alpha);
    }

    /**
     * @param string $file
     * @param int $size
     * @param Color $color
     * @return \Imagine\Image\FontInterface
     */
    protected function makeFont($file, $size, Color $color)
    {
        return $this->_imagine->font($file, $size, $color);
    }

    /**
     * @param int $x
     * @param int $y
     * @return \Imagine\Image\Point
     */
    protected function makePoint($x, $y)
    {
        return new Point($x, $y);
    }
}