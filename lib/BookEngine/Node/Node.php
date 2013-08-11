<?php

namespace BookEngine\Node;

abstract class Node implements NodeInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var \BookEngine\Node\Node[]
     */
    private $_children = array();

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     *
     */
    public function init()
    {
    }

    /**
     * @param \BookEngine\Node\Node $node
     */
    public function addChild(Node $node)
    {
        $this->_children[$node->getId()] = $node;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = get_object_vars($this);
        foreach ($this->_children as $id => $node) {
            $data['children'][$id] = $node->getData();
        }
        return $data;
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this->getData());
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \BookEngine\Node\Node[]
     */
    public function getChildren()
    {
        return $this->_children;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->_children);
    }
}