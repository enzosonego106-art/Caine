<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="stylecaine.css">
    <meta charset="UTF-8">
    <title>That’s Caine</title>
</head>
<body>
    <div id="resultados"></div>
    <div class="dot"></div>
    <input type="text" id="input" class="input" placeholder="Digite algo...">
    <button onclick="enviar()">Enviar</button>

    <div id="particles-container"></div>

    <p id="saida"></p>

<script>
async function enviar() {

    const bola = document.querySelector(".dot");
    if (!bola) return;

    const rect = bola.getBoundingClientRect();
    const centroX = rect.left + rect.width / 2;
    const centroY = rect.top + rect.height / 2;

    // 🔴 ANIMAÇÃO
    for (let i = 0; i < 40; i++) {
        setTimeout(() => {
            const p = document.createElement("div");
            p.classList.add("particula");

            const lado = Math.floor(Math.random() * 4);
            let startX, startY;

            if (lado === 0) {
                startX = Math.random() * window.innerWidth;
                startY = -20;
            } else if (lado === 1) {
                startX = window.innerWidth + 20;
                startY = Math.random() * window.innerHeight;
            } else if (lado === 2) {
                startX = Math.random() * window.innerWidth;
                startY = window.innerHeight + 20;
            } else {
                startX = -20;
                startY = Math.random() * window.innerHeight;
            }

            p.style.left = startX + "px";
            p.style.top = startY + "px";

            document.getElementById("particles-container").appendChild(p);

            setTimeout(() => {
                p.style.transition = "all 1s ease-out";
                p.style.left = centroX + "px";
                p.style.top = centroY + "px";
                p.style.transform = "scale(0.2)";
                p.style.opacity = "0";
            }, 10);

            setTimeout(() => p.remove(), 1100);

        }, i * 30);
    }

    // IMAGENS CAINE APARECENDO NA TELA
        const imagens = [
            "caine_pixel.png"
            "bolha_pixel.png"
        ];

        for (let i = 0; i < 10; i++) {
            const img = document.createElement("img");

            // escolhe imagem aleatória
            const randomImg = imagens[Math.floor(Math.random() * imagens.length)];
            img.src = randomImg;

            // posição aleatória (sem sair da tela)
            const largura = window.innerWidth - 120;
            const altura = window.innerHeight - 120;

            const x = Math.random() * largura;
            const y = Math.random() * altura;

            img.style.left = x + "px";
            img.style.top = y + "px";

            document.body.appendChild(img);
        }
        }

    // ⏳ ESPERA animação terminar
    await new Promise(resolve => setTimeout(resolve, 1200));

    // 🔎 PESQUISA
    const texto = document.getElementById("input").value;
    const container = document.getElementById("resultados");

    if (!texto.trim()) return;

    container.innerHTML = "";

    try {

        const url = `https://api.unsplash.com/search/photos?query=${texto}&client_id=XN1qnSS9TGjlJqv1WwQQexiaXxzGkzu5z7FCSPYAIek`;

        const res = await fetch(url);
        const data = await res.json();

        // 🖼️ MOSTRAR UMA POR UMA
            data.results.forEach((img, index) => {

        setTimeout(() => {

            const imagem = document.createElement("img");
            imagem.src = img.urls.small;

            // 🔥 CLICK (SEU CÓDIGO INCLUÍDO)
            imagem.addEventListener("click", () => {
                const overlay = document.createElement("div");
                overlay.id = "overlay";

                const imgGrande = document.createElement("img");
                imgGrande.src = img.urls.regular;

                overlay.appendChild(imgGrande);
                document.body.appendChild(overlay);

                overlay.addEventListener("click", () => {
                    overlay.remove();
                });
            });

            // 🔴 posição inicial (bola)
            const bola = document.querySelector(".dot");
            const rect = bola.getBoundingClientRect();

            const startX = rect.left + rect.width / 2;
            const startY = rect.top + rect.height / 2;

            imagem.style.position = "fixed";
            imagem.style.left = startX + "px";
            imagem.style.top = startY + "px";
            imagem.style.width = "50px";
            imagem.style.opacity = "0";
            imagem.style.transform = "translate(-50%, -50%) scale(0.5)";
            imagem.style.transition = "all 0.6s ease-out";
            imagem.style.zIndex = "5";

            document.body.appendChild(imagem);

            // container final
            const container = document.getElementById("resultados");
            const placeholder = document.createElement("div");
            container.appendChild(placeholder);

            const finalRect = placeholder.getBoundingClientRect();

            // ✨ anima até a grid
            setTimeout(() => {
                imagem.style.left = finalRect.left + finalRect.width / 2 + "px";
                imagem.style.top = finalRect.top + finalRect.height / 2 + "px";
                imagem.style.width = "150px";
                imagem.style.opacity = "1";
                imagem.style.transform = "translate(-50%, -50%) scale(1)";
            }, 10);

            // 📦 encaixa na grid
            setTimeout(() => {
                imagem.style.position = "static";
                imagem.style.width = "100%";
                imagem.style.transform = "none";
                imagem.style.transition = "none";

                placeholder.replaceWith(imagem);
            }, 700);

        }, index * 120);
    });
    } catch (erro) {
        console.log(erro);
    }
}
</script>


</body>
</html>