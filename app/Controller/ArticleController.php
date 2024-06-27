<?php

namespace Nurdin\Mind\Controller;
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../Helper/RegexHelper.php";
require_once __DIR__ . "/../Helper/ImageHelper.php";

use League\CommonMark\CommonMarkConverter;
use DateTime;
use Exception;
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Model\Article\ArticleDisplayByIdRequest;
use Nurdin\Mind\Model\Article\ArticleDisplayCategoryRequest;
use Nurdin\Mind\Model\Article\ArticleDisplayStatusRequest;
use Nurdin\Mind\Model\Article\ArticleEditRequest;
use Nurdin\Mind\Model\Article\ArticlePostRequest;
use Nurdin\Mind\Model\Article\ArticleStatusRequest;
use Nurdin\Mind\Model\Article\ArticleViewRequest;
use Nurdin\Mind\Repository\AdminRepository;
use Nurdin\Mind\Repository\ArticleRepository;
use Nurdin\Mind\Repository\SessionsAdminRepository;
use Nurdin\Mind\Service\AdminService;
use Nurdin\Mind\Service\ArticleService;
use Nurdin\Mind\Service\SessionsAdminService;
use Nurdin\Mind\Helper\ConverterHelper;


class ArticleController
{

    private ArticleService $articleService;
    private SessionsAdminService $sessionsAdminService;

    public function __construct()
    {
        $connection = DatabaseConfig::getConnect();
        $articleRepo = new ArticleRepository($connection);
        $sessionsAdminRepo = new SessionsAdminRepository($connection);
        $adminRepo = new AdminRepository($connection);
        $this->articleService = new ArticleService($articleRepo);
        $this->sessionsAdminService = new SessionsAdminService($sessionsAdminRepo, $adminRepo);
    }

    public function article()
    {
        $converter = ConverterHelper::convert();
        try {
            $article = $this->articleService->displayAll();

            ViewRender::render("Article/article", [
                "title" => "Article",
                "article" => $article->article,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
                "converter"=>$converter
            ]);
        } catch (Exception $e) {
            ViewRender::render("Article/article", [
                "title" => "Article",
                "error" =>$e->getMessage()
            ]);
        }
    }

