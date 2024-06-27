<?php
namespace Nurdin\Mind\Middleware;

use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Repository\UserRepository;
use Nurdin\Mind\Repository\SessionsUsersRepository;
use Nurdin\Mind\Service\SessionsUsersService;

class UserMustLoginMiddleware{
    private SessionsUsersService $sessionsUserService;

    public function __construct() {
        $sessionuserRepo = new SessionsUsersRepository(DatabaseConfig::getConnect());
        $userRepo = new UserRepository(DatabaseConfig::getConnect());
        $this->sessionsUserService = new SessionsUsersService($sessionuserRepo, $userRepo);
    }

    public function before(): void
    {
        $user = $this->sessionsUserService->current();

        if($user == null){
            ViewRender::redirect("/user/login");
        }
    }
}