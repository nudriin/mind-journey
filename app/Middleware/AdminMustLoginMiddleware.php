<?php
namespace Nurdin\Mind\Middleware;

use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Repository\AdminRepository;
use Nurdin\Mind\Repository\SessionsAdminRepository;
use Nurdin\Mind\Service\SessionsAdminService;

class AdminMustLoginMiddleware{
    private SessionsAdminService $sessionsAdminService;

    public function __construct() {
        $sessionAdminRepo = new SessionsAdminRepository(DatabaseConfig::getConnect());
        $adminRepo = new AdminRepository(DatabaseConfig::getConnect());
        $this->sessionsAdminService = new SessionsAdminService($sessionAdminRepo, $adminRepo);
    }

    public function before(): void
    {
        $admin = $this->sessionsAdminService->current();

        if($admin == null){
            ViewRender::redirect("/admin/login");
        }
    }
}