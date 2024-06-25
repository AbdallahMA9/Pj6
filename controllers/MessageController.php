<?php

class MessageController
{

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected(): void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    public function Message(): void
    {
        $this->checkIfUserIsConnected();
        $currentUserId = $_SESSION['idUser'];
        $receiverId = Utils::request("id");

        // Récupérer les messages échangés entre les deux utilisateurs
        $messageManager = new MessageManager();
        $messages = $messageManager->getMessagesBetweenUsers($currentUserId, $receiverId);

        // Récupérer les informations de l'utilisateur récepteur
        $userManager = new UserManager(); // suppose que vous avez une classe UserManager pour gérer les utilisateurs
        $receiver = $userManager->getUserById($receiverId);

        // Passer les données à la vue
        $view = new View("Messagerie");
        $view->render("message", ['messages' => $messages, 'receiver' => $receiver, 'receiverId' => $receiverId]);
    }

    public function addMessage(): void
    {

        $this->checkIfUserIsConnected();
        // Débogage: vérifiez le contenu de $_SESSION['user']
        $currentUserId = $_SESSION['idUser'];
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
