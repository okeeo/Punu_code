<?php
session_start();

// Vérifier si le panier existe
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link rel="stylesheet" type="text/css" href="Slick/slick-1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="Slick/slick-1.8.1/slick/slick-theme.css">       
    <link rel="stylesheet" href="viewcart.css">
    <title>Panier - PUNU</title>
</head>
<body>
<section>
    <div class="cart-container">
        <h1 class="cart-title">Votre Panier</h1>

        <?php if (empty($cart)) : ?>
            <p class="empty-cart-message">Votre panier est vide.</p>
        <?php else : ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($cart as $item) : ?>
        <?php $subtotal = $item['price'] * $item['quantity']; ?>
        <tr>
            <td class="product-info">
                <img src="path/to/image.jpg" alt="Product Image" class="product-image">
                <span class="product-title"><?php echo htmlspecialchars($item['title']); ?></span>
            </td>
            <td class="product-price"><?php echo number_format($item['price'], 2); ?>€</td>
            <td>
                <input 
                    type="number" 
                    name="quantity" 
                    value="<?php echo $item['quantity']; ?>" 
                    min="1" 
                    class="quantity-input" 
                    data-id="<?php echo $item['id']; ?>">
            </td>
            <td class="product-subtotal"><?php echo number_format($subtotal, 2); ?>€</td>
            <td>
                <form method="POST" action="remove_item.php">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <button type="submit" class="remove-btn">X</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
            </table>

            <div class="cart-summary">
                <?php 
                $total = array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart));
                ?>
                <h3>Total : <?php echo number_format($total, 2); ?>€</h3>
                <a href="checkout.php" class="checkout-btn">checkout</a>
            </div>
        <?php endif; ?>
    </div>
</section>
    <footer class="footer">
            <div class="footer-top">
                <div class="left">
                 <h2 class="logo">Punu</h2>
                 <form class="footer-form">
                   <input type="email" name="email" id="email" placeholder="Your Email">
                   <button type="submit">Send</button>
                </form>
                 <p>© 2024 PUNU, All Rights Reserved</p>
                </div>
                <div class="right">
                     <ul >
                         <a href=""><li>Our Team</li></a>
                          <a href=""><li>FAQs</li></a>
                          <a href=""><li>Contact</li></a>
                          <a href=""><li>What we do</li></a>
                       </ul>
    
                       <ul>
                         <a href=""> <li>About</li></a>
                         <a href=""> <li>Services</li></a>
                        <a href="">  <li>Get in Touch</li></a>
                       </ul>
    
                       <ul>
                         <a href=""> <li>Blog</li></a>
                         <a href=""> <li>Shop</li></a>
                        <a href=""> <li>Galerie</li></a>
                        <a href=""> <li>Portfolio</li></a>
                       </ul>
                </div>
    
            </div>
            <div class="footer-bottom">
                <ul class="social-links">
                    <a href=""><li>Facebook</li></a>
                    <a href=""><li>Instagram</li></a>
                    <a href=""><li>Twitter</li></a>
                    <a href=""><li>Threads</li></a>
                  </ul>
            </div>
          </footer>
    
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    $(".quantity-input").on("input", function () {
        const $row = $(this).closest("tr");
        const productId = $row.data("id");
        const newQuantity = $(this).val();

        // Vérifie si la quantité est valide
        if (newQuantity < 1) {
            alert("La quantité doit être au moins 1.");
            $(this).val(1); // Réinitialise à 1 si la quantité est invalide
            return;
        }

        // Envoie une requête AJAX pour mettre à jour le panier
        $.ajax({
            url: "update_cart.php",
            method: "POST",
            dataType: 'json', // Indique que la réponse doit être automatiquement interprétée en JSON
            data: {
                id: productId,
                quantity: newQuantity
            },
            success: function (response) {
                console.log("Server response:", response); // Debug: Affiche la réponse serveur dans la console

                if (response.success) {
                    // Met à jour le sous-total de la ligne
                    const price = parseFloat($row.find(".product-price").text().replace("€", "").trim());
                    const newSubtotal = (price * newQuantity).toFixed(2);
                    $row.find(".product-subtotal").text(`${newSubtotal}€`);

                    // Met à jour le total général
                    $(".cart-summary h3").text(`Total : ${response.total}€`);
                } else {
                    alert(response.error || "Une erreur s'est produite lors de la mise à jour.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Requête AJAX échouée :", status, error); // Debug: Affiche les détails de l'erreur
                console.error("Détails :", xhr.responseText); // Debug: Affiche la réponse brute du serveur
                alert("Erreur lors de la mise à jour de la quantité.");
            }
        });
    });
});
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
        <script src="script.js"></script>
        <script src="shop.js"></script>
        <script src="caroussel.js"></script>
</html>
