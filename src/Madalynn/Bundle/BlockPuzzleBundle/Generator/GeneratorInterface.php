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

interface GeneratorInterface
{
    const EASY = 1;
    const MDEDIUM = 2;
    const HARD = 4;
    const EXTREM = 8;

    public function generate($difficulty);
}