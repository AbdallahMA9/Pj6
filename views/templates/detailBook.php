
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
            <a href="#"><img src="images/messagerie.svg" alt="messagerie icon">Messagerie</a>
            <a href="#"><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <a href="#">Connexion</a>
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
                    <p>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table.</p>
                    <p>Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité.</p>
                    <p>Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers.</p>
                    <p>'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.</p>
                </div>
                <div class="owner">
                    <p>Propriétaire</p>
                    <div class="owner-details">
                        <img src="images/owner_image.jpg" alt="Owner Image">
                        <span><?= $book->getUsername() ?></span>
                    </div>
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