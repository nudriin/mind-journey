<?php 
namespace Nurdin\Mind\Service;

use Exception;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\Chat;
use Nurdin\Mind\Model\Chat\SendChatRequest;
use Nurdin\Mind\Model\Chat\SendChatResponse;
use Nurdin\Mind\Model\Chat\ViewChatRequest;
use Nurdin\Mind\Model\Chat\ViewChatResponse;
use Nurdin\Mind\Repository\ChatRepository;

class ChatService
{
    private ChatRepository $chatRepository;
    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function sendMessage(SendChatRequest $request) : SendChatResponse
    {
        $this->validateSendMessage($request);
        try {
            //code...
            DatabaseConfig::beginTransaction();
            $chat = new Chat();
            $chat->id = uniqid();
            $chat->admin_email = $request->admin_email;
            $chat->user_email = $request->user_email;
            $chat->message = $request->message;
            $chat->sender = $request->sender;
            
            $this->chatRepository->insert($chat);
            DatabaseConfig::commitTransaction();

            $response = new SendChatResponse();
            $response->chat = $chat;

            return $response;
        } catch (Exception $e) {
            //throw $th;
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }

    }

    public function validateSendMessage(SendChatRequest $request)
    {
        if($request->message == null || trim($request->message) == ""){
            throw new Exception("Pesan tidak boleh kosong");
        }
    }

    public function viewChat(ViewChatRequest $request) : ViewChatResponse
    {
        try{
            $chat = $this->chatRepository->findByEmail($request->admin_email, $request->user_email);
            if($chat == null){
                throw new Exception("Belum ada pesan apapun");
            }

            $response = new ViewChatResponse();
            $response->chat = $chat;

            return $response;
        } catch(Exception  $e){
            throw $e;
        }
    }
}