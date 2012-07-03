<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Madalynn\Bundle\BlockPuzzleBundle\Util\ColorGenerator;

/**
 * @MongoDB\EmbeddedDocument
 */
class Tetrad
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $color;

    /**
     * @MongoDB\Collection
     */
    protected $blocks;

    /**
     * @MongoDB\Int
     */
    protected $width;

    /**
     * @MongoDB\Int
     */
    protected $height;

    /**
     * @MongoDB\Int
     */
    protected $x;

    /**
     * @MongoDB\Int
     */
    protected $y;

    public function __construct()
    {
        $this->blocks = array();
        $this->color  = ColorGenerator::generate();
    }

    public static function createFromXml(\SimpleXMLElement $root)
    {
        $tetrad = new self();
        $attr = $root->attributes();

        // Attributes
        $tetrad->setWidth((int) $attr['width']);
        $tetrad->setHeight((int) $attr['height']);
        $tetrad->setX((int) $attr['x']);
        $tetrad->setY((int) $attr['y']);

        foreach ($root as $block) {
            $data = array();
            $attr = $block->attributes();

            // Attributes
            $data['x'] = (int) $attr['x'];
            $data['y'] = (int) $attr['y'];

            $tetrad->blocks[] = $data;
        }

        return $tetrad;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY($y)
    {
        $this->y = $y;
    }
}
