
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="TomTroo Logo">
        </div>
        <div class="link">
            <a href="index.php?action=home">Accueil</a>
            <a href="index.php?action=books ">Nos livres à l'échange</a>
        </div>
        <nav>
        <a class="messenger" href="index.php?action=message"><img src="images/messagerie.svg" alt="messagerie icon">Messagerie<div class="notification">1</div></a>
            <a href="index.php?action=account"><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <a href="index.php?action=connectionForm">Connexion</a>
        </nav>
    </header>
    <main>
        <div class="breadcrumb">
            <a href="#">Nos livres</a> > <span><?= $book->getTitle() ?></span>
        </div>
        <div class="contentb">
            <div class="book-image">
                <img src="images/book/<?= $book->getId() ?>.jpg" alt="The Kinfolk Table">
            </div>
            <div class="book-details">
                <h1><?= $book->getTitle() ?></h1>
                <h2>par <?= $book->getAuthor() ?></h2>
                <div class="description">
                    <h3>Description</h3>
                    <p><?= Utils::format($book->getContent()) ?></p>
                </div>
                <div class="owner">
                    <p>Propriétaire</p>
                    <a href="index.php?action=profil&id=<?= $book->getIdUser() ?>" class="owner-details">
                        <img src="images/owner_image.jpg" alt="Owner Image">
                        <span><?= $book->getUsername() ?></span>
                    </a>
                </div>
                <a href="index.php?action=message&id=<?= $book->getIdUser() ?>" class="send-message">Envoyer un message</a>
            </div>
        </div>
    </main>
    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a href="index.php?action=home">TomTroo ©</a> <a
                href="#"><img src="images/logot.svg" alt="TomTroo Logo"></a></p>
    </footer>
</body>