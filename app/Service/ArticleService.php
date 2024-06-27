<?php
namespace Nurdin\Mind\Service;

use Exception;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\Article;
use Nurdin\Mind\Model\Article\ArticleDisplayByIdRequest;
use Nurdin\Mind\Model\Article\ArticleDisplayByIdResponse;
use Nurdin\Mind\Model\Article\ArticleDisplayCategoryRequest;
use Nurdin\Mind\Model\Article\ArticleDisplayCategoryResponse;
use Nurdin\Mind\Model\Article\ArticleDisplayResponse;
use Nurdin\Mind\Model\Article\ArticleDisplayStatusRequest;
use Nurdin\Mind\Model\Article\ArticleDisplayStatusResponse;
use Nurdin\Mind\Model\Article\ArticleEditRequest;
use Nurdin\Mind\Model\Article\ArticleEditResponse;
use Nurdin\Mind\Model\Article\ArticleLatestResponse;
use Nurdin\Mind\Model\Article\ArticlePostRequest;
use Nurdin\Mind\Model\Article\ArticlePostResponse;
use Nurdin\Mind\Model\Article\ArticlePreviewResponse;
use Nurdin\Mind\Model\Article\ArticleStatusRequest;
use Nurdin\Mind\Model\Article\ArticleStatusResponse;
use Nurdin\Mind\Model\Article\ArticleViewRequest;
use Nurdin\Mind\Model\Article\ArticleViewResponse;
use Nurdin\Mind\Repository\ArticleRepository;

class ArticleService{
    private ArticleRepository $articleRepo;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function displayAll() : ArticleDisplayResponse
    {
        $article = $this->articleRepo->findAll();
        try{
            if($article == null){
                throw new Exception("Mohon maaf untuk sekarang belum ada artikel apapun");
            }
            
            $response = new ArticleDisplayResponse();
            $response->article = $article;

            return $response;
        } catch (Exception $e){
            throw $e;
        }
    }

    public function displayByCategory(ArticleDisplayCategoryRequest $request) : ArticleDisplayCategoryResponse
    {
        $article = $this->articleRepo->findByCategory($request->category, $request->status);
        try{
            if($article == null){
                throw new Exception("Mohon maaf untuk sekarang belum ada artikel apapun");
            }
            
            $response = new ArticleDisplayCategoryResponse();
            $response->article = $article;

            return $response;

        } catch (Exception $e){
            throw $e;
        }
    }

    public function posting(ArticlePostRequest $request) : ArticlePostResponse
    {
        $this->validatePosting($request);
        try{
            DatabaseConfig::beginTransaction();
            if($request->admin_email == null){
                throw new Exception("Silahkan login terlebih dahulu");
            }
            $article = new Article();
            $article->id = uniqid();
            $article->admin_email = $request->admin_email;
            $article->title = $request->title;
            $article->paragraph = $request->paragraph;
            $article->category = $request->category;
            $article->images = $request->images;
            $article->status = "Deactive";
            $this->articleRepo->insert($article);
            DatabaseConfig::commitTransaction();

            $response = new ArticlePostResponse();
            $response->article = $article;
            return $response;
        } catch(Exception $e){
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }

    public function validatePosting(ArticlePostRequest $request) 
    {
        if($request->title == null || $request->paragraph == null || trim($request->title) == "" || trim($request->paragraph == "")){
            throw new Exception("Judul dan konten tidak boleh kosong!");
        }
    }

    public function viewArticle(ArticleViewRequest $request) : ArticleViewResponse
    {
        $this->validateView($request);
        try{
            $article = $this->articleRepo->findById($request->id);
            if($article == null){
                throw new Exception("Artikel tidak ditemukan");
            }

            $response = new ArticleViewResponse();
            $response->article = $article;

            return $response;
        } catch(Exception $e){
            throw $e;
        }

    }

    public function validateView(ArticleViewRequest $request) 
    {
        if($request->id == null || trim($request->id) == ""){
            throw new Exception("Id artikel tidak boleh kosong");
        }
    }


    public function setStatus(ArticleStatusRequest $request) : ArticleStatusResponse    
    {
        try{
            DatabaseConfig::beginTransaction();
            $article = $this->articleRepo->findById($request->id);
            if($article == null){
                throw new Exception("Artikel tidak ditemukan");
            }

            $article->status = $request->status;
            $this->articleRepo->update($article);
            DatabaseConfig::commitTransaction();

            $response = new ArticleStatusResponse();
            $response->article = $article;

            return $response;
        } catch (Exception $e){
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }

    public function displayByStatus(ArticleDisplayStatusRequest $request) : ArticleDisplayStatusResponse
    {
        try{
            $article = $this->articleRepo->findByStatus($request->status);
            if($article == null){
                throw new Exception("Mohon maaf untuk sekarang belum ada artikel apapun");
            }

            $response = new ArticleDisplayStatusResponse();
            $response->article = $article;

            return $response;
        } catch(Exception $e){
            throw $e;
        }
    }

    public function editById(ArticleEditRequest $request) : ArticleEditResponse
    {
        $this->validateEdit($request);
        try{
            DatabaseConfig::beginTransaction();
            $article = $this->articleRepo->findById($request->id);
            if($request == null){
                throw new Exception("Artikel tidak ditemukan");
            }
            $article->title = $request->title;
            $article->paragraph = $request->paragraph;
            $article->images = $request->images;
            $article->category = $request->category;
            $this->articleRepo->update($article);
            DatabaseConfig::commitTransaction();
            $response = new ArticleEditResponse();
            $response->article = $article;
            return $response;
        } catch (Exception $e){
            DatabaseConfig::rollbackTransaction();
            throw $e;
        }
    }

    public function validateEdit(ArticleEditRequest $request) 
    {
        if($request->title == null || $request->paragraph == null || trim($request->title) == "" || trim($request->paragraph == "")){
            throw new Exception("Judul dan konten tidak boleh kosong!");
        }
    }

    public function displayById(ArticleDisplayByIdRequest $request) : ArticleDisplayByIdResponse
    {
        try{
            $article = $this->articleRepo->findById($request->id);
            if($article == null){
                throw new Exception("Artikel tidak ditemukan");
            }

            $response = new ArticleDisplayByIdResponse();
            $response->article = $article;

            return $response;
        } catch (Exception $e){
            throw $e;
        }
    }

    

}