async function enviar() {
  const input = document.getElementById("input");
  const msg = input.value;

  if (!msg) return;

  // mensagem do usuário
  adicionarMensagem(msg, "user");

  try {
    const resposta = await fetch("api.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ mensagem: msg })
    });

    const data = await resposta.json();

    // resposta do bot
    adicionarMensagem(data.resposta, "bot");

  } catch (erro) {
    adicionarMensagem("Erro ao conectar com o servidor.", "bot");
    console.error(erro);
  }

  input.value = "";

      for (let i = 0; i < 40; i++) { //animação
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

}

function adicionarMensagem(texto, tipo) {
  const div = document.getElementById("mensagens");

  const msg = document.createElement("div");
  msg.classList.add("msg", tipo);
  msg.innerText = texto;

  div.appendChild(msg);
  div.scrollTop = div.scrollHeight;7

}
