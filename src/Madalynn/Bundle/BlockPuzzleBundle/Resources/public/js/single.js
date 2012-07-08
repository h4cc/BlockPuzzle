/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

var REFRESH_INTERVAL = 20;

function SingleGame(canvas, id, width, height, tetrads)
{
    this.id        = id;
    this.b_width   = width;
    this.b_height  = height;
    this.width     = (width % 2 == 0) ? 2 * width : 2 * width + 1;
    this.height    = (height % 2 == 0) ? 2 * height : 2 * height + 1;
    this.selection = null;
    this.valid     = false;

    // The position
    this.startingPosition = {
        'x': (this.width - this.b_width) / 2,
        'y': (this.height - this.b_height) / 2
    };

    this.tetrads = new Array();
    for (var i = 0 ; i < tetrads.length ; i++) {
        this.tetrads.push(new Tetrad(tetrads[i]));
    }

    this.canvas = document.getElementById(canvas);
    this.ctx    = this.canvas.getContext('2d');

    this.canvas.width  = this.width  * BLOCK_SIZE;
    this.canvas.height = this.height * BLOCK_SIZE;

    // Double clicking problem
    $(this.canvas).bind('selectstart', function(e) { e.preventDefault(); return false; });

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
    $(this.canvas).bind('mouseup',   function(e) { that.onMouseUpListener(e); });
    $(this.canvas).bind('mousedown', function(e) { that.onMouseDownListener(e); });
    $(this.canvas).bind('mousemove', function(e) { that.onMouseMoveListener(e); });
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
        if (this.tetrads[i].dragging == true) {
            // Draw the dragged tetrad at the end
            continue;
        }

        this.tetrads[i].draw(this.ctx);
    }

    if (null !== this.selection) {
        this.selection.draw(this.ctx);
    }

    // the canvas is now in a valid state
    this.valid = true;
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

    this.selection = tetrad;

    tetrad.initializeFloatingPosition(pos);
    tetrad.dragging = true;

    this.invalidate();
}

/**
 * On mouse move listener
 */
SingleGame.prototype.onMouseMoveListener = function(e)
{
    if (this.selection == null) {
        return;
    }

    // update the position
    this.selection.updateFloatingPosition(this.getMouse(e));
    this.invalidate();
}

/**
 * On mouse up event
 */
SingleGame.prototype.onMouseUpListener = function(e)
{
    if (this.selection == null) {
        return;
    }

    var exactPosition = this.selection.updateFloatingPosition(this.getMouse(e));
    var droppingPosition = {
        'x': Math.round(exactPosition.x / BLOCK_SIZE),
        'y': Math.round(exactPosition.y / BLOCK_SIZE)
    };

    this.selection.dragging = false;

    // check collisions
    if (false == this.checkCollision(droppingPosition)) {
        this.selection.position = droppingPosition;

        // we need to check now if the game is over or not
        this.checkVictory();
    }

    this.selection = null;
    this.invalidate();
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
 * Checks if the game is over by looking the position
 * of all tetrads
 */
SingleGame.prototype.checkVictory = function()
{
    var end = true;
    for (var i = 0 ; i < this.tetrads.length ; i++) {
        var t = this.tetrads[i];
        if (this.startingPosition.x > t.position.x || t.position.x >= this.startingPosition.x + this.b_width ||
            this.startingPosition.y > t.position.y || t.position.y >= this.startingPosition.y + this.b_height ) {
            end = false;
            break;
        }
    }
}

/**
 * Gets the current position of tetrads
 */
SingleGame.prototype.getTetradsPosition = function()
{
    var tetrads = new Array();
    for (var i = 0 ; i <  this.tetrads.length ; i++) {
        var t = this.tetrads[i];
        tetrads.push({
            'id': t.id,
            'x': t.position.x,
            'y': t.position.y
        });
    }

    return tetrads;
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
 * Checks for collision between the selection tetrad
 * and the other tetrads
 */
SingleGame.prototype.checkCollision = function(pos)
{
    for (var i = 0 ; i < this.tetrads.length ; i++) {
        if (this.tetrads[i].id == this.selection.id) {
            continue;
        }

        if (this.tetrads[i].hasCollisionWith(this.selection, pos)){
            return true;
        }
    }

    return false;
}

/**
 * Clears the canvas
 */
SingleGame.prototype.clearCanvas = function()
{
    this.ctx.clearRect(0, 0, this.width * BLOCK_SIZE, this.height * BLOCK_SIZE);

    // Creation of the black box
    this.ctx.fillStyle = "rgba(0, 0, 0, 0.5)";
    this.ctx.fillRect(
        this.startingPosition.x * BLOCK_SIZE,
        this.startingPosition.y * BLOCK_SIZE,
        this.b_width * BLOCK_SIZE,
        this.b_height * BLOCK_SIZE
    );
}

/**
 * Invalidates the canvas
 */
SingleGame.prototype.invalidate = function()
{
    this.valid = false;
}