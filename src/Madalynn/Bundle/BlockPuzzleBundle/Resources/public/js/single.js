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
    this.width   = width;
    this.height  = height;
    this.tetrads = tetrads;
    this.context = $(canvas)[0].getContext('2d');

}

$(document).ready(function() {
    var game = new SingleGame();

    // @todo later
})