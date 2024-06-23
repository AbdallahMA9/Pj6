<?php

class MessageManager extends AbstractEntityManager
{
    /**
     * Récupère tous les messages échangés entre deux utilisateurs.
     * @param int $userId : l'id de l'utilisateur connecté.
     * @param int $receiverId : l'id du destinataire.
     * @return array : un tableau d'objets Message.
     */
    public function getMessagesBetweenUsers(int $userId, int $receiverId) : array
    {
        $sql = "SELECT * FROM message WHERE (id_user = :userId AND id_receiver = :receiverId) OR (id_user = :receiverId AND id_receiver = :userId) ORDER BY date_creation ASC";
        $result = $this->db->query($sql, ['userId' => $userId, 'receiverId' => $receiverId]);
        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    /**
     * Ajoute un message.
     * @param Message $message : l'objet Message à ajouter.
     * @return bool : true si l'ajout a réussi, false sinon.
     */
    public function addMessage(Message $message) : bool
    {
        $sql = "INSERT INTO message (id_user, id_receiver, content, date_creation) VALUES (:idUser, :idReceiver, :content, NOW())";
        $result = $this->db->query($sql, [
            'idUser' => $message->getIdUser(),
            'idReceiver' => $message->getIdReceiver(),
            'content' => $message->getContent()
        ]);
        return $result->rowCount() > 0;
    }
}
