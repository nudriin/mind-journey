<?php
namespace Nurdin\Mind\Controller;
require_once __DIR__ . "/../Helper/ImageHelper.php";
use Exception;
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\Sessionsusers;
use Nurdin\Mind\Model\User\UserProfileRequest;
use Nurdin\Mind\Repository\SessionsUsersRepository;
use Nurdin\Mind\Repository\UserRepository;
use Nurdin\Mind\Service\SessionsUsersService;
use Nurdin\Mind\Service\UsersService;

class UserHomeController
{
    private UsersService $userService;
    private SessionsUsersService $sessionUserService;


    public function __construct()
    {
        $userRepo = new UserRepository(DatabaseConfig::getConnect());
        $this->userService = new UsersService($userRepo);
        $sessionUserRepository = new SessionsUsersRepository(DatabaseConfig::getConnect());
        $this->sessionUserService = new SessionsUsersService($sessionUserRepository, $userRepo);
    }

    public function index()
    {
        try{

            $user = $this->sessionUserService->current();
            
            ViewRender::userRender("User/dashboard", [
                "title"=>"Dashboard",
                "user"=>$user
            ]);
        } catch(Exception $e){
            ViewRender::userRender("User/dashboard", [
                "error"=>$e->getMessage()
            ]);
        }
    }
}