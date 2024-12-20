<?php
include('db.php'); // Connexion à la base de données

// Récupération de l'article à afficher
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $sql = "SELECT * FROM articles WHERE id = $article_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
        echo "<h1>" . $article['titre'] . "</h1>";
        echo "<div class='article-content'>" . $article['contenu'] . "</div>"; // Affichage du contenu avec HTML formaté
    } else {
        echo "Article non trouvé.";
    }
} else {
    echo "ID de l'article manquant.";
}
?>
