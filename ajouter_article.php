<?php
include('db.php'); // Connexion à la base de données

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $titre = $conn->real_escape_string($_POST['titre']);
    $type_article = $conn->real_escape_string($_POST['type_article']);
    $extrait = $conn->real_escape_string($_POST['extrait']);
    $contenu = $conn->real_escape_string($_POST['contenu']);
    $video_url = isset($_POST['video_url']) ? $conn->real_escape_string($_POST['video_url']) : null;

    // Téléchargement de l'image de l'article (image vedette)
    $image_vedette = '';
    if (isset($_FILES['image_vedette']) && $_FILES['image_vedette']['error'] === 0) {
        $image_vedette = 'uploads/articles/' . $_FILES['image_vedette']['name'];
        move_uploaded_file($_FILES['image_vedette']['tmp_name'], $image_vedette);
    }

    // Insertion de l'article dans la base de données
    $sql = "INSERT INTO articles (titre, type_article, extrait, contenu, image_vedette, video_url) 
            VALUES ('$titre', '$type_article', '$extrait', '$contenu', '$image_vedette', '$video_url')";
    
    if ($conn->query($sql) === TRUE) {
        // Récupérer l'ID de l'article inséré
        $article_id = $conn->insert_id;

        // Traitement des images supplémentaires
        if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
            for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
                $image_url = 'uploads/articles/' . $_FILES['images']['name'][$i];
                move_uploaded_file($_FILES['images']['tmp_name'][$i], $image_url);
                
                // Insertion de l'image dans la base de données
                $sql_image = "INSERT INTO article_images (article_id, image_url) 
                              VALUES ('$article_id', '$image_url')";
                $conn->query($sql_image);
            }
        }

        echo "Article ajouté avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>

    <!-- Lien vers les fichiers CSS de Trumbowyg -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg/dist/plugins/upload/ui/trumbowyg.upload.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg/dist/plugins/align/ui/trumbowyg.align.min.css">
    <!-- Lien vers jQuery (requis pour Trumbowyg) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Lien vers le fichier JavaScript de Trumbowyg -->
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg/dist/trumbowyg.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg/dist/plugins/align/trumbowyg.align.min.js"></script>
</head>
<body>
    <h1>Ajouter un article</h1>

    <form action="ajouter_article.php" method="POST" enctype="multipart/form-data">
    <label for="titre">Titre principal :</label>
    <input type="text" id="titre" name="titre" required>

    <label for="type_article">Type d'article :</label>
    <select id="type_article" name="type_article" required>
    <option value="mode">Mode</option>
        <option value="beaute">Beauté</option>
        <option value="culture">Culture</option>
        <option value="cuisine">Cuisine</option>
        <option value="social">Social</option>
        <option value="musique">Musique</option>
        <option value="art">Art</option>
        <option value="voyage">Voyage</option>
        <option value="lifestyle">Lifestyle</option>
        <option value="defiles">Défilés</option>
    </select>

    <label for="extrait">Extrait :</label>
    <textarea id="extrait" name="extrait" required></textarea>

    <label for="contenu">Contenu de l'article :</label>
    <textarea id="contenu" name="contenu" class="trumbowyg" required></textarea>

    <label for="image_vedette">Image vedette :</label>
    <input type="file" name="image_vedette" accept="image/*">

    <label for="images">Images supplémentaires :</label>
    <input type="file" name="images[]" accept="image/*" multiple>

    <label for="video_url">URL de la vidéo (YouTube, Vimeo) :</label>
    <input type="url" id="video_url" name="video_url" placeholder="https://">

    <button type="submit">Ajouter l'article</button>
</form>

    <script>
       $(document).ready(function() {
    $('#contenu').trumbowyg({
        btns: [
            ['bold', 'italic', 'underline'],
            ['link', 'insertImage'],
            ['unorderedList', 'orderedList'],
            ['formatting'],
            ['upload'],  // Ajout du bouton d'upload de fichiers
            ['undo', 'redo']
            ['align']
        ],
        plugins: {
            align: true,
            upload: {
                url: '/path/to/your/upload/endpoint',  // URL vers le script de gestion de l'upload
                fileFieldName: 'file',  // Nom du champ pour le fichier dans le formulaire
                data: {}  // Données supplémentaires à envoyer avec l'upload
            }
        }
    });
});
    </script>
</body>
</html>
