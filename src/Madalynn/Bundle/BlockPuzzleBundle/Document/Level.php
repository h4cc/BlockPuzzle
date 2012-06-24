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
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\Document(repositoryClass="Madalynn\Bundle\BlockPuzzleBundle\Repository\LevelRepository")
 */
class Level
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Int
     */
    protected $width;

    /**
     * @MongoDB\Int
     */
    protected $height;

    /**
     * @MongoDB\EmbedMany(targetDocument="Tetrad")
     */
    protected $tetrads;

    /**
     * @MongoDB\Boolean
     */
    protected $finish;

    /**
     * @MongoDB\Date
     */
    protected $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tetrads = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Adds a new tetrad
     *
     * @param Tetrad $tetrad
     */
    public function addTetrad(Tetrad $tetrad)
    {
        $this->tetrads[] = $tetrad;
    }

    /**
     * Get tetrads
     *
     * @return array $tetrads
     */
    public function getTetrads()
    {
        return $this->tetrads;
    }

    /**
     * Set width
     *
     * @param int $width
     *
     * @return Level
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Set height
     *
     * @param int $height
     *
     * @return Level
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get width
     *
     * @return int $width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get height
     *
     * @return int $height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set finish
     *
     * @param boolean $finish
     *
     * @return Level
     */
    public function setFinish($finish)
    {
        $this->finish = $finish;
        return $this;
    }

    /**
     * Get finish
     *
     * @return boolean $finish
     */
    public function isFinish()
    {
        return $this->finish;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @MongoDB\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }
}
