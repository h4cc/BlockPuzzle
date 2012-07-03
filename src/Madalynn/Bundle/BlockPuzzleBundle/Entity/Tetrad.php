<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Madalynn\Bundle\BlockPuzzleBundle\Util\ColorGenerator;

/**
 * @ORM\Entity
 * @ORM\Table(name="bp_tetrad")
 */
class Tetrad
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $color;

    /**
     * @ORM\Column(type="array")
     */
    protected $blocks;

    /**
     * @ORM\Column(type="integer")
     */
    protected $width;

    /**
     * @ORM\Column(type="integer")
     */
    protected $height;

    /**
     * @ORM\ManyToOne(targetEntity="Level", inversedBy="tetrads")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     */
    protected $level;

    /**
     * @ORM\Column(type="integer")
     */
    protected $x;

    /**
     * @ORM\Column(type="integer")
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

    /**
     * Sets level
     *
     * @param Level $level A level instance
     */
    public function setLevel(Level $level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Gets level
     *
     * @return Level
     */
    public function getLevel()
    {
        return $this->level;
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
