
class Player { // Constructor funktionen er en speciel p5 funktion, hvis formål er at lave en objekt for mig. Uden stor mængder kode på sketch. 
    constructor(){
        this.r = 50;
        this.x = this.r;
        this.y = height - this.r;
        score = this.velocity = 0;
        this.gravity = 2;
    }

    jump(){  //hop
        if(this.y == height - this.r) {
            
            this.velocity = -28; //hastighed på hop
        }
       
    }
 
//collide - for at give obstacles(spikes) en hitbox
hits(obstacles){
    return collideRectRect(this.x, this.y, this.r , this.r, obstacles.x, obstacles.y, obstacles.r , obstacles.r );
    

}


    move(){
     this.y += this.velocity;
     this.velocity += this.gravity;
     this.y = constrain(this.y, 0, height - this.r);
    }
    
     
    // vores player
    show(){
        image(playerImg, this.x, this.y, this.r, this.r);
    }
}