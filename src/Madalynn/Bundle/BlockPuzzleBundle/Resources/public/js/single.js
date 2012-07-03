/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

var BLOCK_SIZE = 50;
var REFRESH_INTERVAL = 20;

function SingleGame(canvas, width, height, tetrads)
{
    this.tetrads = tetrads;
    this.width   = width;
    this.height  = height;
    this.valid   = false;

    this.mainCanvas  = document.getElementById(canvas);
    this.mainCtx     = this.mainCanvas.getContext('2d');

    this.mainCanvas.width  = width  * BLOCK_SIZE;
    this.mainCanvas.height = height * BLOCK_SIZE;

    this.ghostCanvas = document.createElement('canvas');
    this.ghostCtx    = this.ghostCanvas.getContext('2d');

    this.ghostCanvas.width  = width  * BLOCK_SIZE;
    this.ghostCanvas.height = height * BLOCK_SIZE;

    $.each(this.tetrads, function(tetrad) {
        $.extend(tetrad, {
            'drag': false
        });
    });

    // Double clicking problem
    this.mainCanvas.onselectstart = function () {
        return false;
    }

    this.initialize();
}

/**
 * Initializes the canvas
 */
SingleGame.prototype.initialize = function()
{
    var that = this;
    setInterval(function() { that.drawCanvas(); }, REFRESH_INTERVAL);

    // listeners
    $(this.mainCanvas).bind('mouseup', function(e) { that.onMouseUpListener(e); });
    $(this.mainCanvas).bind('mousedown', function(e) { that.onMouseDownListener(e); });
}

/**
 * Draws the canvas
 */
SingleGame.prototype.drawCanvas = function()
{
    if (this.valid) {
        return;
    }

    this.clearCanvas(this.mainCtx);

    // tetrads
    for (var i = 0 ; i < this.tetrads.length ; i++) {
        this.drawTetrad(this.tetrads[i]);
    }

    // the canvas is now in a valid state
    this.valid = true;
}

/**
 * Clears a canvas
 */
SingleGame.prototype.clearCanvas = function(ctx)
{
    ctx.clearRect(0, 0, this.width, this.height);
}

/**
 * On mouse up event
 */
SingleGame.prototype.onMouseUpListener = function(e)
{
    // @todo
}

/**
 * On mouse down listener
 */
SingleGame.prototype.onMouseDownListener = function(e)
{
    // @todo
}

/**
 * Invalidates the canvas
 */
SingleGame.prototype.invalidate = function()
{
    this.valid = false;
}

/**
 * Draws a tetrad on the canvas
 */
SingleGame.prototype.drawTetrad = function(tetrad)
{
    var dx = tetrad.x;
    var dy = tetrad.y;

    for (var i = 0 ; i < tetrad.blocks.length ; i++) {
        var block = tetrad.blocks[i];

        // Translate the block to his current location
        var x = (dx + block.x) * BLOCK_SIZE;
        var y = (dy + block.y) * BLOCK_SIZE;

        this.mainCtx.fillRect(x, y, BLOCK_SIZE, BLOCK_SIZE);
    }
}