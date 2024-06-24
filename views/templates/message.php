
    <link rel="stylesheet" href="./css/message.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="TomTroo Logo">
        </div>
        <div class="link">
            <a href="index.php?action=home" >Accueil</a>
            <a href="index.php?action=books ">Nos livres à l'échange</a>
        </div>
        <nav>
            <a href="#" class="active"><img src="images/messagerie.svg" alt="messagerie icon">Messagerie</a>
            <a href="#" ><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <a href="index.php?action=connectionForm" >Connexion</a>

            
        </nav>
    </header>
    <div class="messaging-container">
        <div class="sidebar">
            <h2>Messagerie</h2>
            <div class="contact message-active">
                <img src="images/owner_image.jpg" alt="User 1">
                <div class="contact-info">
                    <h3>Alexlecture</h3>
                    <p>Lorem ipsum dolor sit amet,...</p>
                </div>
                <span class="time">15:43</span>
            </div>
            <div class="contact">
                <img src="images/owner_image.jpg" alt="User 2">
                <div class="contact-info">
                    <h3>Nathalire</h3>
                    <p>Lorem ipsum dolor sit amet,...</p>
                </div>
                <span class="time">20.08</span>
            </div>
            <div class="contact">
                <img src="images/owner_image.jpg" alt="User 3">
                <div class="contact-info">
                    <h3>Sas634</h3>
                    <p>Lorem ipsum dolor sit amet,...</p>
                </div>
                <span class="time">15.08</span>
            </div>
        </div>
        <div class="chat-window">
            <div class="chat-header">
                <img src="images/owner_image.jpg" alt="Alexlecture">
                <h3>Alexlecture</h3>
            </div>
            <div class="chat-messages">
                <?php foreach ($messages as $message): ?>
                    <div class="message <?= $message->getIdUser() == $_SESSION['idUser'] ? 'sent' : 'received' ?>">
                        <p><?= htmlspecialchars($message->getContent()) ?></p>
                        <span class="time"><?= htmlspecialchars($message->getDateCreation()->format('d/m H:i')) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="chat-input">
                <form action="index.php?action=addMessage" method="post">
                    <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($receiverId) ?>">
                    <input type="text" name="content" placeholder="Tapez votre message ici" required>
                    <button type="submit" class="btn">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a href="index.php?action=home">TomTroo ©</a> <a
                href="index.php?action=home"><img src="images/logot.svg" alt="TomTroo Logo"></a></p>
    </footer>
</body>
</html>
