<?php

/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Madalynn\Bundle\BlockPuzzleBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

/**
 * BlockPuzzle Extension
 *
 * @author Julien Brochet <mewt@madalynn.eu>
 */
class BlockPuzzleExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('generator.xml');
        $loader->load('manager.xml');
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return 'http://www.madalynn.eu/schema/dic/block-puzzle';
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'block_puzzle';
    }
}