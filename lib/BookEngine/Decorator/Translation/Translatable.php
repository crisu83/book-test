<?php

namespace BookEngine\Decorator\Translation;

interface Translatable
{
    /**
     * @return string
     */
    public function getText();

    /**
     * @param string $text
     */
    public function setText($text);
}