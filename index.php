<?php


require_once 'config/config.php';
require_once 'config/autoload.php';

require_once 'models/User.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $articleController = new BookController();
            $articleController->showHome();
            break;

        case 'books':
            $articleController = new BookController();
            $articleController->showBooks();
            break;

        case 'message':
            $messageController = new MessageController();
            $messageController->Message();
            break;

        case 'addMessage':
            $messageController = new MessageController();
            $messageController->addMessage();
            break;

        case 'apropos':
            $articleController = new BookController();
            $articleController->showApropos();
            break;
        
        case 'showBook': 
            $articleController = new BookController();
            $articleController->showBook();
            break;

        case 'addArticle':
            $articleController = new BookController();
            $articleController->addArticle();
            break;

        case 'addComment':
            $commentController = new CommentController();
            $commentController->addComment();
            break;

        case 'admin': 
            $userController = new UserController();
            $userController->showAdmin();
            break;
        case 'listearticle': 
            $userController = new UserController();
            $userController->showAdminArticle();
            break;

        case 'connectionForm':
            $userController = new UserController();
            $userController->displayConnectionForm();
            break;

        case 'registerForm':
            $userController = new UserController();
            $userController->showCreateUserForm();
            break;

        case 'createUser':
            $userController = new UserController();
            $userController->createUser();
            break;

        case 'connectUser': 
            $userController = new UserController();
            $userController->connectUser();
            break;

        case 'disconnectUser':
            $userController = new UserController();
            $userController->disconnectUser();
            break;

        case 'showUpdateArticleForm':
            $userController = new UserController();
            $userController->showUpdateArticleForm();
            break;

        case 'updateArticle': 
            $userController = new UserController();
            $userController->updateArticle();
            break;

        case 'deleteArticle':
            $userController = new UserController();
            $userController->deleteArticle();
            break;
        case 'deleteComment': 
            $userController = new UserController();
            $adminController->deleteComment();
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
