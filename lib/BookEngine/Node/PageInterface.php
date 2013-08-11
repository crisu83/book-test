<?php

namespace BookEngine\Node;

interface PageInterface extends NodeInterface
{
    /**
     * @return string
     */
    public function getBgColor();

    /**
     * @return int
     */
    public function getHeight();

    /**
     * @return int
     */
    public function getWidth();
} 