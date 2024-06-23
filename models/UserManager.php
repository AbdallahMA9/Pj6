<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

class UserManager extends AbstractEntityManager 
{
    /**
     * Récupère un user par son email.
     * @param string $email
     * @return ?User
     */
    public function getUserByLogin(string $email) : ?User 
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Ajoute un utilisateur dans la base de données.
     * @param User $user
     * @return void
     */
    public function addUser(User $user) : void 
    {
        $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $this->db->query($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }
}