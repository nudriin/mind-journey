<?php
namespace Nurdin\Mind\Service;

use Dflydev\DotAccessData\Data;
use Exception;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\Diary;
use Nurdin\Mind\Model\Diary\DiaryAddRequest;
use Nurdin\Mind\Model\Diary\DiaryAddResponse;
use Nurdin\Mind\Model\Diary\DiaryDeleteRequest;
use Nurdin\Mind\Model\Diary\DiaryPostingRequest;
use Nurdin\Mind\Model\Diary\DiaryPostingResponse;
use Nurdin\Mind\Model\Diary\DiaryUpdateRequest;
use Nurdin\Mind\Model\Diary\DiaryUpdateResponse;
use Nurdin\Mind\Model\Diary\DiaryViewAllRequest;
use Nurdin\Mind\Model\Diary\DiaryViewAllResponse;
use Nurdin\Mind\Model\Diary\DiaryViewRequest;
use Nurdin\Mind\Model\Diary\DiaryViewResponse;
use Nurdin\Mind\Model\Diary\EditDiaryRequest;
use Nurdin\Mind\Model\Diary\EditDiaryResponse;
use Nurdin\Mind\Repository\DiaryRepository;
use Nurdin\Mind\Repository\SessionsUsersRepository;
use Nurdin\Mind\Repository\UserRepository;

class DiaryService
{
    private DiaryRepository $diaryRepo;
    private SessionsUsersService $sessionUser;

    public function __construct(DiaryRepository $diaryRepo)
    {
        $this->diaryRepo = $diaryRepo;
        $sessionRepo = new SessionsUsersRepository(DatabaseConfig::getConnect());
        $userRepo = new UserRepository(DatabaseConfig::getConnect());
        $this->sessionUser = new SessionsUsersService($sessionRepo, $userRepo);

    }

    public function addDiary(DiaryPostingRequest $request) : DiaryPostingResponse
    {
        $this->validateAddDiary($request);
        try{
            $user = $this->sessionUser->current();
            DatabaseConfig::beginTransaction();
            $diary = new Diary();
            $diary->id = uniqid();
            $diary->user_email = $user->email;
            $diary->title = $_POST['diary_title'];
            $diary->paragraph = $_POST['diary_paragraph'];
            $diary->mood = $_POST['diary_mood'];
            $this->diaryRepo->insert($diary);
            DatabaseConfig::commitTransaction();

            $response = new DiaryPostingResponse();
            $response->diary = $diary;

            return $response;

        } catch(Exception $e){
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }

    public function validateAddDiary(DiaryPostingRequest $request)
    {
        if($request->user_email = null || $request->title = null || $request->paragraph = null || $request->mood = null || trim($request->user_email) == "" || trim($request->title) == "" || trim($request->paragraph == "") || trim($request->mood) == ""){
            throw new Exception("Judul dan isi tidak boleh kosong");
        }
    }
    
    // public function editDiary(EditDiaryRequest $request) : EditDiaryResponse
    // {
    //     $this->validateEditDiary($request);
    //     try{
    //         DatabaseConfig::beginTransaction();
    //         $diary = new Diary();
    //         $diary->id = $request->id;
    //         $diary->user_email = $request->user_email;
    //         $diary->title = $request->title;
    //         $diary->paragraph = $request->paragraph;
    //         $diary->mood = $request->mood;
    //         $diaryResponse = $this->diaryRepo->update($diary);
    //         DatabaseConfig::commitTransaction();
    //         $response 


    //     } catch(Exception $e){
    //         throw $e;
    //         DatabaseConfig::rollbackTransaction();
    //     }

    // }
    
    // public function validateEditDiary(EditDiaryRequest $request)
    // {
    //     if($request->title = null || $request->paragraph = null || $request->mood = null || trim($request->title) == "" || trim($request->paragraph == "") || trim($request->mood) == ""){
    //         throw new Exception("Judul dan isi tidak boleh kosong");
    //     }
    // }


    public function viewDiary(DiaryViewRequest $request) : DiaryViewResponse
    {
        try {
            $diary = $this->diaryRepo->findById($request->id, $request->user_email);
            if($diary == null){
                throw new Exception("Diary tidak ditemukan");
            }

            $response = new DiaryViewResponse();
            $response->diary = $diary;
            return $response;
            // $response = new DiaryViewResponse();
            // $response->$diary = $diary;
            // return $response;

            // return $diary;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function viewAllDiary(DiaryViewAllRequest $request) : DiaryViewAllResponse
    {
        try {
            $diary = $this->diaryRepo->findAll($request->user_email);
            if($diary == null){
                throw new Exception("Belum ada diary apapun, silahkan tambah diary");
            }

            $response = new DiaryViewAllResponse();
            $response->diary = $diary;

            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateDiary(DiaryUpdateRequest $request) : DiaryUpdateResponse
    {
        $this->validateUpdateDiary($request);
        try {
            DatabaseConfig::beginTransaction();
            $diary = new Diary();
            $diary->id = $request->id;
            $diary->user_email = $request->user_email;
            $diary->title = filter_input(INPUT_POST, 'diary_title', FILTER_SANITIZE_STRING);
            $diary->paragraph = filter_input(INPUT_POST, 'diary_paragraph', FILTER_SANITIZE_STRING);
            $diary->mood = filter_input(INPUT_POST, 'diary_mood', FILTER_SANITIZE_STRING);
            $this->diaryRepo->update($diary);
            DatabaseConfig::commitTransaction();
            $response = new DiaryUpdateResponse();
            $response->diary = $diary;
            return $response;
        } catch (Exception $e) {
            throw $e;
            DatabaseConfig::rollbackTransaction();
        }

    }

    public function validateUpdateDiary(DiaryUpdateRequest $request)
    {
        if($request->id = null ||$request->user_email = null || $request->title = null || $request->paragraph = null || $request->mood = null || trim($request->id) == "" || trim($request->user_email) == "" || trim($request->title) == "" || trim($request->paragraph == "") || trim($request->mood) == ""){
            throw new Exception("Judul dan isi tidak boleh kosong");
        }
    }

    public function deleteDiary(DiaryDeleteRequest $request)
    {
        try{
            $diary = $this->diaryRepo->findById($request->id, $request->user_email);
            if($diary == null){
                throw new Exception("Gagal menghapus diary");
            }

            $this->diaryRepo->delete($request->id, $request->user_email);
        } catch (Exception $e){
            throw $e;
        }
    }
}