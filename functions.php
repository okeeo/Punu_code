<?php
// Fonction pour récupérer les images supplémentaires d'un article
function getArticleImages($article_id) {
    global $conn;
    $sql = "SELECT * FROM article_images WHERE article_id = $article_id";
    $result = $conn->query($sql);
    $images = [];

    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image_url'];
    }

    return $images;
}
?>
