<?php
namespace Nurdin\Mind\Controller;

use Exception;
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Model\ArticleDisplayResponse;
use Nurdin\Mind\Repository\ArticleRepository;
use Nurdin\Mind\Repository\SuggestionsRepository;
use Nurdin\Mind\Service\ArticleService;
use Nurdin\Mind\Service\SuggestionsService;

class AdminHomeController
{
    private ArticleService $articleService;
    private SuggestionsService $suggestionsService;
    public function __construct() 
    {
        $suggestionsRepo = new SuggestionsRepository(DatabaseConfig::getConnect());
        $articleRepo = new ArticleRepository(DatabaseConfig::getConnect());
        $this->articleService = new ArticleService($articleRepo);
        $this->suggestionsService = new SuggestionsService($suggestionsRepo);
    }

    public function index()
    {
        try{
            $article = $this->articleService->displayAll();
            $suggestions = $this->suggestionsService->displayAll();
            $countArticle = sizeof($article->article);
            $countActive = 0;
            $countSuggestions = sizeof($suggestions->suggestions);
            foreach($article->article as $row){
                if($row['status'] == "Active"){
                    $countActive++;
                }
            }
            $countDeactive = $countArticle - $countActive;
            ViewRender::adminRender("Admin/dashboard", [
                "title"=>"Dashboard",
                "size_article"=>$countArticle,
                "size_active"=>$countActive,
                "size_deactive"=>$countDeactive,
                "size_suggestions"=>$countSuggestions
            ]);
        } catch(Exception $e){
            try{
                $suggestions = $this->suggestionsService->displayAll();
                $countSuggestions = sizeof($suggestions->suggestions);
                ViewRender::adminRender("Admin/dashboard", [
                    "title"=>"Dashboard",
                    "size_article"=>0,
                    "size_active"=>0,
                    "size_deactive"=>0,
                    "size_suggestions"=>$countSuggestions
                ]);
            } catch (Exception $e){
                ViewRender::adminRender("Admin/dashboard", [
                    "title"=>"Dashboard",
                    "size_article"=>0,
                    "size_active"=>0,
                    "size_deactive"=>0,
                    "size_suggestions"=>0
                ]);
            }
        }
    }
}