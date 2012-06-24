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
use Madalynn\Bundle\BlockPuzzleBundle\Document\Tetrad;
use Symfony\Component\Finder\Finder;

class GeneratorFile implements GeneratorInterface
{
    public function generate($difficulty)
    {
        $iterator = Finder::create()
                        ->in(__DIR__.'/../Resources/fixtures')
                        ->name('*.xml');

        $files = iterator_to_array($iterator);
        $file  = $files[array_rand($files)];
        $level = new Level();

        $element = simplexml_load_file($file->getPathname());
        $attr = $element->attributes();

        $level->setHeight((int) $attr['height']);
        $level->setWidth((int) $attr['width']);

        $element = $element->children();
        $element = $element[0]; // pieces node

        foreach ($element as $tetrad) {
            $level->addTetrad(Tetrad::createFromXml($tetrad));
        }

        return $level;
    }
}