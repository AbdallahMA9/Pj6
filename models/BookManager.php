<?php


class BookManager extends AbstractEntityManager 
{

    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getLastBooks() : array
    {
        $sql = "SELECT book.*, user.username FROM book JOIN user ON book.id_user = user.id ORDER BY id DESC LIMIT 4";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;

    }

    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllBooks() : array
    {
        $sql = "SELECT book.*, user.username FROM book 
                JOIN user ON book.id_user = user.id";
        $result = $this->db->query($sql);
        $books = [];
    
        while ($bookData = $result->fetch()) {
            $books[] = new Book($bookData);
        }
        return $books;
    }

    
    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Book|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getBookById(int $id) : ?Book
    {
        $sql = "SELECT book.*, user.username 
                FROM book
                JOIN user ON book.id_user = user.id 
                WHERE book.id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    /**
     * Récupère tous les articles.
     * @param int $id : l'id de l'utilisateur.
     * @return array : un tableau d'objets Book.
     */
    public function getBooksByUser(int $id) : array
    {
        $sql = "SELECT book.* FROM book WHERE id_user = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $books = [];
    
        while ($bookData = $result->fetch()) {
            $books[] = new Book($bookData);
        }
        return $books;
    }
    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void 
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Book $book : l'article à modifier.
     * @return void
     */
    public function updateBook(Book $book) : void
    {
        $sql = "UPDATE book SET title = :title, content = :content, author = :author, available = :available WHERE id = :id";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'content' => $book->getContent(),
            'author' => $book->getAuthor(),
            'available' => $book->getAvailable(),
            'id' => $book->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteBook(int $id) : void
    {
        $sql = "DELETE FROM book WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }


    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function addView(int $id) : ?Article
    {
        $sql = "UPDATE article SET views = views + 1 WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Supprime un commentaire.
     * @param int $id : l'id du commentaire à supprimer.
     * @return void
     */
    public function deleteComment(int $id) : void
    {
        $sql = "DELETE FROM comment WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    /**
     * Récupère le nombre de commentaires pour un article donné.
     * @param int $articleId : l'id de l'article.
     * @return int : le nombre de commentaires.
     */
    public function getCommentCountForArticle(int $articleId) : int
    {
        $sql = "SELECT COUNT(*) as comment_count FROM comment WHERE id_article = :article_id";
        $result = $this->db->query($sql, ['article_id' => $articleId]);
        $data = $result->fetch();
        return $data['comment_count'] ?? 0;
    }



    
}