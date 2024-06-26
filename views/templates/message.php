<link rel="stylesheet" href="./css/message.css">
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
    <div class="messaging-container">
        <div class="sidebar">
            <h2>Messagerie</h2>

            <div class="contact message-active">
                <img src="images/owner_image.jpg" alt="User 1">
                <div class="contact-info">
                    <h3><?= Utils::format($receiver->getUsername()) ?></h3>
                    <p>Lorem ipsum dolor sit amet,...</p>
                </div>
                <span class="time">15:43</span>
            </div>
            <?php foreach ($contacts as $contact) {
                if ($contact->getId() != $receiver->getId()) { ?>
                    <a href="index.php?action=message&id=<?= $contact->getId() ?>">
                        <div class="contact">
                            <img src="images/owner_image.jpg" alt="<?= Utils::format($contact->getUsername()) ?>">
                            <div class="contact-info">
                                <h3><?= Utils::format($contact->getUsername()) ?></h3>
                                <!-- Affichez ici le dernier message échangé avec ce contact -->
                                <p>Lorem ipsum dolor sit amet,...</p>
                            </div>
                            <!-- Affichez ici l'heure du dernier message échangé -->
                            <span class="time">15:43</span>
                        </div>
                    </a>
                <?php }
            } ?>
        </div>
        <div class="chat-window">
            <div class="chat-header">
                <img src="images/owner_image.jpg" alt="Alexlecture">
                <h3><?= Utils::format($receiver->getUsername()) ?></h3>
            </div>
            <div class="chat-messages">
                <?php foreach ($messages as $message): ?>
                    <div class="message <?= $message->getIdUser() == $_SESSION['idUser'] ? 'sent' : 'received' ?>">
                        <div class="message-header">
                            <img src="images/owner_image.jpg" alt="Profile Image">
                            <span class="time"><?= Utils::format($message->getDateCreation()->format('d/m H:i')) ?></span>
                        </div>
                        <p><?= Utils::format($message->getContent()) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="chat-input">
                <form action="index.php?action=addMessage" method="post">
                    <input type="hidden" name="receiver_id" value="<?= Utils::format($receiverId) ?>">
                    <input type="text" name="content" placeholder="Tapez votre message ici" required>
                    <button type="submit" class="btn">Envoyer</button>
                </form>
            </div>
        </div>

    </div>
    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a
                href="index.php?action=home">TomTroo ©</a> <a href="index.php?action=home"><img src="images/logot.svg"
                    alt="TomTroo Logo"></a></p>
    </footer>
</body>

</html>