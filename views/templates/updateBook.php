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
            <a href="index.php?action=account"><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <a href="index.php?action=connectionForm">Connexion</a>
        </nav>
    </header>
    <main>
        <div class="breadcrumb">
            <a href="index.php?action=account"><- retour</a>
            <h1>Modifier les informations</h1>
        </div>

        <div class="contentb">
            <div class="book-image fifty">
                <img class="update" src="images/book/<?= $book->getId() ?>.jpg" alt="The Kinfolk Table">
                <br>
            </div>
            <div class="book-details fifty">
                <form action="index.php" method="post">
                    <label for="email">Titre</label>
                    <input type="title" name="title" id="title" required value="<?= Utils::format($book->getTitle()) ?>">
                    <label for="author">Auteur</label>
                    <input type="author" name="author" id="author" required
                        value="<?= Utils::format($book->getAuthor()) ?>">
                    <label for="text">Commentaire</label>
                    <textarea name="content" id="content" required rows="25"
                        cols="50"><?= Utils::format($book->getContent()) ?></textarea>
                    <label for="available">Disponibilité</label>
                    <select name="available" id="available" required>
                        <?php if ($book->getAvailable()){ ?>
                            <option value="1">Disponible</option>
                            <option value="0">Non dispo</option>
                        <?php } else{ ?>
                            <option value="0">Non dispo</option>
                            <option value="1">Disponible</option><?php } ?>
                        <option value="1">Disponible</option>
                        <option value="0">Non dispo</option>
                    </select>
                    <input type="hidden" name="id" value="<?= $book->getId() ?>">
                    <input type="hidden" name="action" value="updateBook">
                    <br>
                    <button type="submit" class="btn light validate">Valider</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a
                href="index.php?action=home">TomTroo ©</a> <a href="#"><img src="images/logot.svg"
                    alt="TomTroo Logo"></a></p>
    </footer>
</body>