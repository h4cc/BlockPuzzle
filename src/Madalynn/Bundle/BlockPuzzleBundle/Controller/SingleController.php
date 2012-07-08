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
use Symfony\Component\HttpFoundation\JsonResponse;

class SingleController extends Controller
{
    public function newAction()
    {
        $manager = $this->get('block_puzzle.level.manager');
        $level   = $manager->create();

        return $this->redirect($this->generateUrl('single_play', array(
            'id' => $level->getId()
        )));
    }

    public function playAction($id)
    {
        $level = $this->get('block_puzzle.repository.level')->find($id);

        if (null === $level) {
            throw $this->createNotFoundException(sprintf('The level "%s" does not exist.', $id));
        }

        // @todo check if the game is over

        return $this->render('BlockPuzzleBundle:Single:play.html.twig', array(
            'level' => $level
        ));
    }

    public function checkAction($id)
    {
        return new JsonResponse();
    }
}
