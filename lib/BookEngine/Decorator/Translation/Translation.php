<?php

namespace BookEngine\Decorator\Translation;

use BookEngine\Decorator\NodeDecorator;
use BookEngine\Node\NodeInterface;

class Translation extends NodeDecorator
{
    /**
     * @var string
     */
    protected $language;

    /**
     * @var array
     */
    private $_texts = array();

    /**
     * @param string $language
     * @param NodeInterface $node
     */
    function __construct($language, NodeInterface $node)
    {
        parent::__construct($node);
        $this->language = $language;
    }

    /**
     *
     */
    public function init()
    {
        $this->node->init();
        $this->translate($this->node);
    }

    /**
     * @param string $from
     * @param string $to
     */
    public function addText($from, $to)
    {
        $this->_texts[$from] = $to;
    }

    /**
     * @param NodeInterface $node
     * @return \BookEngine\Node\NodeInterface
     */
    protected function translate(NodeInterface &$node)
    {
        foreach ($node->getChildren() as $child) {
            if ($child instanceof Translatable) {
                $this->translateNode($child);
            }
            $this->translate($child);
        }
    }

    /**
     * @param \BookEngine\Decorator\Translation\Translatable $node
     */
    protected function translateNode(Translatable $node)
    {
        $text = $node->getText();
        if (isset($this->_texts[$text])) {
            $node->setText($this->_texts[$text]);
        }
    }
}