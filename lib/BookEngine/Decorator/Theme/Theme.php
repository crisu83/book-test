<?php

namespace BookEngine\Decorator\Theme;

use BookEngine\Decorator\NodeDecorator;
use BookEngine\Node\NodeInterface;

class Theme extends NodeDecorator
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    private $_styles = array();

    /**
     * @param string $name
     * @param NodeInterface $node
     */
    function __construct($name, NodeInterface $node)
    {
        parent::__construct($node);
        $this->name = $name;
    }

    /**
     *
     */
    public function init()
    {
        $this->node->init();
        $this->theme($this->node);
    }

    /**
     * @param string $name
     * @param array $properties
     */
    public function addStyle($name, $properties)
    {
        $this->_styles[$name] = $properties;
    }

    /**
     * @param \BookEngine\Node\NodeInterface $node
     */
    protected function theme(NodeInterface &$node)
    {
        foreach ($node->getChildren() as $child) {
            if ($child instanceof Themable) {
                $this->themeNode($child);
            }
            $this->theme($child);
        }
    }

    /**
     * @param \BookEngine\Decorator\Theme\Themable $node
     */
    protected function themeNode(Themable $node)
    {
        $style = $node->getStyle();
        if ($style !== null && isset($this->_styles[$style])) {
            $node->theme($this->_styles[$style]);
        }
    }
}