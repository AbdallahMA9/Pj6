<?php

?>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="TomTroo Logo">
        </div>
        <div class="link">
            <a href="index.php?action=home">Accueil</a>
            <a href="index.php?action=books" class="active" >Nos livres à l'échange</a>
        </div>
        <nav>
            <a href="#"><img src="images/messagerie.svg" alt="messagerie icon">Messagerie</a>
            <a href="index.php?action=account"><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <?php if (isset($_SESSION['user'])) {?> <a href="index.php?action=disconnectUser">déonnexion</a> <?php } else {?> <a href="index.php?action=connectionForm">Connexion</a> <?php }?>

            
        </nav>
    </header>
    <center>
        <section class="hero all">
            <div class="content">
                <h1>Nos livres à l'échange</h1>

            </div>
            <div class="image-container">
                <p>Rechercher un livre</p>
            </div>
        </section>
    </center>
    <center>
    <section class="latest-books">

        <div class="books">
            <?php foreach($books as $book) { ?>
                <a class="info" href="index.php?action=showBook&id=<?= $book->getId() ?>">
                <div class="book">
                    <img src="images/book/<?= $book->getId() ?>.jpg"
                    alt="Esther">
                    <h3><?= Utils::format($book->getTitle()) ?></h3>
                    <p><?= Utils::format($book->getAuthor()) ?></p>
                    <div class="owner-name"><i>vendu par : <?= Utils::format($book->getUsername()) ?></i></div>
                </div>
                </a>
            <?php } ?>
        </div>
    </section>
    </center>


    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a href="#">TomTroo ©</a> <a
                href="#"><img src="images/logot.svg" alt="TomTroo Logo"></a></p>
    </footer>
</body>

</html>