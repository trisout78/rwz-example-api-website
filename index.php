<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raccourcir un lien</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Lien à raccourcir :</h1>
        <form id="shortenForm">
            <input type="text" id="urlInput" placeholder="Entrez votre lien ici" required>
            <button type="submit">Envoyer</button>
        </form>
        <p id="result"></p>
    </div>
    <script>
        document.getElementById('shortenForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const url = document.getElementById('urlInput').value;
            try {
                const response = await fetch('shorten.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ url: url })
                });
                const data = await response.json();
                if (data.error === 0) {
                    const shortUrl = data.shorturl;
                    const resultElement = document.getElementById('result');
                    resultElement.textContent = `URL raccourcie : ${shortUrl}`;
                    navigator.clipboard.writeText(shortUrl).then(() => {
                        alert('Lien copié');
                    });
                } else {
                    alert('Erreur lors de la génération du lien raccourci.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Erreur lors de la génération du lien raccourci.');
            }
        });
    </script>
</body>
</html>
