<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */ 
class User extends AbstractEntity 
{
    private int $id;
    private string $email;
    private string $password;
    private string $username;
    

    /**
     * Getter pour le login.
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Setter pour le login.
     * @param string $email
     */
    public function setEmail(string $email) : void 
    {
        $this->email = $email;
    }

    /**
     * Getter pour le login.
     * @return string
     */
    public function getEmail() : string 
    {
        return $this->email;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void 
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string 
    {
        return $this->password;
    }

    /**
     * Setter pour le login.
     * @param string $username
     */
    public function setUsername(string $username) : void 
    {
        $this->username = $username;
    }

    /**
     * Getter pour le login.
     * @return string
     */
    public function getUsername() : string 
    {
        return $this->username;
    }
}