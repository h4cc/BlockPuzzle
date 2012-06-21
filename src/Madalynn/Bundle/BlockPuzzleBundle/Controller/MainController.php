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

/**
 * Main Controller
 *
 * @author Julien Brochet <mewt@madalynn.eu>
 */
class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('BlockPuzzleBundle:Main:homepage.html.twig');
    }
}
