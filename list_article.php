<?php
include('db.php');

// Récupérer tous les articles depuis la base de données
$sql = "SELECT id, titre, extrait, image_vedette, type_article FROM articles";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
        <link rel="stylesheet" href="list_article.css">
        <link rel="stylesheet" type="text/css" href="Slick/slick-1.8.1/slick/slick.css">
        <link rel="stylesheet" type="text/css" href="Slick/slick-1.8.1/slick/slick-theme.css">
        <title>Liste des Articles</title>
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
     <a href="list_article.php">Articles</a>
    </div>

</section>


<section class="section_article">
        <div class="articles-container">

    <?php if ($result->num_rows > 0): ?>

        <div class="articles-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="article-card">
                    <div class="article-card-container">

                        <a href="article.php?id=<?php echo $row['id']; ?>">

                        <p class="article-type"> <?php echo isset($row['type_article']) ? ucfirst($row['type_article']) : 'Non spécifié'; ?></p> 

                            <?php if (!empty($row['image_vedette'])): ?>
                                <img src="<?php echo $row['image_vedette']; ?>" alt="Image de l'article" class="article-image">
                            <?php endif; ?>

                            <h2 class="article-title"><?php echo $row['titre']; ?></h2>



                            <p class="article-excerpt"><?php echo $row['extrait']; ?></p>

                            <p class="read_more">Read more</p>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
     <?php else: ?>
        <p>Aucun article trouvé.</p>
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
</html>
