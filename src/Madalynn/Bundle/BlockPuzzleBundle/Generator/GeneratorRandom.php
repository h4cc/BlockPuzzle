<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Generator;

use Madalynn\Bundle\BlockPuzzleBundle\Document\Level;

class Generator implements GeneratorInterface
{
    public function generate($difficulty)
    {
        return new Level();
    }
}