<?php

namespace Nurdin\Mind\Controller;

require_once __DIR__ . "/../Helper/ImageHelper.php";

use Exception;
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Model\Chat\SendChatRequest;
use Nurdin\Mind\Model\Chat\ViewChatRequest;
use Nurdin\Mind\Model\User\UserPasswordRequest;
use Nurdin\Mind\Model\User\UserProfileRequest;
use Nurdin\Mind\Model\User\UsersLoginRequest;
use Nurdin\Mind\Model\User\UsersRegisterRequest;
use Nurdin\Mind\Repository\ChatRepository;
use Nurdin\Mind\Repository\SessionsUsersRepository;
use Nurdin\Mind\Repository\UserRepository;
use Nurdin\Mind\Service\ChatService;
use Nurdin\Mind\Service\SessionsUsersService;
use Nurdin\Mind\Service\UsersService;

class UsersController
{
    private UsersService $usersService;
    private SessionsUsersService $sessionsUsersService;
    private ChatService $chatService;

    public function __construct()
    {
        $connection = DatabaseConfig::getConnect();
        $usersRepo = new UserRepository($connection);
        $sessionsUsersRepo = new SessionsUsersRepository($connection);
        $this->usersService = new UsersService($usersRepo);
        $this->sessionsUsersService = new SessionsUsersService($sessionsUsersRepo, $usersRepo);
        $chatRepo = new ChatRepository(DatabaseConfig::getConnect());
        $this->chatService = new ChatService($chatRepo);
    }

    public function register()
    {
        ViewRender::render("User/user-register", [
            "title" => "Register",
        ]);
    }

    public function postRegister()
    {
        $request = new UsersRegisterRequest();
        $request->email = $_POST['email'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try {
            $this->usersService->register($request);

            ViewRender::redirect("/user");
        } catch (Exception $e) {
            ViewRender::render("User/user-register", [
                "title" => "Register",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function login()
    {
        ViewRender::render("User/user-login", [
            "title" => "Login"
        ]);
    }

    public function postLogin()
    {
        $request = new UsersLoginRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        try {
            //code...
            $this->usersService->login($request);
            $this->sessionsUsersService->createSessionsUsers($request->email);
            ViewRender::redirect("/user");
        } catch (Exception $e) {
            ViewRender::render("User/user-login", [
                "title" => "Login",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function passwordUpdate(): void
    {
        $user = $this->sessionsUsersService->current();
        $model = [
            "title" => "Password",
            "user" => $user
        ];

        ViewRender::userRender("User/user-password", $model);
    }

    public function postPasswordUpdate()
    {
        $user = $this->sessionsUsersService->current();
        $request = new UserPasswordRequest();
        $request->email = $user->email;
        $request->oldPassword = htmlspecialchars($_POST["old_password"]);
        $request->newPassword = htmlspecialchars($_POST["new_password"]);
        try {
            $this->usersService->updatePassword($request);
            ViewRender::redirect("/user");
        } catch (Exception $e) {
            ViewRender::userRender(
                "User/user-password",
                [
                    "title" => "Password",
                    "user" => $user,
                    "error" => $e->getMessage()
                ]
            );
        }
    }

    public function logout()
    {
        $this->sessionsUsersService->destroy();
        ViewRender::redirect("/user/login");
    }

    public function profile()
    {
        try {
            $user = $this->sessionsUsersService->current();

            ViewRender::userRender("User/profile", [
                "title" => "Profile",
                "user" => $user
            ]);
        } catch (Exception $e) {
            ViewRender::userRender("User/profile", [
                "error" => $e->getMessage()
            ]);
        }
    }

    public function postProfile()
    {
        try {
            $user = $this->sessionsUsersService->current();
            $request = new UserProfileRequest();
            $request->email = $user->email;
            $request->name = htmlspecialchars($_POST['name']);
            $request->picture = $_FILES['picture']['name'];
            $this->usersService->updateProfile($request);
            moveImage($_FILES['picture']['tmp_name'], $request->picture);
            ViewRender::redirect("/user/profile");
        } catch (Exception $e) {
            ViewRender::userRender("User/profile", [
                "title" => "Profile",
                "error" => $e->getMessage(),
                "name" => $request->name,
            ]);
        }
    }

    public function chat()
    {
        try {
            $user = $this->sessionsUsersService->current();
            $request = new ViewChatRequest();
            $request->admin_email = "mrsunnysummer@gmail.com";
            $request->user_email = $user->email;
            $chat = $this->chatService->viewChat($request);
            ViewRender::userRender("User/chat", [
                "title" => "Chat",
                "chat" => $chat->chat,
                "user_email" => $user->email
            ]);
        } catch (Exception $e) {
            ViewRender::userRender("User/chat", [
                "title" => "Chat",
                "error" => $e->getMessage(),
                "user_email" => $user->email
            ]);
        }
    }

    public function postChat()
    {
        try {
            $user = $this->sessionsUsersService->current();
            $request = new SendChatRequest();
            $request->admin_email = "mrsunnysummer@gmail.com";
            $request->user_email = $user->email;
            $request->message = $_POST['user_message'];
            $request->sender = "User";

            $this->chatService->sendMessage($request);
            ViewRender::redirect("/user/chat");
        } catch (Exception $e) {
            ViewRender::adminRender("User/chat", [
                "title" => "Chat",
                "error" => $e->getMessage()
            ]);
        }
    }
    // public function cart()
    // {
    //     ViewRender::render("User/users-cart", [
    //         "title"=>"Shopping Cart"
    //     ]);
    // }
}
