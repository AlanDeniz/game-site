class Obstacles { 
constructor() { // Constructor funktionen er en speciel p5 funktion, hvis formål er at lave en objekt for mig. Uden stor mængder kode på sketch.js. 
                
    this.r = 35;
    this.x = width - this.r;
    this.y = height - this.r;
}
// hastigheden på obstacles (spikes)
move(){
    this.x -= 12;
   
}


 // vores obstacles (spikes)
show(){
    image(spikeImg, this.x, this.y, this.r, this.r)
}
}   
