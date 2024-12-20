<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Récupérer et sécuriser les données envoyées
    $product_id = intval($_POST['id'] ?? 0);
    $product_title = htmlspecialchars($_POST['title'] ?? '');
    $product_price = floatval($_POST['price'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);

    // Vérifier que les données minimales sont présentes
    if ($product_id && $product_title && $product_price) {
        // Initialiser le panier si nécessaire
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Vérifier si le produit est déjà dans le panier
        $product_exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $product_id) {
                $item['quantity'] += $quantity; // Ajouter la quantité
                $product_exists = true;
                break;
            }
        }

        // Si le produit n'existe pas, l'ajouter
        if (!$product_exists) {
            $_SESSION['cart'][] = [
                'id' => $product_id,
                'title' => $product_title,
                'price' => $product_price,
                'quantity' => $quantity,
            ];
        }

        // Redirection après ajout au panier
        header('Location: view_cart.php');
        exit;
    } else {
        echo "Données du produit invalides.";
    }
}
?>
