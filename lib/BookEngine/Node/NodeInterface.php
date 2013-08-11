<?php
/**
 * Created by PhpStorm.
 * User: Christoffer
 * Date: 11.8.2013
 * Time: 14:02
 */

namespace BookEngine\Node;

interface NodeInterface
{
    /**
     * @return array
     */
    public function getData();

    /**
     * @return \BookEngine\Node\NodeInterface[]
     */
    public function getChildren();

    /**
     * @return bool
     */
    public function hasChildren();
}