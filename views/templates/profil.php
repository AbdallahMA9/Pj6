    <link rel="stylesheet" href="./css/profil.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="TomTroo Logo">
        </div>
        <div class="link">
            <a href="index.php?action=home" class="active" >Accueil</a>
            <a href="index.php?action=books ">Nos livres à l'échange</a>
        </div>
        <nav>
            <a href="#"><img src="images/messagerie.svg" alt="messagerie icon">Messagerie</a>
            <a href="#"><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <?php if (isset($_SESSION['user'])) {?> <a href="index.php?action=disconnectUser">déonnexion</a> <?php } else {?> <a href="index.php?action=connectionForm">Connexion</a> <?php }?>

            
        </nav>
    </header>
    <div class="container">
        <aside class="profile">
            <img src="images/owner_image.jpg" alt="Profile Picture" class="profile-pic">
            <h2><?= Utils::format($user->getUsername()) ?></h2>
            <p>Membre depuis 1 an</p>
            <p>Bibliothèque</p>
            <p><span class="book-count">4</span> livres</p>
            <a href="index.php?action=message&id=<?= $user->getId()?>" class="btn">Écrire un message</a>
        </aside>

        <section class="profil-books">
            <?php foreach($books as $book) { ?>
            <div class="profil-book">
                <img src="images/book/2.jpg" alt="The Kinfolk Table">
                
                    <p><?= Utils::format($book->getTitle()) ?></p>
                    <p><?= Utils::format($book->getAuthor()) ?></p>
                    <p><?= Utils::format($book->getContent()) ?></p>
            </div>
            <?php } ?>
        </section>
    </div>

    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a href="index.php?action=home">TomTroo ©</a> <a
                href="index.php?action=home"><img src="images/logot.svg" alt="TomTroo Logo"></a></p>
    </footer>
</body>

</html>