<?php

namespace BookEngine\Decorator;

use BookEngine\Node\Node;
use BookEngine\Node\NodeInterface;

class NodeDecorator implements NodeInterface
{
    /**
     * @var \BookEngine\Node\Node
     */
    public $node;

    /**
     * @param \BookEngine\Node\NodeInterface $node
     */
    function __construct(NodeInterface $node)
    {
        $this->node = $node;
    }

    /**
     *
     */
    public function init()
    {
    }

    /**
     * @param string $name
     * @param array $arguments
     */
    function __call($name, $arguments)
    {
        if ($node = $this->resolveCallable($name)) {
            return call_user_func_array(array($node, $name), $arguments);
        }
        return null;
    }

    protected function resolveCallable($method)
    {
        $node = $this->getRootNode();
        if (is_callable(array($node, $method))) {
            return $node;
        }
        $node = $this->node;
        while ($node instanceof NodeDecorator) {
            if (is_callable($node, $method)) {
                return $node;
            }
            $node = $node->getNode();
        }
        return null;
    }

    protected function getRootNode()
    {
        $node = $this->node;
        while ($node instanceof NodeDecorator) {
            $node = $node->getRootNode();
        }
        return $node;
    }

    /**
     * @return \BookEngine\Node\Node
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->getRootNode()->getData();
    }

    /**
     * @return \BookEngine\Node\NodeInterface[]
     */
    public function getChildren()
    {
        return $this->getRootNode()->getChildren();
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return $this->getRootNode()->hasChildren();
    }
}