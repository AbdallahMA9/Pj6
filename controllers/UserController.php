<?php 

class UserController {
    public function showCreateUserForm() : void 
    {
        $view = new View("Création d'un utilisateur");
        $view->render("registerForm");
    }

    public function createUser() : void 
    {
        $username = Utils::request("username");
        $email = Utils::request("email");
        $password = Utils::request("password");

        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        $userManager = new UserManager();
        $userManager->addUser($user);

        Utils::redirect("home");
    }

    public function updateUser() : void 
    {
        $username = Utils::request("username");
        $email = Utils::request("email");
        $password = Utils::request("password");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User([
            'id'=> $_SESSION['idUser'],
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        $userManager = new UserManager();
        $userManager->modifyUser($user);

        Utils::redirect("account");
    }

    public function showAdmin() : void
    {
        $this->checkIfUserIsConnected();
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();
        $view = new View("Administration");
        $view->render("admin", ['articles' => $articles]);
    }

    public function showProfil() : void
    {
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

    public function myProfil() : void
    {
        $this->checkIfUserIsConnected();
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

    private function checkIfUserIsConnected() : void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    public function displayConnectionForm() : void 
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    public function connectUser() : void 
    {
        $email = Utils::request("email");
        $password = Utils::request("password");

        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Le mot de passe est incorrect");
        }

        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        Utils::redirect("home");
    }

    public function disconnectUser() : void 
    {
        unset($_SESSION['user']);
        Utils::redirect("home");
    }

  
}
