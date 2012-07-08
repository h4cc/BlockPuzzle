<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Util;

class ColorGenerator
{
    static public function generate()
    {
        return array(
            'r' => rand(0, 255),
            'g' => rand(0, 255),
            'b' => rand(0, 255),
        );
    }
}