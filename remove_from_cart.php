<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Vérifiez si le panier contient des articles
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        // Réindexez le tableau
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header('Location: view_cart.php');
exit;
?>
