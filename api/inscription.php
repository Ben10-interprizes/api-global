<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription des Employés</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
</head>

<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
}

h1 {
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="tel"] {
    width: calc(100% - 12px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

.btn-inscription {
    background-color: #007bff;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

.btn-inscription:hover {
    background-color: #0056b3;
}
</style>

<body>
    <div class="container">
        <h1>Inscription d'un Nouvel Employé</h1>
        <form id="inscriptionForm">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="numero">Numéro de téléphone (+229):</label>
                <input type="tel" id="numero" name="numero" pattern="[0-9]{10}"
                    title="Veuillez entrer un numéro de téléphone à 8 chiffres" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn-inscription">S'inscrire</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script src="inscription.js"></script>
</body>

</html>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const inscriptionForm = document.getElementById('inscriptionForm');

    inscriptionForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const nom = document.getElementById('nom').value;
        const prenom = document.getElementById('prenom').value;
        const numero = document.getElementById('numero').value;
        const email = document.getElementById('email').value;

        const formData = new FormData();
        formData.append('nom', nom);
        formData.append('prenom', prenom);
        formData.append('numero', '+229' + numero); // Ajouter l'indicatif
        formData.append('email', email);

        try {
            const response = await fetch('put.php', {
                method: 'POST',
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Inscription réussie! Veuillez copier et envoyer votre identifiant dans telegram',
                    text: data.message,
                });
                inscriptionForm.reset(); // Réinitialiser le formulaire après succès
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur d\'inscription',
                    text: data.message ||
                        'Une erreur s\'est produite lors de l\'inscription.',
                });
            }

        } catch (error) {
            console.error('Erreur de requête:', error);
            Swal.fire({
                icon: 'error',
                title: 'Erreur de réseau',
                text: 'Impossible de contacter le serveur.',
            });
        }
    });
});
</script>
