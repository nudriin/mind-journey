<?php
namespace Nurdin\Mind\Controller;
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Exception;
use Nurdin\Mind\Model\Admin\AdminLoginRequest;
use Nurdin\Mind\Model\Admin\AdminPasswordRequest;
use Nurdin\Mind\Model\Admin\AdminProfileRequest;
use Nurdin\Mind\Model\Admin\AdminRegisterRequest;
use Nurdin\Mind\Model\Chat\SendChatRequest;
use Nurdin\Mind\Model\Chat\ViewChatRequest;
use Nurdin\Mind\Repository\AdminRepository;
use Nurdin\Mind\Repository\ChatRepository;
use Nurdin\Mind\Repository\SessionsAdminRepository;
use Nurdin\Mind\Repository\UserRepository;
use Nurdin\Mind\Service\AdminService;
use Nurdin\Mind\Service\ChatService;
use Nurdin\Mind\Service\SessionsAdminService;
use Nurdin\Mind\Service\UsersService;

class AdminController{
    private SessionsAdminService $sessionsAdminService;
    private AdminService $adminService;
    private UsersService $userService;
    private ChatService $chatService;
    public function __construct() {
        $connection = DatabaseConfig::getConnect();
        $adminRepo = new AdminRepository($connection);
        $userRepo = new UserRepository(DatabaseConfig::getConnect());
        $chatRepo = new ChatRepository(DatabaseConfig::getConnect());
        $sessionAdminRepo = new SessionsAdminRepository($connection);
        $this->adminService = new AdminService($adminRepo);
        $this->sessionsAdminService = new SessionsAdminService($sessionAdminRepo, $adminRepo);
        $this->userService = new UsersService($userRepo);
        $this->chatService = new ChatService($chatRepo);
        
    }
    

    public function register(){
        $model = [
            "title"=>"Register",
            "content"=>"Register Admin"
        ];

        ViewRender::adminRender("Admin/admin-register", $model);
    }

    public function postRegister(){
        $request = new AdminRegisterRequest();
        $request->email = htmlspecialchars($_POST['email']);
        $request->name = htmlspecialchars($_POST['name']);
        $request->password = htmlspecialchars($_POST['password']);

        try {
            $this->adminService->register($request);
            ViewRender::redirect("/admin");
        } catch (Exception $e) {
            ViewRender::adminRender("Admin/admin-register", [
                "title"=>"register",
                "content"=>"Register Admin",
                "error"=>$e->getMessage()
            ]);            
        }

        $model = [
            "title"=>"Register"
        ];

        ViewRender::render("Admin/admin-register", $model);
    }

    public function login() : void
    {
        $model = [
            "title"=>"Login"
        ];

        ViewRender::render("Admin/admin-login", $model);
    }

    public function postLogin()
    {
        $request = new AdminLoginRequest();
        $request->email = htmlspecialchars($_POST['email']);
        $request->password = htmlspecialchars($_POST['password']);
        try{
            $this->adminService->login($request);
            $this->sessionsAdminService->createSession($request->email);
            ViewRender::redirect("/admin");
        } catch(Exception $e){
            $model = [
                "title"=>"Login",
                "error"=>$e->getMessage()
            ];
            ViewRender::render("Admin/admin-login", $model);
        }
        
    }

    public function profileUpdate() : void
    {
        $admin = $this->sessionsAdminService->current();
        $model = [
            "title"=>"Profile",
            "content"=>"Profile",
            "admin"=>[
                "email"=>$admin->email,
                "name"=>$admin->name
            ]
        ];

        ViewRender::adminRender("Admin/admin-profile", $model);
    }

    public function postProfileUpdate()
    {
        $admin = $this->sessionsAdminService->current();
        $request = new AdminProfileRequest();
        $request->email = $admin->email;
        $request->name = htmlspecialchars($_POST['name']);
        try{
            $this->adminService->updateProfile($request);
            ViewRender::redirect("/admin/profile");
        } catch(Exception $e){
            ViewRender::adminRender("Admin/admin-profile", [
                "title"=>"Profile",
                "content"=>"Profile",
                "admin"=>[
                    "email"=>$admin->email,
                    "name"=>$admin->name
                ],
                "error"=>$e->getMessage()
            ]);
        }
    }
    public function passwordUpdate() : void
    {
        $admin = $this->sessionsAdminService->current();
        $model = [
            "title"=>"Password",
            "content"=>"Password",
            "admin"=>[
                "email"=>$admin->email,
                "name"=>$admin->name

            ]
        ];

        ViewRender::adminRender("Admin/admin-password", $model);
    }

    public function postPasswordUpdate()
    {
        $admin = $this->sessionsAdminService->current();
        $request = new AdminPasswordRequest();
        $request->email = $admin->email;
        $request->oldPassword = htmlspecialchars($_POST["old_password"]);
        $request->newPassword = htmlspecialchars($_POST["new_password"]);
        try {
            $this->adminService->updatePassword($request);
            ViewRender::redirect("/admin");
        } catch (Exception $e) {
            ViewRender::adminRender("Admin/admin-password", 
            [
                "title"=>"Password",
                "content"=>"Password",
                "admin"=>[
                    "email"=>$admin->email,
                    "name"=>$admin->name
                ],
                "error"=>$e->getMessage()
            ]);
        }
    }
    
    public function listChat()
    {
        try{
            $user = $this->userService->display();
            ViewRender::adminRender("Admin/list-chat", [
                "title"=>"Chat",
                "user"=>$user->user
            ]);
        } catch(Exception $e){
            ViewRender::adminRender("Admin/list-chat", [
                "title"=>"Chat",
                "error"=>$e->getMessage()
            ]);
        }
    }
    public function chat(string $user_email)
    {
        try{
            $request = new ViewChatRequest();
            $request->admin_email = "mrsunnysummer@gmail.com";
            $request->user_email = $user_email;
            $chat = $this->chatService->viewChat($request);
            ViewRender::adminRender("Admin/chat", [
                "title"=>"Chat",
                "chat"=>$chat->chat,
                "user_email"=>$user_email
            ]);
        } catch(Exception $e){
            ViewRender::adminRender("Admin/chat", [
                "title"=>"Chat",
                "error"=>$e->getMessage(),
                "user_email"=>$user_email
            ]);
        }
    }

    public function postChat()
    {
        try{
            $request = new SendChatRequest();
            $request->admin_email = "mrsunnysummer@gmail.com";
            $request->user_email = $_POST['user_email'];
            $request->message = $_POST['admin_message'];
            $request->sender = "Admin";

            $this->chatService->sendMessage($request);
            ViewRender::redirect("/admin/chat/$_POST[user_email]");
        } catch(Exception $e){
            ViewRender::adminRender("Admin/chat", [
                "title"=> "Chat",
                "error"=>$e->getMessage()
            ]);
        }
    }



    // public function adminAccount()
    // {
    //     $admin = $this->adminService->display();
    //     $curAdmin = $this->sessionsAdminService->current();

    //     $model = [
    //         "title"=>"Account",
    //         "content"=>"Account",
    //         "admin"=>$admin->array,
    //         "name"=>$curAdmin->email
    //     ];

    //     ViewRender::adminRender("Admin/admin-account", $model);
    // }

    public function logout()
    {
        $this->sessionsAdminService->destroy();
        ViewRender::redirect("/admin");
    }
}