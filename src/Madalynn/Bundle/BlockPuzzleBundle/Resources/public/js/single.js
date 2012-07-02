/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function SingleGame(canvas, width, height, tetrads)
{
    this.tetrads = tetrads;
    this.canvas  = new Canvas(canvas, width, height);

    this.initialize();
}

/**
 * Initializes the canvas
 */
SingleGame.prototype.initialize = function()
{
    this.drawCanvas();
}

/**
 * Draws the canvas
 */
SingleGame.prototype.drawCanvas = function()
{
    this.canvas.clear();
}