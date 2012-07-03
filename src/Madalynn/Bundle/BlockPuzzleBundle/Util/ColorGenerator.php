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
        $c = '#'.strtoupper(dechex(rand(0,10000000)));

        if (7 !== strlen($c)){
            $c = str_pad($c, 10, '0', STR_PAD_RIGHT);
            $c = substr($c, 0, 7);
        }

        return $c;
    }
}