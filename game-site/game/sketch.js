let player;
let score;
let bgImg;
let bgImg2;
let marioImg;
let playerImg;
let spikeImg;
let bgSong;
let loading = true;
let jumpSound;


let obstacles = []; 

function preload(){ //Preload er en funktion i p5 library, som loader alle filer inden i funktionen før den starter setup.
                    

bgImg = loadImage ('images/game_banner.jpg');
bgImg2 = loadImage ('images/game_banner2.png');
marioImg = loadImage ('images/mario.png');
spikeImg = loadImage ('images/spikes.png');
jumpSound = loadSound('sound/jumpsound.wav');
hitSound = loadSound('sound/hit.wav');
playerImg = loadImage ('images/player.jpg' );


}


function soundLoaded(Song){ 
bgSong = Song;
bgSong.play();
loading = false;
}

function setup(){ // Setup er en funktion i p5 library, og bruges til at definere layoutet så som canvas størrelse.
    createCanvas(850, 550);
    player = new Player(); //se player.js for finde ud af hvad "new Player gør"
    jumpSound.playMode('restart');
    textAlign(CENTER);
    bgSong = loadSound('sound/bgsong.mp3', soundLoaded); 

    
}


function keyPressed() { // KeyPressed er en taste funktion, der bliver kaldt hverdan den angivet knap trykkes.
    if (key == 'w') {
      jumpSound.play();
        player.jump();
        
    } else if (key == ' '){
        jumpSound.play();
        player.jump();
    }
   
}



function draw() { // Draw(p5.js funktion) bliver kaldt direkte efter Setup, og bliver ved med at kører indtil den er stoppet.
                  // alt visuelle er typisk gjort inden i draw. 

    background(51);// loading skærm 
    if(loading) {
        textSize(50);
        fill('white');
         text("Loading...", width / 2, height / 2 );
         textSize(20);
         text("How to play:", width/2, height/2+ 100);
         text("Press 'W' or 'Spacebar' to jump over the obstacles.", width/2, height/2+ 120);
    }
   else {

                   // loading er færdig 

    if(random(1) < 0.0075) { 
        obstacles.push(new Obstacles()); //se obstacles.js for finde ud af hvad "new Player gør"
    }
    
    background(bgImg); // baggrunds billede
    // scorer
    score++;
    textSize(20);
    text("Score: " + score, width / 2, 30 );
    
   
    for (let obst of obstacles) {
        obst.move();
        obst.show();
        if (player.hits(obst)) { // hvis spilleren bliver ramt.
            hitSound.play();
            bgSong.stop();
            jumpSound.stop();
            textSize(40);
            text("GAME OVER", width / 2, height / 2);
            textSize(20);
            text("Press f5 to restart", width / 2, height / 2 + 40);
            noLoop();
            
        }
        
    }
    

    }
   
    if(loading) {
        textSize(50);
        fill('white');
         
        
    } else
    player.show();
    player.move();


} 

