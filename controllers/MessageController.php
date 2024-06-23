<?php

class MessageController 
{


    public function Message() : void
    {

        // Débogage: vérifiez le contenu de $_SESSION['user']
        $currentUserId = $_SESSION['user'];
        $receiverId = Utils::request("id");

        // Récupérer les messages échangés entre les deux utilisateurs
        $messageManager = new MessageManager();
        $messages = $messageManager->getMessagesBetweenUsers($currentUserId, $receiverId);

        // Passer les données à la vue
        $view = new View("Messagerie");
        $view->render("message", ['messages' => $messages, 'receiverId' => $receiverId]);
    }

    public function addMessage() : void
    {


        // Débogage: vérifiez le contenu de $_SESSION['user']
        $currentUserId = $_SESSION['user']->getId();
        $receiverId = Utils::request("receiver_id");
        $content = Utils::request("content");

        // Vérifier que les données sont valides
        if (empty($receiverId) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // Créer l'objet Message
        $message = new Message([
            'idUser' => $currentUserId,
            'idReceiver' => $receiverId,
            'content' => $content
        ]);

        // Ajouter le message
        $messageManager = new MessageManager();
        $result = $messageManager->addMessage($message);

        // Vérifier que l'ajout a bien fonctionné
        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout du message.");
        }

        // Rediriger vers la page de message
        Utils::redirect("message", ['id' => $receiverId]);
    }
}
