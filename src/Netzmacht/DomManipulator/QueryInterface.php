<?php

/**
 * @package    contribute
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator;

/**
 * Interface QueryInterface describes an query which filters the dom to retrieve a DomNodeList.
 *
 * @package Netzmacht\Contao\DomManipulator
 */
interface QueryInterface
{
    /**
     * Execute a query on a document and return a filtered node list.
     *
     * @param \DOMDocument $document Dom Document.
     *
     * @return \Traversable|\DOMNode[]
     */
    public function query(\DOMDocument $document);
}
