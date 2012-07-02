/*
 * This file is part of the BlockPuzzle application
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Constructor
 */
function Canvas(id, width, height)
{
    this.id     = id;
    this.width  = width;
    this.height = height;

    this.canvas  = document.getElementById(id);
    this.context = this.canvas.getContext('2d');

    // Change the canvas size
    this.canvas.width  = width;
    this.canvas.height = height;
}

/**
 * Draws an image in the canvas
 */
Canvas.prototype.drawImage = function(path, x, y)
{
    var img = new Image();
    img.src = path;

    this.context.drawImage(img, x, y);
}

/**
 * Clears the canvas
 */
Canvas.prototype.clear = function()
{
    this.context.clearRect(0, 0, this.width, this.height);
}