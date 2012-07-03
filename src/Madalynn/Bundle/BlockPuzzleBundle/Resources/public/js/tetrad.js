/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

var BLOCK_SIZE = 50;

function Tetrad(params)
{
    this.blocks   = params.blocks;
    this.width    = params.width;
    this.height   = params.height;
    this.color    = params.color;
    this.dragging = false;

    // @todo the starting position need to be calculate
    this.position = {
        'x': 0,
        'y': 0
    }

    // the position when the tetrad is dragged
    this.floatingPosition = {
        'x': null,
        'y': null
    }
}

/**
 * Draws the tetrad into a context
 */
Tetrad.prototype.draw = function(ctx)
{
    var dx = this.position.x;
    var dy = this.position.y;

    // change the fill color
    ctx.fillStyle = this.color;

    for (var i = 0 ; i < this.blocks.length ; i++) {
        var block = this.blocks[i], x, y;

        if (false == this.dragging) {
            x = (dx + block.x) * BLOCK_SIZE;
            y = (dy + block.y) * BLOCK_SIZE;
        } else {
            x = this.floatingPosition.x;
            y = this.floatingPosition.y;
        }

        ctx.fillRect(x, y, BLOCK_SIZE, BLOCK_SIZE);
    }
}