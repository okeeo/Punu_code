<?php
include('db.php'); // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $weight = $_POST['weight'] ?? NULL; // Si le champ est vide, il sera NULL
    $dimensions = $_POST['dimensions'] ?? NULL;
    $material = $_POST['material'] ?? NULL;
    $colors = $_POST['colors'] ?? NULL;

    // Gestion de l'upload de l'image
    $target_dir = "uploads/"; // Dossier où les images seront stockées
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérification si le fichier est une image réelle
    if (getimagesize($_FILES["image"]["tmp_name"]) === false) {
        die("Le fichier n'est pas une image.");
    }

    // Vérification de la taille du fichier (limite à 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        die("Désolé, l'image est trop grande.");
    }

    // Vérification des types de fichiers autorisés
    $allowedTypes = ["jpg", "png", "jpeg", "gif"];
    if (!in_array($imageFileType, $allowedTypes)) {
        die("Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.");
    }

    // Déplacer l'image téléchargée dans le dossier 'uploads'
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Désolé, une erreur est survenue lors de l'upload de l'image.");
    }

    // Requête SQL pour insérer les données dans la base de données
    $sql = "INSERT INTO items (image, title, price, description, weight, dimensions, material, colors) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }

    // Lier les paramètres à la requête préparée
    $stmt->bind_param("ssssssss", $target_file, $title, $price, $description, $weight, $dimensions, $material, $colors);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Item ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout : " . $stmt->error;
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
}
?>




<form action="add_item.php" method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="price">Price (€):</label>
    <input type="text" name="price" id="price" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="weight">Weight (kg):</label>
    <input type="text" name="weight" id="weight">

    <label for="dimensions">Dimensions (cm):</label>
    <input type="text" name="dimensions" id="dimensions">

    <label for="material">Material:</label>
    <input type="text" name="material" id="material">

    <label for="colors">Colors:</label>
    <input type="text" name="colors" id="colors">

    <label for="image">Image:</label>
    <input type="file" name="image" id="image" required accept="image/*">

    <button type="submit">Add Item</button>
</form>
