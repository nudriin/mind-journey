<?php
namespace Nurdin\Mind\Service;

use Nurdin\Mind\Domain\SessionsUsers;
use Nurdin\Mind\Domain\User;
use Nurdin\Mind\Repository\SessionsUsersRepository;
use Nurdin\Mind\Repository\UserRepository;

class SessionsUsersService
{
    private static string $SESSION_NAME = "X-USER-SESSION";
    private SessionsUsersRepository $sessionsUsersRepo;
    private UserRepository $usersRepo;

    public function __construct(SessionsUsersRepository $sessionsUsersRepo, UserRepository $usersRepo)
    {
        $this->sessionsUsersRepo = $sessionsUsersRepo;
        $this->usersRepo = $usersRepo;
    }

    public function createSessionsUsers(string $userEmail) : SessionsUsers
    {
        $sessionsUsers = new SessionsUsers();
        $sessionsUsers->id = uniqid();
        $sessionsUsers->userEmail = $userEmail;

        $this->sessionsUsersRepo->insert($sessionsUsers);

        setcookie(self::$SESSION_NAME, $sessionsUsers->id, time() + (60 * 60 * 24 * 30), "/");

        return $sessionsUsers;
    }

    public function current() : ?User
    {
        $sessionsId = $_COOKIE[self::$SESSION_NAME] ?? "";
        $sessionsUser = $this->sessionsUsersRepo->findById($sessionsId);

        if($sessionsUser == null){
            return null;
        }

        return $this->usersRepo->findById($sessionsUser->userEmail);
    }

    public function destroy()
    {
        $sessionsId = $_COOKIE[self::$SESSION_NAME] ?? "";
        $this->sessionsUsersRepo->deleteById($sessionsId);
        // set session to expired by (1 = masa lampau) 
        setcookie(self::$SESSION_NAME, "", 1, "/");
    }

}