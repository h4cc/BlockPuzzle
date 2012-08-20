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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/single")
 */
class SingleController extends Controller
{
    /**
     * @Route("/new", name="single_new")
     */
    public function newAction()
    {
        $manager = $this->get('block_puzzle.level.manager');
        $level   = $manager->create();

        return $this->redirect($this->generateUrl('single_play', array(
            'id' => $level->getId()
        )));
    }

    /**
     * @Route("/play/{id}", name="single_play")
     * @Template
     */
    public function playAction($id)
    {
        $level = $this->get('block_puzzle.repository.level')->find($id);

        if (null === $level) {
            throw $this->createNotFoundException(sprintf('The level "%s" does not exist.', $id));
        }

        // @todo check if the game is over

        return array('level' => $level);
    }

    /**
     * @Route("/check/{id}", name="single_check")
     */
    public function checkAction($id)
    {
        return new JsonResponse();
    }
}
