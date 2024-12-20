<?php
include 'db.php'; // Inclure la connexion à la base de données

$sql = "SELECT id, titre, extrait, image_vedette FROM articles"; // Requête SQL pour récupérer les articles
$result = $conn->query($sql);

// Vérifier si des résultats ont été trouvés
if ($result->num_rows > 0) {
    // Afficher chaque article sous forme de carte
    while($row = $result->fetch_assoc()) {
        // Créer un lien vers l'article en utilisant son ID
        $articleUrl = "article.php?id=" . $row["id"];
        echo '<div class="card">';
        echo '<a href="' . $articleUrl . '">';  // Lien vers la page de l'article
        echo '<img src="' . $row["image_vedette"] . '" alt="Image de la carte" />';
        echo '<h4>' . $row["titre"] . '</h4>';
        echo '<p>' . $row["extrait"] . '</p>';
        echo '</a>';  // Fermeture du lien
        echo '</div>';
    }
} else {
    echo "Aucun article trouvé";
}

$conn->close(); // Fermer la connexion
?>
