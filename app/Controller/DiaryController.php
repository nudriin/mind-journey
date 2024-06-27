<?php
namespace Nurdin\Mind\Controller;
require_once __DIR__ . "/../Helper/RegexHelper.php";
use Exception;
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Model\Diary\DiaryAddRequest;
use Nurdin\Mind\Model\Diary\DiaryDeleteRequest;
use Nurdin\Mind\Model\Diary\DiaryPostingRequest;
use Nurdin\Mind\Model\Diary\DiaryUpdateRequest;
use Nurdin\Mind\Model\Diary\DiaryViewAllRequest;
use Nurdin\Mind\Model\Diary\DiaryViewRequest;
use Nurdin\Mind\Model\Diary\EditDiaryRequest;
use Nurdin\Mind\Repository\DiaryRepository;
use Nurdin\Mind\Repository\SessionsUsersRepository;
use Nurdin\Mind\Repository\UserRepository;
use Nurdin\Mind\Service\DiaryService;
use Nurdin\Mind\Service\SessionsUsersService;

class DiaryController
{
    private DiaryService $diaryService;
    private SessionsUsersService $sessionUserService;

    public function __construct()
    {
        $connection = DatabaseConfig::getConnect();
        $diaryRepo = new DiaryRepository($connection);
        $this->diaryService = new DiaryService($diaryRepo);
        $userRepo = new UserRepository($connection);
        $sessionRepo = new SessionsUsersRepository($connection);
        $this->sessionUserService = new SessionsUsersService($sessionRepo, $userRepo);
    }

    public function diary()
    {
        try{
            $user = $this->sessionUserService->current();
            $request = new DiaryViewAllRequest();
            $request->user_email = $user->email;
            $diary = $this->diaryService->viewAllDiary($request);


            ViewRender::userRender("Diary/diary", [
                "title"=>"Diary",
                "diary"=>$diary->diary,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement()
            ]);
        } catch(Exception $e){
            ViewRender::userRender("Diary/diary", [
                "title"=>"Diary",
                "error"=>$e->getMessage()
            ]);
        }
    }

    public function viewDiary(string $user_email, string $id){
        $request = new DiaryViewRequest();
        $request->id = $id;
        $request->user_email = $user_email;
        try {
            $diary = $this->diaryService->viewDiary($request);

            ViewRender::userRender("Diary/view-diary", [
                "title" => "Diary",
                "diary" => $diary->diary,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
            ]);
        } catch (Exception $e) {
            ViewRender::userRender("Diary/view-diary", [
                "title" => "Diary",
                "error" =>$e->getMessage()
            ]);
        }
    }

    public function addDiary()
    {
        ViewRender::userRender("Diary/post-diary", [
            "title"=>"Add Diary"
        ]);
    }

    public function postAddDiary()
    {
        try{
            $user = $this->sessionUserService->current();
            $request = new DiaryPostingRequest();
            $request->user_email = $user->email;
            $request->title = $_POST['diary_title'];
            $request->paragraph = $_POST['diary_paragraph'];
            $request->mood = $_POST['diary_mood'];

            $this->diaryService->addDiary($request);
            ViewRender::redirect("/user/diary");
        } catch (Exception $e){
            ViewRender::userRender("Diary/post-diary", [
                "error"=>$e->getMessage()
            ]);
        }
    }

    public function updateDiary(string $user_email, string $id)
    {
        $request = new DiaryViewRequest();
        $request->user_email = $user_email; 
        $request->id = $id;
        try{
            $diary = $this->diaryService->viewDiary($request);
            ViewRender::userRender("Diary/edit-diary", [
                "title"=>"Edit Diary",
                "diary"=>$diary->diary
            ]);
        } catch(Exception $e){

        }
    }

    public function postUpdateDiary(string $user_email, string $id){
        $request = new DiaryUpdateRequest();
        $request->user_email = $user_email;
        $request->id = $id;
        $request->title = filter_input(INPUT_POST, 'diary_title', FILTER_SANITIZE_STRING);
        $request->paragraph = filter_input(INPUT_POST, 'diary_paragraph', FILTER_SANITIZE_STRING);
        $request->mood = filter_input(INPUT_POST, 'diary_mood', FILTER_SANITIZE_STRING);

        try {
            $this->diaryService->updateDiary($request);
            ViewRender::redirect("/user/diary");
        } catch (Exception $e) {
            ViewRender::userRender("Diary/post-diary", [
                "error"=>$e->getMessage(),
                "post_title"=>$request->title,
                "paragraph"=>$request->paragraph
            ]);
        }
    }
    
    public function deleteDiary(?string $user_email, ?string $id)
    {
        $request = new DiaryDeleteRequest();
        $request->user_email = $user_email;
        $request->id = $id;
        try{
            $this->diaryService->deleteDiary($request);

            ViewRender::redirect("/user/diary");
        } catch(Exception $e){
            
        }
    }
}