<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Level;

use Madalynn\Bundle\BlockPuzzleBundle\Generator\GeneratorInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * The level manager
 */
class Manager
{
    /**
     * The generator
     *
     * @var GeneratorInterface
     */
    protected $generator;

    /**
     * The document manager
     *
     * @var DocumentManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param GeneratorInterface $generator
     */
    public function __construct(GeneratorInterface $generator, DocumentManager $manager)
    {
        $this->generator = $generator;
        $this->manager   = $manager;
    }

    /**
     *
     * @param int $difficulty
     */
    public function create($difficulty = GeneratorInterface::EASY)
    {
        $level = $this->generator->generate($difficulty);

        $this->manager->persist($level);
        $this->manager->flush();

        return $level;
    }
}