<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    public function singleAction()
    {
        $manager = $this->get('block_puzzle.level.manager');
        $level   = $manager->create();

        return $this->render('BlockPuzzleBundle:Game:single.html.twig', array(
            'level' => $level
        ));
    }
}
