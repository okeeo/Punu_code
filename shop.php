<?php
// Connexion à la base de données
$host = 'localhost';
$db = 'punu_db'; // Nom de ta base de données
$user = 'root';
$pass = ''; // Ton mot de passe MySQL (laisser vide si aucun)
include('db.php'); // Connexion à la base de données

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupère les articles depuis la table 'items'
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$items = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
} else {
    echo "Aucun article trouvé.";
}

// Ferme la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="Slick/slick-1.8.1/slick/slick.css">
    <title>Shop - Punu</title>
    <link rel="stylesheet" href="shop.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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


        <section class="section_links">
    <div class="links">
     <a href="index.php">Home</a>
     <p>/</p>
     <a href="shop.php">Shop</a>
    </div>

</section>

    
    <section class="section_shop">
        <!-- Filtres (comme sur Rodest) -->
        <div class="shop-container">
        <!-- Grille de produits -->
           <div class="shop-grid">

            <?php foreach ($items as $item): ?>

                <div class="product-card">

                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                        <a href="item.php?id=<?php echo $item['id']; ?>" class="btn-view-details"><p>add to cart   </p> </a>
                    </div>

                    <div class="product-info">
                        <h2><?php echo htmlspecialchars($item['title']); ?></h2>
                        <p class="product-price"><?php echo htmlspecialchars($item['price']); ?>€</p>
                    </div>

                </div>
            <?php endforeach; ?>
          </div>

          <div class="shop-filters">

            <h3>Filter by Price</h3>
            

            <label for="price"> </label>

            <input type="range" id="price" name="price" min="0" max="500" step="10">
            <span id="rangeValue"> 250</span>

            <select name="category" id="category">
                <option value="all">All Products</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
                <option value="category3">Category 3</option>
            </select>
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
        <script src="shop.js"></script>
</html>
