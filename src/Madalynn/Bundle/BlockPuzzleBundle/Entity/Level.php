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

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Madalynn\Bundle\BlockPuzzleBundle\Util\KeyGenerator;

/**
 * @ORM\Entity(repositoryClass="Madalynn\Bundle\BlockPuzzleBundle\Repository\LevelRepository")
 * @ORM\Table(name="bp_level")
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $width;

    /**
     * @ORM\Column(type="integer")
     */
    protected $height;

    /**
     * @ORM\OneToMany(targetEntity="Tetrad")
     */
    protected $tetrads;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $finish;

    /**
     * @ORM\Column(type="date")
     */
    protected $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->id = KeyGenerator::generate(8);
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
