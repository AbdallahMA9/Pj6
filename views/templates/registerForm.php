<?php
/**
 * Template pour afficher le formulaire de connexion.
 */
?>

<link rel="stylesheet" href="./css/login.css">
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
            <a href="index.php?action=connectionForm" class="active">Connexion</a>
        </nav>
    </header>
    <div class="login-container">
        <div class="login-form">
            <h1>Inscription</h1>
            <form action="index.php?action=createUser" method="post">
                <label for="username">Pseudo</label>
                <input type="text" name="username" id="username" required>
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <br>
                <button type="submit" class="btn">S'inscrire</button>
                <p>Vous avez déja un compte ? <a href="index.php?action=connectionForm">Connecter-vous</a></p>
            </form>
        </div>
        <div class="login-image">
            <img src="images/book/2.jpg" alt="Bookshelf">
        </div>
    </div>
    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a
                href="index.php?action=home">TomTroo ©</a> <a href="index.php?action=home"><img src="images/logot.svg"
                    alt="TomTroo Logo"></a></p>
    </footer>
</body>

</html>