<?php 

class BookController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getLastBooks();

        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }





    public function showBooks() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $view = new View("Accueil");
        $view->render("allBooks", ['books' => $books]);
    }

    
    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showBook() : void
    {
        // Récupération de l'id de l'article demandé.
        $id = Utils::request("id");


        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        
        
        if (!$book) {
            throw new Exception("L'article demandé n'existe pas.");
        }


        $view = new View($book->getTitle());
        $view->render("detailBook", ['book' => $book]);
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function myBook() : void
    {
        // Récupération de l'id de l'article demandé.
        $id = Utils::request("id");


        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        
        
        if (!$book) {
            throw new Exception("L'article demandé n'existe pas.");
        }


        $view = new View($book->getTitle());
        $view->render("updateBook", ['book' => $book]);
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function updateBook() : void
    {

        // On récupère les données du formulaire.
        $id = Utils::request("id");
        $title = Utils::request("title");
        $content = Utils::request("content");
        $available = Utils::request("available");
        $author = Utils::request("author");

        // On crée l'objet Article.
        $book = new Book([
            'id' => $id, // Si l'id vaut -1, l'article sera ajouté. Sinon, il sera modifié.
            'author' => $author,
            'content' => $content,
            'title' => $title,
            'available' => $available
        ]);

        // On ajoute l'article.
        $bookManager = new BookManager();
        $bookManager->UpdateBook($book);

        // On redirige vers la page d'administration.
        Utils::redirect("account");
    
    }

    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle() : void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos() {
        $view = new View("A propos");
        $view->render("apropos");
    }


    /**
     * Suppression d'un article.
     * @return void
     */
    public function deleteBook() : void
    {
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $owner = $bookManager->getBookById($id)->getIdUser();
        // On supprime l'article.
        if ($owner == $_SESSION['idUser']) {

        $bookManager = new BookManager();
        $bookManager->deleteBook($id);
        }
       
        // On redirige vers la page d'administration.
        Utils::redirect("account");
    }
}