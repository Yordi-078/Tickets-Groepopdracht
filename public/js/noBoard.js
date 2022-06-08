const canvas = document.getElementById('canvas')
const c = canvas.getContext('2d')
const startLoc = [-100, 55]
const panda = new Image()
panda.src = '/getImage/15';
var p

panda.classList = 'Character-spritesheet'
class Character {

    constructor(x, y){
        this.x = x
        this.y = y
        this.xSpeed = 2
        this.xFrame = 3
        this.yFrame = 0
    }
/**
 * {panda} == the image
 * {this.xFrame} == the horizontal part of the spritesheet you want times 100 because 1 character == 100px
 * {this.yFrame} == the vertical part of the spritesheet you want (we have only 1 row so no changes needed)
 * {100} == the horizontal width you want from the starting point(this.xFrame)
 * {128} == the vertical height you want from the starting point(this.yFrame)
 * {this.x} == the horizontal position on the canvas you want to place the panda on
 * {this.y} == the vertical position on the canvas you want to place the panda on
 * {60} == the new width of the panda
 * {96} == the new height of the panda
 */
    show(){
        c.imageSmoothingEnabled = true;
        c.drawImage(panda, this.xFrame * 100, this.yFrame, 100, 128, this.x, this.y, 50, 96)
    }

    update(){
        this.x += this.xSpeed
    }
}


window.onload = function(){
    start()
    setInterval(reset, 13000)
    setInterval(update, 50)
    setInterval(walkingLoop, 300)
    
}

function start(){
    p = new Character(startLoc[0], startLoc[1])
}

function update(){
    canvas.width = canvas.width
    // panda
    p.show()
    p.update()
}

function walkingLoop(){
    if(p.xFrame == 3){
        p.xFrame = 0
        return
    }
    p.xFrame ++
}

function reset(){
    p.x = -100
    console.log('start over')
}