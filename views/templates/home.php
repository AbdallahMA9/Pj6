</head>

<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="TomTroo Logo">
        </div>
        <div class="link">
            <a href="index.php?action=home" class="active">Accueil</a>
            <a href="index.php?action=books ">Nos livres à l'échange</a>
        </div>
        <nav>
            <a class="messenger" href="index.php?action=message"><img src="images/messagerie.svg"
                    alt="messagerie icon">Messagerie<div class="notification">1</div></a>
            <a href="index.php?action=account"><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <?php if (isset($_SESSION['user'])) { ?> <a href="index.php?action=disconnectUser">déconnexion</a>
            <?php } else { ?> <a href="index.php?action=connectionForm">Connexion</a> <?php } ?>

        </nav>
    </header>
    <center>
        <section class="hero">
            <div class="content">
                <h1>Rejoignez nos lecteurs passionnés</h1>
                <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. TomTroo
                    est une
                    plateforme qui partage des passions et d'histoires à travers les livres.</p>
                <a class="btn" href="index.php?action=books">Découvrir</a>
            </div>
            <div class="image-container">
                <img src="images/hero.png" alt="Books">
                <p>Hamza</p>
            </div>
        </section>
    </center>
    <center>
        <section class="latest-books">
            <h2 class="section-title">Les derniers livres ajoutés</h2>

            <div class="books">
                <?php foreach ($books as $book) { ?>
                    <a class="info" href="index.php?action=showBook&id=<?= $book->getId() ?>">
                        <div class="book">
                            <img src="images/book/<?= $book->getId() ?>.jpg" alt="Esther">
                            <h3><?= Utils::format($book->getTitle()) ?></h3>
                            <p><?= Utils::format($book->getAuthor()) ?></p>
                            <div class="owner-name"><i>vendu par : <?= Utils::format($book->getUsername()) ?></i></div>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <a href="index.php?action=books" class="btn">Voir tous les livres</a>
        </section>
    </center>

    <section class="how-it-works">
        <h2 class="section-title">Comment ça marche ?</h2>
        <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
        <div class="steps">
            <div class="step">
                <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            </div>
            <div class="step">
                <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            </div>
            <div class="step">
                <p>Parcourez les livres disponibles des autres membres.</p>
            </div>
            <div class="step">
                <p>Proposez un échange et profitez de nouvelles lectures.</p>
            </div>
        </div>
        <a href="index.php?action=books" class="btn">Voir tous les livres</a>
    </section>

    <section class="values">

        <img src="images/Mask-group.jpg" alt="Values Image">
        <div class="values-text">
            <h2 class="section-title">Nos valeurs</h2>
            <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont
                ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous
                croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations
                enrichissantes.</p>
            <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.
            </p>
            <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se
                connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment
                sur les étagères.</p>
            <i>L'équipe Tom Troc</i>
        </div>
    </section>

    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a
                href="index.php?action=home">TomTroo ©</a> <a href="index.php?action=home"><img src="images/logot.svg"
                    alt="TomTroo Logo"></a></p>
    </footer>
</body>

</html>