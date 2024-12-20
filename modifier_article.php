<?php
include('db.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $article_id = $_POST['id'];
    $titre = $_POST['titre'];
    $extrait = $_POST['extrait'];
    $contenu = $_POST['contenu'];

    // Traitement de l'image vedette (si elle est modifiée)
    $image_vedette = $article_id; // On garde l'ancienne image si aucune nouvelle image n'est envoyée
    if (isset($_FILES['image_vedette']) && $_FILES['image_vedette']['error'] === 0) {
        $image_vedette = 'uploads/articles/' . $_FILES['image_vedette']['name'];
        move_uploaded_file($_FILES['image_vedette']['tmp_name'], $image_vedette);
    }

    // Mise à jour de l'article dans la base de données
    $sql = "UPDATE articles 
            SET titre = '$titre', extrait = '$extrait', contenu = '$contenu', image_vedette = '$image_vedette' 
            WHERE id = $article_id";

    if ($conn->query($sql) === TRUE) {
        echo "Article mis à jour avec succès.";
    } else {
        echo "Erreur: " . $conn->error;
    }
}
?>
