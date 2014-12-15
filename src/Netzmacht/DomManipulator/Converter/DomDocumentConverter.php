<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\DomManipulator\Converter;

use Netzmacht\DomManipulator\ConverterInterface;

/**
 * Class DomDocumentParser uses the
 *
 * @package Netzmacht\DomManipulator\Parser
 */
class DomDocumentConverter implements ConverterInterface
{
    private $config = array(
        'version'             => '1.1',
        'strictErrorChecking' => false,
    );

    /**
     * Construct.
     *
     * @param array $config Additional dom document config.
     */
    function __construct(array $config = array())
    {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function parseHtml($html, $encoding = 'UTF-8')
    {
        $document = new \DOMDocument();

        foreach ($this->config as $name => $value) {
            $document->$name = $value;
        }

        $document->encoding = $encoding;

        if ($encoding !== false) {
            // Tell the parser which charset to use
            $encoding = $encoding ?: $document->encoding;
            $encoding = '<?xml encoding="' . $encoding . '" ?>';
            $html     = $encoding . $html;

            // @codingStandardsIgnoreStart
            @$document->loadHTML($html);
            // @codingStandardsIgnoreEnd

            foreach ($document->childNodes as $item) {
                if ($item->nodeType == XML_PI_NODE) {
                    $document->removeChild($item);
                }
            }
        } else {
            // @codingStandardsIgnoreStart
            @$document->loadHTML($html);
            // @codingStandardsIgnoreEnd
        }

        return $document;
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml(\DOMDocument $document, $encoding = 'UTF-8')
    {
        return $document->saveHTML();
    }
}
