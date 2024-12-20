<?php
include('db.php');

// Récupérer tous les articles depuis la base de données
$sql = "SELECT id, titre, extrait, image_vedette, type_article FROM articles";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
        <link rel="stylesheet" href="style.css">
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
                    <a href="list_article.php">Blog</a>
                    <i class="fa-thin fa-arrow-down" class="arrows"></i>

                    <ul class="submenu">
                        <li><a href="list_article.php">Blog</a></li>
                    </ul>
                </li>   

                <li>
                    <a href="shop.php">Shop</a>
                    <i class="fa-thin fa-arrow-down" class="arrows"></i>

                    <ul class="submenu">
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="view_cart.php">Panier</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="about.html" class="main-menu">About</a>
                    <i class="fa-thin fa-arrow-down" class="arrows"></i> 

                    <ul class="submenu">
                        <li><a href="About.html">About</a></li>
                        
                    </ul>
                </li>
                 
                <li>
                    <a href="contact.html">Contact</a>
                    <i class="fa-thin fa-arrow-down" class="arrows"></i>

                    <ul class="submenu">
                        <li><a href="contact.html">Contact</a></li>
                        
                    </ul>
                </li>
                        
              </ul>
        </header>


        <section class="accueil">
  <div class="image-container">
    <h1>Where Culture</h1>
    <h2>Meets Creativity</h2>
  </div>
  <div class="nav-buttons">
    <button id="prev" class="nav-btn"><i class="fa-thin fa-arrow-up-left"></i>  Prev </button>
    <button id="next" class="nav-btn">Next <i class="fa-thin fa-arrow-up-right"></i></button>
  </div>
</section>
      
      <section class="content">
      
        <div class="grid-container">

          <div class="home">
            <a href="#"><img src="Assets/Images/archeBrique.jpg" alt=""></a>
            <p>home</p>
          </div>

          <div class="galerie">
            <a href="#"><img src="Assets/Images/acceuil-image.jpg" alt=""></a>
            <p>galerie</p>
          </div>

          <div class="blog">
            <a href="#"><img src="Assets/Images/Batiment gris.jpg" alt=""></a>
            <p>blog</p>
          </div>

          <div class="shop">
            <a href="#"><img src="Assets/Images/Colored Batiment.jpg" alt=""></a>
            <p>shop</p>
          </div>

          <div class="about">
            <a href="#"><img src="Assets/Images/Inside-Building.jpg" alt=""></a>
            <p>about</p>
          </div>

          <div class="contact">
            <a href="#"><img src="Assets/Images/archeBrique.jpg" alt=""></a>
            <p>contact</p>
          </div>      
        </div>
      
      </section>
      
      <section class="section_scroll">
     
            <div class="left_fixed">
              <a href="#"><img src="Assets/Images/Inside-Building.jpg" alt=""></a>
             </div>

            <div class="right_scroll">

            
                <div class="card_container">
                <?php include 'get_articles.php'; ?>
               </div>
        
            </div>

           
      </section>

      <section class="redirection">
      <div class="box-redirection">
        <a href="list_article.php"><p>More Articles <i class="fa-thin fa-arrow-down-left"></i></p></a>
      </div>
    </section>
      
      <section class="animated-text">
        <div class="moving-text-container">
            <div class="moving-text" >
                Where Culture Meets Creativity *
            </div>
            <div class="moving-text">
                Where Culture Meets Creativity *
            </div>
        </div>
      </section>

      

      <section class="section_caroussel">

           <div class="your-slider-class">
                <div><img src="Assets/Images/acceuil-image.jpg" alt="Image 1"></div>
                <div><img src="Assets/Images/eau_fond_blanc.jpg" alt="Image 2"></div>
                <div><img src="Assets/Images/TableChaise.jpg" alt="Image 3"></div>
                <div><img src="Assets/Images/Batiment gris.jpg" alt="Image 4"></div>
           </div>

               <div class="boutton_caroussel">
              
                  <button class="prev"> <i class="fa-thin fa-arrow-up-left"></i>  Prev  </button>

                  <button class="next"> Next <i class="fa-thin fa-arrow-up-right"></i></button>
               </div>
      </section>

      <section class="section_video">
        <div class="video-wrapper">
          <video src="Assets/Vidéos/femme-talk.mp4" class="video" ></video>
        
            <div class="play-button">
            <span>&#9658;</span> 
           </div>    
        </div>
      </section>

      <section class="section_citation">
        <div class="quote-slider">
            <div class="quote">
              <span class="quote-text"><i class="fa-solid fa-quote-right"></i>La créativité est contagieuse, partagez-la.<i class="fa-solid fa-quote-left"></i></span>
              <span class="quote-author">- Albert Einstein</span>
            </div>
            <div class="quote">
              <span class="quote-text"><i class="fa-solid fa-quote-right"></i>Le succès n'est pas final, l'échec n'est pas fatal : c'est le courage de continuer qui compte.<i class="fa-solid fa-quote-left"></i></span>
              <span class="quote-author">- Winston Churchill</span>
            </div>
            <div class="quote">
              <span class="quote-text"><i class="fa-solid fa-quote-right"></i>Votre temps est limité, ne le gâchez pas en vivant la vie de quelqu'un d'autre.<i class="fa-solid fa-quote-left"></i></span>
              <span class="quote-author">- Steve Jobs</span>
            </div>
          </div>
        </section>



      <section class="section_portfolio">
        
       <div class="photo_container">

        <div class="left">
           <img src="Assets/Images/eau_fond_blanc.jpg" alt="">
        </div>

        <div class="right">
          <img src="Assets/Images/acceuil-image.jpg" alt="">
          <img src="Assets/Images/TableChaise.jpg" alt="">
          <img src="Assets/Images/eau_fond_blanc.jpg" alt="">
          <img src="Assets/Images/TableChaise.jpg" alt="">
          <img src="Assets/Images/Inside-Building.jpg" alt="">
          <img src="Assets/Images/archeBrique.jpg" alt="">
        </div>

      </div>
      </section>

     <section>

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
    <

   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
    <script src="script.js"></script>
    <script src="caroussel.js"></script>
    <script src="test.js"></script>
</html>