<?php
require_once "./database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? htmlentities($_POST['nom']) : '';
    $prenom = isset($_POST['prenom']) ? htmlentities($_POST['prenom']) : '';
    $numero = isset($_POST['numero']) ? htmlentities($_POST['numero']) : ''; // Récupérer le numéro
    $email = isset($_POST['email']) ? htmlentities($_POST['email']) : '';

    function genererIdentifiantEmploye($longueur = 8)
    { // Identifiant plus long pour l'exemple
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $longueurMax = strlen($caracteres) - 1;
        $identifiant = '';
        for ($i = 0; $i < $longueur; $i++) {
            $identifiant .= $caracteres[rand(0, $longueurMax)];
        }
        return $identifiant;
    }

    // verifier si existe

    $selc = "SELECT * FROM employers WHERE identifiant = ''";

    function insererEmploye($nom, $identifiant, $prenom, $numero, $email, $db)
    { // Ajouter le paramètre $numero
        if (!$db) {
            return ['success' => false, 'message' => 'Erreur de connexion à la base de données.'];
        }

        $sql = "INSERT INTO employers (nom, identifiant, prenom, numero, email) VALUES (:nom, :identifiant, :prenom, :numero, :email)"; // Inclure la colonne numero

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':identifiant', $identifiant);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':numero', $numero); // Lier le numéro
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return [
                'success' => true,
                'message' => '' + $identifiant
            ];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de l\'inscription: ' . $e->getMessage()];
        }
    }

    // Générer l'identifiant côté serveur
    $identifiant = genererIdentifiantEmploye();

    // Tenter d'insérer l'employé
    $resultatInscription = insererEmploye($nom, $identifiant, $prenom, $numero, $email, $db); // Passer le numéro à la fonction

    // Envoyer la réponse JSON au client
    header('Content-Type: application/json');
    echo json_encode($resultatInscription);
} else {
    // Si la requête n'est pas POST
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Méthode non autorisée.';
}
