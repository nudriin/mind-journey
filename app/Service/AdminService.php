<?php
namespace Nurdin\Mind\Service;

use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\Admin;
use Exception;
use Nurdin\Mind\Model\Admin\AdminDisplayResponse;
use Nurdin\Mind\Model\Admin\AdminLoginRequest;
use Nurdin\Mind\Model\Admin\AdminLoginResponse;
use Nurdin\Mind\Model\Admin\AdminPasswordRequest;
use Nurdin\Mind\Model\Admin\AdminPasswordResponse;
use Nurdin\Mind\Model\Admin\AdminProfileRequest;
use Nurdin\Mind\Model\Admin\AdminProfileResponse;
use Nurdin\Mind\Model\Admin\AdminRegisterRequest;
use Nurdin\Mind\Model\Admin\AdminRegisterResponse;
use Nurdin\Mind\Repository\AdminRepository;

class AdminService
{
    private AdminRepository $adminRepo;
    
    public function __construct(AdminRepository $adminRepo) 
    {
        $this->adminRepo = $adminRepo;
    }

    public function register(AdminRegisterRequest $request) : AdminRegisterResponse
    {
        $this->validateRegister($request);

        $admin = $this->adminRepo->findById($request->email);
        if($admin != null){
            throw new Exception("Email sudah terdaftar");
        } 
        try {
            DatabaseConfig::beginTransaction();
            $admin = new Admin();
            $admin->email = $request->email;
            $admin->name = $request->name;
            $admin->password = password_hash($request->password, PASSWORD_BCRYPT);
            
            $this->adminRepo->insert($admin);
            DatabaseConfig::commitTransaction();
            $response = new AdminRegisterResponse();
            $response->admin = $admin;

            return $response;

        } catch (Exception $e) {
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
        

    }

    public function validateRegister(AdminRegisterRequest $request)
    {
        if( $request->email == null || $request->name == null || $request->password == null ||
            trim($request->email) == "" || trim($request->name) == "" || trim($request->password) == ""){
                throw new Exception("Email, nama dan password tidak boleh kosong");
            }
    }

    public function login(AdminLoginRequest $request) : AdminLoginResponse
    {
        $this->validateLogin($request);
        $admin = $this->adminRepo->findById($request->email);
        if($admin == null){
            throw new Exception("Email atau password anda salah");
        }

        if(password_verify($request->password, $admin->password)){
            $response = new AdminLoginResponse();
            $response->admin = $admin;
            return $response;
        } else {
            throw new Exception("Email atau password anda salah");
        }
    }

    public function validateLogin(AdminLoginRequest $request)
    {
        if( $request->email == null || $request->password == null ||
            trim($request->email) == "" || trim($request->password) == ""){
                throw new Exception("Email dan password tidak boleh kosong");
            }
    }

    public function updateProfile(AdminProfileRequest $request) : AdminProfileResponse
    {
        $this->validateUpdateProfile($request);

        $admin = $this->adminRepo->findById($request->email);
        if($admin == null){
            throw new Exception("Admin tidak ditemukan");
        }

        try {
            DatabaseConfig::beginTransaction();
            $admin->name = $request->name;
            $this->adminRepo->update($admin);
    
            $response = new AdminProfileResponse();
            $response->admin = $admin;
            DatabaseConfig::commitTransaction();
            return $response;
        } catch (Exception $e) {
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }


    }

    public function validateUpdateProfile(AdminProfileRequest $request)
    {
        if( $request->name == null || trim($request->name) == ""){
                throw new Exception("Nama tidak boleh kosong");
            }
    }
    
    public function updatePassword(AdminPasswordRequest $request) : AdminPasswordResponse
    {
        $this->validatePassword($request);
        $admin = $this->adminRepo->findById($request->email);
        try {
            DatabaseConfig::beginTransaction();
            if($admin == null){
                throw new Exception("Admin tidak ditemukan");
            }
            
            if(!password_verify($request->oldPassword, $admin->password)){
                throw new Exception("Password anda salah!");
            }
    
            $admin->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->adminRepo->update($admin);
            DatabaseConfig::commitTransaction();
            
            $response = new AdminPasswordResponse();
            $response->admin = $admin;
            return $response;
        } catch (Exception $e) {
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }
    
    public function validatePassword(AdminPasswordRequest $request)
    {
        if( $request->newPassword == null|| $request->oldPassword == null || 
            trim($request->newPassword) == "" || trim($request->oldPassword) == ""){
                throw new Exception("Password tidak boleh kosong");
            }
    }

    // public function display() : AdminDisplayResponse{
    //     $admin = $this->adminRepo->findAll();
    //     try {
    //         if($admin == null){
    //             throw new Exception("Admin masih kosong");
    //         }
    //         $response = new AdminDisplayResponse();
    //         $response->array = $admin;
    //         return $response;
    //     } catch (Exception $e) {
    //         throw $e;
    //     }
    // }
}
