<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylecaine2.css">
        <title>That’s Caine</title>
    <head>
    <body>
        <div class="bolinha"></div>
        <div class="container-botoes">
            <button onclick="imagens()">Imagens do Caine</button>
            <button onclick="chat()">Converse com o Caine</button>
            <button onclick="avent()">Entre em uma Aventura</button>
        </div>

        <script>
            function imagens() {
                window.location.href = "http://localhost/Digital.Circus_cmd/imagens.php";
            }

            function chat() {
                window.location.href = "http://localhost/Digital.Circus_cmd/chat.php";
            }

            function avent() {
                window.location.href = "http://localhost/Digital.Circus_cmd/aventura.php";
            }
        </script>
    </body>
<html>
