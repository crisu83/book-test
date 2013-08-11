<?php
/**
 * Created by PhpStorm.
 * User: Christoffer
 * Date: 11.8.2013
 * Time: 21:38
 */

namespace BookEngine\Decorator\Theme;


interface Themable
{
    /**
     * @param array $properties
     */
    public function theme(array $properties);

    /**
     * @param string $style
     */
    public function setStyle($style);

    /**
     * @return string
     */
    public function getStyle();
}