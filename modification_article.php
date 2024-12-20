<?php
include('db.php');

// Vérifier si l'ID de l'article est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Récupérer les données de l'article
    $sql = "SELECT * FROM articles WHERE id = $article_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        echo "Article non trouvé.";
        exit;
    }
} else {
    echo "ID de l'article manquant.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier l'article</h1>
    <form action="modifier_article.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" value="<?php echo $article['titre']; ?>" required>

        <label for="extrait">Extrait :</label>
        <textarea name="extrait" id="extrait" required rows="10" cols="50"><?php echo $article['extrait']; ?></textarea>

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required rows="10" cols="50"><?php echo $article['contenu']; ?></textarea>

        <label for="image_vedette">Image vedette :</label>
        <input type="file" name="image_vedette" id="image_vedette">

        <button type="submit">Mettre à jour l'article</button>
    </form>
</body>
</html>
