<?php
session_start();
// Connexion à la base de données
include('db.php');

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupère l'ID du produit passé dans l'URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    // Récupère les informations du produit spécifique
    $sql = "SELECT * FROM items WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Définir les variables nécessaires
        $product_title = $product['title'] ?? 'Titre non disponible';
        $product_price = $product['price'] ?? 0;
        $product_image_url = $product['image'] ?? 'placeholder.jpg'; // Image par défaut
    } else {
        echo "<p>Produit non trouvé. Retournez à <a href='index.php'>l'accueil</a>.</p>";
        exit;
    }
} else {
    echo "<p>ID de produit manquant. Retournez à <a href='index.php'>l'accueil</a>.</p>";
    exit;
}

$conn->close();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
        <link rel="stylesheet" href="item.css">
        <link rel="stylesheet" type="text/css" href="Slick/slick-1.8.1/slick/slick.css">
        <link rel="stylesheet" type="text/css" href="Slick/slick-1.8.1/slick/slick-theme.css">
        <title>PUNU</title>
    </head>

    <body>
        <header class="header">
            <nav class="navbar">   
              <button class="boutton-menu">( Menu )</button>
              <div class="logo">PUNU</div>
              <button class="moreInfo">More info</button>
            </nav>
          
            <ul class="menu" id="menu">

                <li >
                 <a href="#Galerie">Home</a>
                    <i class="fa-thin fa-arrow-down" class="arrows"></i>

                    <ul class="submenu">
                        <li><a href="#">Photos</a></li>
                        <li><a href="#">Vidéos</a></li>
                        <li><a href="#">zzzz</a></li>
                        <li><a href="#">eeeeee</a></li>
                        <li><a href="#">tttttt</a></li>
                    </ul>
                </li>
             
                <li>
                    <a href="#Blog">Blog</a>
                    <i class="fa-thin fa-arrow-down"></i>

                    <ul class="submenu">
                        <li><a href="#">Photos</a></li>
                        <li><a href="#">Vidéos</a></li>
                    </ul>
                </li>   

                <li>
                    <a href="#Shop">Shop</a>
                    <i class="fa-thin fa-arrow-down"></i>

                    <ul class="submenu">
                        <li><a href="#">Photos</a></li>
                        <li><a href="#">Vidéos</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="#About" class="main-menu">About</a>
                    <i class="fa-thin fa-arrow-down"></i> 

                    <ul class="submenu">
                        <li><a href="#">Photos</a></li>
                        <li><a href="#">Vidéos</a></li>
                    </ul>
                </li>
                 
                <li>
                    <a href="#Contact">Contact</a>
                    <i class="fa-thin fa-arrow-down"></i>

                    <ul class="submenu">
                        <li><a href="#">Photos</a></li>
                        <li><a href="#">Vidéos</a></li>
                    </ul>
                </li>
                        
              </ul>
        </header>
        
        <section class="main_section">

         <div class="item_container">

                    <div class="item_image">
                         <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
                  </div>

               <div class="item_content">
                   <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                      <p class="prix"><?php echo htmlspecialchars($product['price']); ?>€</p>

               <p class="item-description"><?php echo htmlspecialchars($product['description']); ?></p>

               <form action="cart.php" method="POST" class="product-form">

             <input type="hidden" name="id" value="<?php echo htmlspecialchars($product_id); ?>">
             <input type="hidden" name="title" value="<?php echo htmlspecialchars($product['title']); ?>">
             <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
  
    <div class="quantity-counter">
        <label for="quantity"></label>
        <input type="number" name="quantity" class="quantity-input" value="1" min="1"> 
        <div class="quantity-btn-container">
                                <button class="quantity-btn plus">+</button>
                                <button class="quantity-btn minus">-</button>
                            </div>
    </div>
    <button type="submit" name="add_to_cart" class="btn-buy">Add to cart</button>
</form>

              </div>
         </div>

        </section>

        <section class="section_info">

    <div class="product-tabs">

        <div class="tabs">
            <button class="tab active" data-tab="description">Description</button>
            <button class="tab" data-tab="additional-info">Additional Info</button>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="description">
                <p><?php echo htmlspecialchars($product['description']); ?></p>
            </div>

            <div class="tab-pane" id="additional-info">
                <ul class="list-info">
                    <li>Weight: <?php echo htmlspecialchars($product['weight'] ?? 'Non spécifié'); ?></li>
                    <li>Dimensions: <?php echo htmlspecialchars($product['dimensions'] ?? 'Non spécifié'); ?></li>
                    <li>Material: <?php echo htmlspecialchars($product['material'] ?? 'Non spécifié'); ?></li>
                    <li>Colors: <?php echo htmlspecialchars($product['colors'] ?? 'Non spécifié'); ?></li>
                </ul>
            </div>
        </div>
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
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
        <script src="script.js"></script>
        <script src="shop.js"></script>
        <script src="caroussel.js"></script>
    </html>
</html>