<?php 
/**
 * Contrôleur de la partie admin.
 */
 
class UserController {


    /**
     * Affiche le formulaire de création d'un utilisateur.
     * @return void
     */
    public function showCreateUserForm() : void 
    {

        $view = new View("Création d'un utilisateur");
        $view->render("registerForm");
    }

    /**
     * Crée un nouvel utilisateur.
     * @return void
     */
    public function createUser() : void 
    {
        // On récupère les données du formulaire.
        $username = Utils::request("username");
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On hache le mot de passe.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // On crée l'objet User.
        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        // On ajoute l'utilisateur.
        $userManager = new UserManager();
        $userManager->addUser($user);

        // On redirige vers la page d'administration.
        Utils::redirect("home");
    }

    /**
     * Crée un nouvel utilisateur.
     * @return void
     */
    public function updateUser() : void 
    {
        // On récupère les données du formulaire.
        $username = Utils::request("username");
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On hache le mot de passe.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        // On modifie l'objet User.
        $user = new User([
            'id'=> $_SESSION['idUser'],
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        // On modifie l'utilisateur.
        $userManager = new UserManager();
        $userManager->modifyUser($user);

        Utils::redirect("account");
    }


    /**
     * Affiche la page d'administration.
     * @return void
     */
    public function showAdmin() : void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // On récupère les articles.
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        // On affiche la page d'administration.
        $view = new View("Administration");
        $view->render("admin", [
            'articles' => $articles
        ]);
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showProfil() : void
    {
        // Récupération de l'id de l'user demandé.
        $id = Utils::request("id", -1);
        if ($id == $_SESSION['idUser']) {
            Utils::redirect("account");
        }

        $userManager = new UserManager();
        $user = $userManager->getUserById($id);
        
        $bookManager = new BookManager();
        $books = $bookManager->getBooksByUser($id);

        if (!$user) {
            throw new Exception("L'utilisateur n'existe pas.");
        }


        $view = new View($user->getUsername());
        $view->render("profil", ['user' => $user, 'books' => $books]);
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function myProfil() : void
    {
        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();
        // Récupération de l'id de l'article demandé.
        $id = $_SESSION['idUser'];


        $userManager = new UserManager();
        $user = $userManager->getUserById($id);
        
        $bookManager = new BookManager();
        $books = $bookManager->getBooksByUser($id);

        if (!$user) {
            throw new Exception("L'utilisateur n'existe pas.");
        }


        $view = new View($user->getUsername());
        $view->render("myprofil", ['user' => $user, 'books' => $books]);
    }

    public function showAdminArticle() : void 
    {

        // On vérifie que l'utilisateur est connecté.
        $this->checkIfUserIsConnected();

        // Récupérer les paramètres de tri de la requête (GET ou POST)
        $sortBy = $_GET['sortBy'] ?? 'date_creation';
        $order = $_GET['order'] ?? 'asc';

        // On récupère les articles.
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles($sortBy, $order);

        // On récupère le nombre de commentaires pour chaque article.
        foreach ($articles as $article) {
            $article->commentCount = $articleManager->getCommentCountForArticle($article->getId());
        }

        // On affiche la page d'administration.
        $view = new View("Administration");
        $view->render("listesarticle", [
            'articles' => $articles,
            'sortBy' => $sortBy,
            'order' => $order
        ]);
    
    }
    

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm() : void 
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser() : void 
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        // On redirige vers la page d'administration.
        Utils::redirect("home");
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser() : void 
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }

    /**
     * Affichage du formulaire d'ajout d'un article.
     * @return void
     */
    public function showUpdateArticleForm() : void 
    {
        $this->checkIfUserIsConnected();

        // On récupère l'id de l'article s'il existe.
        $id = Utils::request("id", -1);

        // On récupère l'article associé.
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        // Si l'article n'existe pas, on en crée un vide. 
        if (!$article) {
            $article = new Article();
        }

        // On affiche la page de modification de l'article.
        $view = new View("Edition d'un article");
        $view->render("updateArticleForm", [
            'article' => $article
        ]);
    }

    /**
     * Ajout et modification d'un article. 
     * On sait si un article est ajouté car l'id vaut -1.
     * @return void
     */
    public function updateArticle() : void 
    {
        $this->checkIfUserIsConnected();

        // On récupère les données du formulaire.
        $id = Utils::request("id", -1);
        $title = Utils::request("title");
        $content = Utils::request("content");

        // On vérifie que les données sont valides.
        if (empty($title) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires. 2");
        }

        // On crée l'objet Article.
        $article = new Article([
            'id' => $id, // Si l'id vaut -1, l'article sera ajouté. Sinon, il sera modifié.
            'title' => $title,
            'content' => $content,
            'id_user' => $_SESSION['idUser']
        ]);

        // On ajoute l'article.
        $articleManager = new ArticleManager();
        $articleManager->addOrUpdateArticle($article);

        // On redirige vers la page d'administration.
        Utils::redirect("admin");
    }


    /**
     * Suppression d'un article.
     * @return void
     */
    public function deleteArticle() : void
    {
        $this->checkIfUserIsConnected();

        $id = Utils::request("id", -1);

        // On supprime l'article.
        $articleManager = new ArticleManager();
        $articleManager->deleteArticle($id);
       
        // On redirige vers la page d'administration.
        Utils::redirect("admin");
    }
    public function deleteComment() : void
    {
        $this->checkIfUserIsConnected();

        $id = Utils::request("id", -1);

        $articleManager = new ArticleManager();
        $articleManager->deleteComment($id);

        Utils::redirect("admin");
    }
}