<?php


class Book extends AbstractEntity 
{
    private int $idUser;
    private string $title = "";

    private string $author = "";
    private string $content = "";

    private string $username;
    private bool $available;

    /**
     * Setter pour l'id de l'utilisateur. 
     * @param int $idUser
     */
    public function setIdUser(int $idUser) : void 
    {
        $this->idUser = $idUser;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getIdUser() : int 
    {
        return $this->idUser;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle() : string 
    {
        return $this->title;
    }

    /**
     * Setter pour le author.
     * @param string $author
     */
    public function setAuthor(string $author) : void 
    {
        $this->author = $author;
    }

    /**
     * Getter pour le author.
     * @return string
     */
    public function getAuthor() : string 
    {
        return $this->author;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public function setContent(string $content) : void 
    {
        $this->content = $content;
    }

    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1) : string 
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

    /**
     * Setter pour la dispo.
     * @param bool $available
     */
    public function setAvailable(bool $available) : void
    {
        $this->available = $available;
    }

    /**
     * Getter pour le dispo.
     * @return bool
     */
    public function getAvailable() : bool 
    {
        return $this->available;
    }

    /**
     * Setter pour la dispo.
     * @param string $username
     */
    public function setUsername(string $username) : void 
    {
        $this->username = $username;
    }

    /**
     * Getter pour le dispo.
     * @return string
     */
    public function getUsername() : string 
    {
        return $this->username;
    }



    

}
