<?php 

class BookController 
{
    public function showHome() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getLastBooks();
        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }

    public function showBooks(): void
    {
        $bookManager = new BookManager();
        $searchTerm = $_GET['search'] ?? '';
        $books = $bookManager->getAllBooks($searchTerm);
        $view = new View("Accueil");
        $view->render("allBooks", ['books' => $books]);
    }

    public function showBook() : void
    {
        $id = Utils::request("id");
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        if (!$book) {
            throw new Exception("L'article demandé n'existe pas.");
        }
        $view = new View($book->getTitle());
        $view->render("detailBook", ['book' => $book]);
    }

    public function myBook() : void
    {
        $id = Utils::request("id");
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        if (!$book) {
            throw new Exception("L'article demandé n'existe pas.");
        }
        $view = new View($book->getTitle());
        $view->render("updateBook", ['book' => $book]);
    }

    public function updateBook() : void
    {
        $id = Utils::request("id");
        $title = Utils::request("title");
        $content = Utils::request("content");
        $available = Utils::request("available");
        $author = Utils::request("author");
        $book = new Book([
            'id' => $id,
            'author' => $author,
            'content' => $content,
            'title' => $title,
            'available' => $available
        ]);
        $bookManager = new BookManager();
        $bookManager->UpdateBook($book);
        Utils::redirect("account");
    }

    public function addArticle() : void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    public function showApropos() {
        $view = new View("A propos");
        $view->render("apropos");
    }

    public function deleteBook() : void
    {
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $owner = $bookManager->getBookById($id)->getIdUser();
        if ($owner == $_SESSION['idUser']) {
            $bookManager = new BookManager();
            $bookManager->deleteBook($id);
        }
        Utils::redirect("account");
    }
}
