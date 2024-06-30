<?php

class MessageController
{
    private function checkIfUserIsConnected(): void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("connectionForm");
        }
    }

    public function Message(): void
    {
        $this->checkIfUserIsConnected();
        $currentUserId = $_SESSION['idUser'];
        $receiverId = Utils::request("id");

        if (empty($receiverId)) {
            $messageManager = new MessageManager();
            $lastContact = $messageManager->getLastMessageContact($currentUserId);

            if ($lastContact) {
                header("Location: index.php?action=message&id=" . $lastContact->getId());
                exit;
            }
        }

        $messageManager = new MessageManager();
        $contacts = $messageManager->getAllMessageContacts($currentUserId);
        $messages = $messageManager->getMessagesBetweenUsers($currentUserId, $receiverId);
        $userManager = new UserManager();
        $receiver = $userManager->getUserById($receiverId);

        $view = new View("Messagerie");
        $view->render("message", ['messages' => $messages, 'receiver' => $receiver, 'receiverId' => $receiverId, 'contacts' => $contacts]);
    }

    public function addMessage(): void
    {
        $this->checkIfUserIsConnected();
        $currentUserId = $_SESSION['idUser'];
        $receiverId = Utils::request("receiver_id");
        $content = Utils::request("content");

        if (empty($receiverId) || empty($content)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $message = new Message([
            'idUser' => $currentUserId,
            'idReceiver' => $receiverId,
            'content' => $content
        ]);

        $messageManager = new MessageManager();
        $result = $messageManager->addMessage($message);

        if (!$result) {
            throw new Exception("Une erreur est survenue lors de l'ajout du message.");
        }

        Utils::redirect("message", ['id' => $receiverId]);
    }
}
