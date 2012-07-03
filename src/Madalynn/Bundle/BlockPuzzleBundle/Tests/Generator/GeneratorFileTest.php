<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Tests\Generator;

use Madalynn\Bundle\BlockPuzzleBundle\Generator\GeneratorFile;
use Madalynn\Bundle\BlockPuzzleBundle\Generator\GeneratorInterface;
use Madalynn\Bundle\BlockPuzzleBundle\Document\Level;

class GeneratorFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Madalynn\Bundle\BlockPuzzleBundle\Generator\GeneratorFile
     */
    protected $generator;

    public function setUp()
    {
        $this->generator = new GeneratorFile();
    }

    public function testReturnInstanceOfLevel()
    {
        $this->assertInstanceOf('Madalynn\\Bundle\\BlockPuzzleBundle\\Document\\Level', $this->generator->generate(GeneratorInterface::EASY));
        $this->assertInstanceOf('Madalynn\\Bundle\\BlockPuzzleBundle\\Document\\Level', $this->generator->generate(GeneratorInterface::EXTREM));
        $this->assertInstanceOf('Madalynn\\Bundle\\BlockPuzzleBundle\\Document\\Level', $this->generator->generate(GeneratorInterface::HARD));
        $this->assertInstanceOf('Madalynn\\Bundle\\BlockPuzzleBundle\\Document\\Level', $this->generator->generate(GeneratorInterface::MDEDIUM));
    }
}