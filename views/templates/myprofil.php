<link rel="stylesheet" href="./css/profil.css">
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
            <a class="messenger" href="index.php?action=message"><img src="images/messagerie.svg"
                    alt="messagerie icon">Messagerie<div class="notification">1</div></a>
            <a href="index.php?action=account" class="active"><img src="images/compte.svg" alt="compte icon">Mon
                compte</a>
            <?php if (isset($_SESSION['user'])) { ?> <a href="index.php?action=disconnectUser">déconnexion</a>
            <?php } else { ?> <a href="index.php?action=connectionForm">Connexion</a> <?php } ?>
        </nav>
    </header>
    <center>
        <div class="container">
            <aside class="profile account">
                <img src="images/owner_image.jpg" alt="Profile Picture" class="profile-pic">
                <h2><?= Utils::format($user->getUsername()) ?></h2>
                <p>Membre depuis 1 an</p>
                <p>Bibliothèque</p>
                <p><span class="book-count">4</span> livres</p>

            </aside>
            <aside class="profile account">
                <form action="index.php" method="post">
                    <h3>Vos informations personnelles</h3>
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" required value="<?= Utils::format($user->getEmail()) ?>">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required value="password">
                    <label for="password">Pseudo</label>
                    <input type="username" name="username" id="username" required
                        value="<?= Utils::format($user->getUsername()) ?>">
                    <input type="hidden" name="action" value="updateUser">
                    <button type="submit" class="btn light">Modifier</button>
                </form>
            </aside>
        </div>
        <div class="container">
            <section class="profil-books larger">

                <div class="profil-book title">
                    <p>Photo</p>

                    <p>Titre</p>
                    <p>Auteur</p>
                    <div class="large">
                        <p>Description</p>
                    </div>
                    <p>DISPONINBILITE</p>
                    <p>Action</p>

                </div>
                <?php foreach ($books as $book) { ?>
                    <div class="profil-book">
                        <img src="images/book/2.jpg" alt="The Kinfolk Table">

                        <p><?= Utils::format($book->getTitle()) ?></p>
                        <p><?= Utils::format($book->getAuthor()) ?></p>
                        <div class="large">
                            <p><?= Utils::format($book->getContent()) ?></p>
                        </div>
                        <?php if ($book->getAvailable()) { ?>
                            <div class="available">
                                <p>disponible</p>
                            </div>
                        <?php } else { ?>
                            <div class="no-available">
                                <p>non dispo.</p>
                            </div>
                        <?php }
                        ?>

                        <div class="link"> <a href="index.php?action=myBook&id=<?= $book->getId() ?>"
                                class="update">Editer</a><a href="index.php?action=deleteBook&id=<?= $book->getId() ?>"
                                class="delete">supprimer</a></div>
                    </div>
                <?php } ?>
            </section>


        </div>
    </center>


    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a
                href="index.php?action=home">TomTroo ©</a> <a href="index.php?action=home"><img src="images/logot.svg"
                    alt="TomTroo Logo"></a></p>
    </footer>
</body>

</html>