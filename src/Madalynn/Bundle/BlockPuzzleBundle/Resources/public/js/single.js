/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

var REFRESH_INTERVAL = 20;

function SingleGame(canvas, width, height, tetrads)
{
    this.width     = width;
    this.height    = height;
    this.selection = null;
    this.valid     = false;

    this.tetrads = new Array();
    for (var i = 0 ; i < tetrads.length ; i++) {
        this.tetrads.push(new Tetrad(tetrads[i]));
    }

    this.canvas = document.getElementById(canvas);
    this.ctx    = this.canvas.getContext('2d');

    this.canvas.width  = width  * BLOCK_SIZE;
    this.canvas.height = height * BLOCK_SIZE;

    // Double clicking problem
    $(this.canvas).bind('selectstart', function(e) { e.preventDefault(); });

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
    $(this.canvas).bind('mouseup', function(e) { that.onMouseUpListener(e); });
    $(this.canvas).bind('mousedown', function(e) { that.onMouseDownListener(e); });
}

/**
 * Draws the canvas
 */
SingleGame.prototype.drawCanvas = function()
{
    if (this.valid) {
        return;
    }

    this.clearCanvas();

    // tetrads
    for (var i = 0 ; i < this.tetrads.length ; i++) {
        this.tetrads[i].draw(this.ctx);
    }

    // the canvas is now in a valid state
    this.valid = true;
}

/**
 * Clears a canvas
 */
SingleGame.prototype.clearCanvas = function()
{
    this.ctx.clearRect(0, 0, this.width * BLOCK_SIZE, this.height * BLOCK_SIZE);
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
    var pos    = this.getMouse(e);
    var tetrad = this.findTetrad(pos);

    if (tetrad == null) {
        return;
    }

    // @todo move the tetrad
}

/**
 * Gets the mouse coordinates relative to the canvas
 */
SingleGame.prototype.getMouse = function(e)
{
    var element = this.canvas
    var dx = 0;
    var dy = 0;

    if (element.offsetParent !== undefined) {
        do {
            dx += element.offsetLeft;
            dy += element.offsetTop;
        } while ((element = element.offsetParent));
    }

    return {
        'x': e.clientX - dx + window.pageXOffset,
        'y': e.clientY - dy + window.pageYOffset
    };
}

/**
 * Finds the first tetrad on the mouse position
 */
SingleGame.prototype.findTetrad = function(pos)
{
    for (var i = 0 ; i < this.tetrads.length ; i++) {
        if (this.tetrads[i].contains(pos)){
            return this.tetrads[i];
        }
    }

    return null;
}

/**
 * Invalidates the canvas
 */
SingleGame.prototype.invalidate = function()
{
    this.valid = false;
}