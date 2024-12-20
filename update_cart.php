<?php
session_start();

header('Content-Type: application/json');

// Ajoutez cette ligne pour voir ce que PHP retourne :
error_log('Request data: ' . print_r($_POST, true));
error_log('Session data: ' . print_r($_SESSION['cart'], true));

// Vérification des données POST
if (!isset($_POST['id'], $_POST['quantity'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Données manquantes.'
    ]);
    exit;
}

$productId = $_POST['id'];
$newQuantity = (int)$_POST['quantity'];

if ($newQuantity < 1) {
    echo json_encode([
        'success' => false,
        'error' => 'La quantité doit être au moins 1.'
    ]);
    exit;
}

if (!isset($_SESSION['cart'][$productId])) {
    echo json_encode([
        'success' => false,
        'error' => 'Produit introuvable dans le panier.'
    ]);
    exit;
}

$_SESSION['cart'][$productId]['quantity'] = $newQuantity;

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

$response = [
    'success' => true,
    'total' => number_format($total, 2)
];

error_log('Response data: ' . json_encode($response));
echo json_encode($response);
