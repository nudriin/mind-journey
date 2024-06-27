<?php

namespace Nurdin\Mind\Service;

use Exception;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\User;
use Nurdin\Mind\Model\User\UserDisplayResponse;
use Nurdin\Mind\Model\User\UserPasswordRequest;
use Nurdin\Mind\Model\User\UserPasswordResponse;
use Nurdin\Mind\Model\User\UserProfileRequest;
use Nurdin\Mind\Model\User\UserProfileResponse;
use Nurdin\Mind\Model\User\UsersLoginRequest;
use Nurdin\Mind\Model\User\UsersLoginResponse;
use Nurdin\Mind\Model\User\UsersRegisterResponse;
use Nurdin\Mind\Model\User\UsersRegisterRequest;
use Nurdin\Mind\Repository\UserRepository;

class UsersService
{
    private UserRepository $usersRepo;

    public function __construct(UserRepository $usersRepo)
    {
        $this->usersRepo = $usersRepo;
    }

    public function register(UsersRegisterRequest $request): UsersRegisterResponse
    {
        $this->validateRegister($request);
        $users = $this->usersRepo->findById($request->email);
        if ($users != null) {
            throw new Exception("Email sudah terdaftar");
        }

        try {
            DatabaseConfig::beginTransaction();
            $users = new User();
            $users->email = $request->email;
            $users->name = $request->name;
            $users->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->usersRepo->insert($users);
            DatabaseConfig::commitTransaction();

            $response = new UsersRegisterResponse();
            $response->users = $users;

            return $response;
        } catch (Exception $e) {
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }

    public function validateRegister(UsersRegisterRequest $request)
    {

        if (
            $request->email == null || $request->name == null || $request->password == null ||
            trim($request->email) == "" || trim($request->name) == "" || trim($request->password) == ""
        ) {
            throw new Exception("Email, nama, dan password tidak boleh kosong");
        }
    }

    public function login(UsersLoginRequest $request): UsersLoginResponse
    {
        $this->validateLogin($request);
        try {
            $user = $this->usersRepo->findById($request->email);
            if ($user == null) {
                throw new Exception("Email atau password salah");
            }

            if (password_verify($request->password, $user->password)) {
                $response = new UsersLoginResponse();
                $response->users = $user;
                return $response;
            } else {
                throw new Exception("Email atau password salah");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validateLogin(UsersLoginRequest $request)
    {

        if (
            $request->email == null || $request->password == null ||
            trim($request->email) == "" || trim($request->password) == ""
        ) {
            throw new Exception("Email dan password tidak boleh kosong");
        }
    }

    public function updateProfile(UserProfileRequest $request): UserProfileResponse
    {
        $this->validateUpdateProfile($request);

        $user = $this->usersRepo->findById($request->email);
        if ($user == null) {
            throw new Exception("User tidak ditemukan");
        }

        try {
            DatabaseConfig::beginTransaction();
            $user->name = $request->name;
            $user->picture = $request->picture;
            $this->usersRepo->update($user);

            $response = new UserProfileResponse();
            $response->user = $user;
            DatabaseConfig::commitTransaction();
            return $response;
        } catch (Exception $e) {
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }

    public function validateUpdateProfile(UserProfileRequest $request)
    {
        if ($request->name == null || trim($request->name) == "") {
            throw new Exception("Nama tidak boleh kosong");
        }
    }

    public function updatePassword(UserPasswordRequest $request) : UserPasswordResponse
    {
        $this->validatePassword($request);
        $user = $this->usersRepo->findById($request->email);
        try {
            DatabaseConfig::beginTransaction();
            if($user == null){
                throw new Exception("User tidak ditemukan");
            }
            
            if(!password_verify($request->oldPassword, $user->password)){
                throw new Exception("Password anda salah");
            }
    
            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->usersRepo->update($user);
            DatabaseConfig::commitTransaction();
            
            $response = new UserPasswordResponse();
            $response->user = $user;
            return $response;
        } catch (Exception $e) {
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }
    
    public function validatePassword(UserPasswordRequest $request)
    {
        if( $request->newPassword == null|| $request->oldPassword == null || 
            trim($request->newPassword) == "" || trim($request->oldPassword) == ""){
                throw new Exception("Password tidak boleh kosong");
            }
    }

    public function display() : UserDisplayResponse{
        try {
            $user = $this->usersRepo->findAll();
            if($user == null){
                throw new Exception("Belum ada user");
            }
            $response = new UserDisplayResponse();
            $response->user = $user;
            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }


    // public function displayUser(UserProfileRequest $request) : UserProfileResponse
    // {
    //     try {
    //         $user = $this->usersRepo->findById($request->email);
    //         if ($user == null) {
    //             throw new Exception("User tidak ditemukan");
    //         }

    //         $response = new UserProfileResponse();
    //         $response->user = $user;

    //         return $response;
    //     } catch (Exception $e) {
    //         throw $e;
    //     }
    // }
    
}
