
    <link rel="stylesheet" href="./css/login.css">
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
            <a href="#"><img src="images/messagerie.svg" alt="messagerie icon">Messagerie</a>
            <a href="#"><img src="images/compte.svg" alt="compte icon">Mon compte</a>
            <a href="index.php?action=connectionForm" class="active">Connexion</a>

            
        </nav>
    </header>
    <div class="login-container">
        <div class="login-form">
            <h1>Connexion</h1>
            <form action="index.php?action=connectUser" method="post">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <button type="submit" class="btn">Se Connecter</button>
                <p>Pas de compte ? <a href="index.php?action=registerForm">Inscrivez-vous</a></p>
            </form>
        </div>
        <div class="login-image">
            <img src="images/book/2.jpg" alt="Bookshelf">
        </div>
    </div>
    <footer>
        <p><a href="#">Politique de confidentialité</a> <a href="#">Mentions légales</a> <a href="index.php?action=home">TomTroo ©</a> <a
                href="index.php?action=home"><img src="images/logot.svg" alt="TomTroo Logo"></a></p>
    </footer>
</body>
</html>