    public function viewArticle(?string $category, ?string $id)
    {
        $request = new ArticleViewRequest();
        $request->id = $id;
        $converter = ConverterHelper::convert();
        try {
            $response = $this->articleService->viewArticle($request);
            $category = $response->article->category;
            $date = DateTime::createFromFormat("Y-m-d H:i:s", $response->article->date);
            $strDate = $date->format("Y-m-d");
            ViewRender::render("Article/view-article", [
                "title" => "Article",
                "article" => $response->article,
                "date"=> $strDate,
                "pattern"=>getPattern(),
                "replace"=>getReplacement(),
                "converter"=>$converter
            ]);
        } catch (Exception $e) {
            ViewRender::render("Article/view-article", [
                "title" => "Article",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function postingArticle()
    {
        ViewRender::adminRender("Article/post-article", [
            "title"=>"Posting Artikel"
        ]);
    }

    public function postPostingArticle()
    {
        try{
            $admin = $this->sessionsAdminService->current();
            $request = new ArticlePostRequest();
            $request->admin_email = $admin->email;
            $request->title = htmlspecialchars($_POST['title']);
            $request->paragraph = htmlspecialchars($_POST['paragraph']);
            $request->category = htmlspecialchars($_POST['category']);
            $request->images = $_FILES['images']['name'];
            $this->articleService->posting($request);
            moveImage($_FILES['images']['tmp_name'], $request->images);
            ViewRender::redirect("/admin");
        } catch (Exception $e){
            ViewRender::adminRender("Article/post-article", [
                "title"=> "Posting Artikel",
                "error"=>$e->getMessage(),
                "post_title"=>$request->title,
                "paragraph"=>$request->paragraph,
                "category"=> $request->category
            ]);
        }
    }

    public function articleByCategory(string $category)
    {
        $request = new ArticleDisplayCategoryRequest();
        $request->category = $category;
        $converter = ConverterHelper::convert();
        try{
            $article = $this->articleService->displayByCategory($request);

            ViewRender::render("Article/article-category", [
                "title"=>"Artikel",
                "article"=>$article->article,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
                "converter"=>$converter
            ]);
        } catch (Exception $e){
            ViewRender::render("Article/article-category", [
                "title"=>"Artikel",
                "error"=>$e->getMessage()
            ]);
            
        }
    }

    public function activeArticle(){
        $converter = ConverterHelper::convert();
        $request = new ArticleDisplayStatusRequest();
        $request->status = "Active";
        try {
            $article = $this->articleService->displayByStatus($request);

            ViewRender::adminRender("Article/active-article", [
                "title" => "Active Article",
                "article" => $article->article,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
                "converter"=>$converter
            ]);
        } catch (Exception $e) {
            ViewRender::adminRender("Article/active-article", [
                "title" => "Active Article",
                "error" =>$e->getMessage()
            ]);
        }
    }
    
    public function postActiveArticle(){
        $converter = ConverterHelper::convert();
        try{
            $article = $this->articleService->displayAll();
            $request = new ArticleStatusRequest();
            $request->id = htmlspecialchars($_POST['post_id']);
            $request->status = htmlspecialchars($_POST['status']);

            $this->articleService->setStatus($request);
            ViewRender::redirect("/active-article");
        } catch(Exception $e){
            ViewRender::adminRender("Article/active-article", [
                "title" => "Active Article",
                "article" => $article->article,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
                "converter"=>$converter,
                "error"=>$e->getMessage()
            ]);
        }
    }

    public function deactiveArticle(){
        $converter = ConverterHelper::convert();
        $request = new ArticleDisplayStatusRequest();
        $request->status = "Deactive";
        try {
            $article = $this->articleService->displayByStatus($request);

            ViewRender::adminRender("Article/deactive-article", [
                "title" => "Deactive Article",
                "article" => $article->article,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
                "converter"=>$converter
            ]);
        } catch (Exception $e) {
            ViewRender::adminRender("Article/deactive-article", [
                "title" => "Deactive Article",
                "error" =>$e->getMessage()
            ]);
        }
    }

    public function postDeactiveArticle(){
        $converter = ConverterHelper::convert();
        try{
            $article = $this->articleService->displayAll();
            $request = new ArticleStatusRequest();
            $request->id = htmlspecialchars($_POST['post_id']);
            $request->status = htmlspecialchars($_POST['status']);

            $this->articleService->setStatus($request);
            ViewRender::redirect("/deactive-article");
        } catch(Exception $e){
            ViewRender::adminRender("Article/deactive-article", [
                "title" => "Deactive Article",
                "article" => $article->article,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
                "converter"=>$converter,
                "error"=>$e->getMessage()
            ]);
        }
    }

    public function editArticle(string $id)
    {
        $request = new ArticleDisplayByIdRequest();
        $request->id = $id;
        try{
            $article = $this->articleService->displayById($request);
            ViewRender::adminRender("Article/edit-article", [
                "title"=> "Edit Artikel",
                "article"=>$article->article
            ]);
        } catch (Exception $e){
            ViewRender::adminRender("Article/edit-article", [
                "title"=> "Edit Artikel",
                "error"=>$e->getMessage()
            ]);
        }
    }

    public function postEditArticle(string $id)
    {
        $request = new ArticleEditRequest();
        $request->id = $id;
        $request->title = htmlspecialchars($_POST['title']);
        $request->paragraph = htmlspecialchars($_POST['paragraph']);
        $request->category = htmlspecialchars($_POST['category']);
        $request->images = $_FILES['images']['name'];
        try{
            $this->articleService->editById($request);
            moveImage($_FILES['images']['tmp_name'], $request->images);
            ViewRender::redirect("/admin");
        } catch (Exception $e){
            ViewRender::adminRender("Article/edit-article", [
                "title"=> "Posting Artikel",
                "error"=>$e->getMessage(),
                "post_title"=>$request->title,
                "paragraph"=>$request->paragraph,
                "category"=> $request->category
            ]);
        }
    }

    

    // public function articleView()
}
