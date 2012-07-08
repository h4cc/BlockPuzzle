<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Twig\Extension;

use Madalynn\Bundle\BlockPuzzleBundle\Entity\Level;

class BlockPuzzleExtension extends \Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'dump_parameters' => new \Twig_Function_Method($this, 'dumpParameters'),
            'dump_tetrads'    => new \Twig_Function_Method($this, 'dumpTetrads')
        );
    }

    /**
     * Dumps tetrads into an array
     *
     * @param Level $level The level
     *
     * @return array
     */
    public function dumpTetrads(Level $level)
    {
        $data = array();
        foreach ($level->getTetrads() as $tetrad) {
            $data[] = array(
                'id'     => $tetrad->getId(),
                'color'  => $tetrad->getColor(),
                'width'  => $tetrad->getWidth(),
                'height' => $tetrad->getHeight(),
                'blocks' => $tetrad->getBlocks(),
            );
        }

        return $data;
    }

    /**
     * Dumps parameters
     *
     * @param Level $level The level
     */
    public function dumpParameters(Level $level)
    {
        return array(
            'id'     => $level->getId(),
            'width'  => $level->getWidth(),
            'height' => $level->getHeight(),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'block_puzzle';
    }
}