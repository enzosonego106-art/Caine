const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

// player
const player = {
    x: 100,
    y: 100,
    size: 20,
    speed: 4
};

// inimigo
const enemy = {
    x: 500,
    y: 300,
    size: 20,
    speed: 1.5
};

let keys = {};
let sanidade = 100;
let gameOver = false;

// controles
document.addEventListener("keydown", (e) => {
    keys[e.key.toLowerCase()] = true;
});

document.addEventListener("keyup", (e) => {
    keys[e.key.toLowerCase()] = false;
});

// movimento player
function movePlayer() {
    if (keys["w"]) player.y -= player.speed;
    if (keys["s"]) player.y += player.speed;
    if (keys["a"]) player.x -= player.speed;
    if (keys["d"]) player.x += player.speed;
}

// inimigo persegue
function moveEnemy() {
    let dx = player.x - enemy.x;
    let dy = player.y - enemy.y;

    let dist = Math.sqrt(dx * dx + dy * dy);

    enemy.x += (dx / dist) * enemy.speed;
    enemy.y += (dy / dist) * enemy.speed;
}

// colisão
function checkCollision() {
    let dx = player.x - enemy.x;
    let dy = player.y - enemy.y;
    let dist = Math.sqrt(dx * dx + dy * dy);

    if (dist < player.size) {
        sanidade -= 1;
    }
}

// desenhar
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // player
    ctx.fillStyle = "white";
    ctx.fillRect(player.x, player.y, player.size, player.size);

    // enemy
    ctx.fillStyle = "red";
    ctx.fillRect(enemy.x, enemy.y, enemy.size, enemy.size);
}

// loop principal
function gameLoop() {
    if (gameOver) return;

    movePlayer();
    moveEnemy();
    checkCollision();

    // sanidade cai com o tempo
    sanidade -= 0.02;

    document.getElementById("sanidade").innerText = "Sanidade: " + Math.floor(sanidade);

    if (sanidade <= 0) {
        gameOver = true;
        alert("Você enlouqueceu 💀");
        return;
    }

    draw();
    requestAnimationFrame(gameLoop);
}

gameLoop();