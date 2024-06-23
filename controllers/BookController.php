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
        $id = Utils::request("id", -1);


        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        
        
        if (!$book) {
            throw new Exception("L'article demandé n'existe pas.");
        }


        $view = new View($book->getTitle());
        $view->render("detailBook", ['book' => $book]);
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
}