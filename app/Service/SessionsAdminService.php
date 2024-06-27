<?php
namespace Nurdin\Mind\Service;

use Nurdin\Mind\Domain\Admin;
use Nurdin\Mind\Domain\SessionsAdmin;
use Nurdin\Mind\Repository\AdminRepository;
use Nurdin\Mind\Repository\SessionsAdminRepository;

class SessionsAdminService
{
    private static string $SESSION_NAME = "X-ADMIN-SESSION";
    private SessionsAdminRepository $sessionAdminRepo;
    private AdminRepository $adminRepo;
    
    public function __construct(SessionsAdminRepository $sessionAdminRepo, AdminRepository $adminRepo) {
        $this->sessionAdminRepo = $sessionAdminRepo;
        $this->adminRepo = $adminRepo;
    }

    public function createSession(string $admin_email) : SessionsAdmin
    {
        $sessionAdmin = new SessionsAdmin();
        $sessionAdmin->id = uniqid();
        $sessionAdmin->admin_email = $admin_email;

        $this->sessionAdminRepo->insertSessions($sessionAdmin);

        setcookie(self::$SESSION_NAME, $sessionAdmin->id, time() + (60 * 60 * 24 * 30), "/");

        return $sessionAdmin;
    }

    public function current() : ?Admin
    {
        $sessionId = $_COOKIE[self::$SESSION_NAME] ?? '';

        $sessionAdmin = $this->sessionAdminRepo->findById($sessionId);

        if($sessionAdmin == null){
            return null;
        }

        return $this->adminRepo->findById($sessionAdmin->admin_email);
    }

    public function destroy()
    {
        $sessionId = $_COOKIE[self::$SESSION_NAME] ?? '';

        $this->sessionAdminRepo->deleteById($sessionId);
        // set session to expired by (1 = masa lampau) 
        setcookie(self::$SESSION_NAME, "", 1, "/");
    }
}