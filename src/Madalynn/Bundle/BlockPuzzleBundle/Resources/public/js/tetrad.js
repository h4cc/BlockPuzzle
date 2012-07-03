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
 * Checks if the mouse position is on the current tetrad
 */
Tetrad.prototype.contains = function(pos)
{
    for (var i = 0 ; i < this.blocks.length ; i++) {
        var x = (this.blocks[i].x + this.position.x) * BLOCK_SIZE;
        var y = (this.blocks[i].y + this.position.y) * BLOCK_SIZE;

        if (x <= pos.x && pos.x < x + BLOCK_SIZE && y <= pos.y && pos.y < y + BLOCK_SIZE) {
            return true;
        }
    }

    return false;
}

/**
 * Draws the tetrad into a context
 */
Tetrad.prototype.draw = function(ctx)
{
    var dx, dy;

    if (false == this.dragging) {
        dx = this.position.x * BLOCK_SIZE;
        dy = this.position.y * BLOCK_SIZE;
    } else {
        dx = this.floatingPosition.x;
        dy = this.floatingPosition.y;
    }

    // change the fill color
    ctx.fillStyle = this.color;

    for (var i = 0 ; i < this.blocks.length ; i++) {
        var block = this.blocks[i];
        var x = dx + block.x * BLOCK_SIZE;
        var y = dy + block.y * BLOCK_SIZE;

        ctx.fillRect(x, y, BLOCK_SIZE, BLOCK_SIZE);
    }
}