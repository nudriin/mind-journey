<?php
namespace Nurdin\Mind\Controller;

use Exception;
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Model\Suggestion\SuggestionsAddRequest;
use Nurdin\Mind\Model\Suggestion\SuggestionsDeleteRequest;
use Nurdin\Mind\Repository\ArticleRepository;
use Nurdin\Mind\Repository\SuggestionsRepository;
use Nurdin\Mind\Service\ArticleService;
use Nurdin\Mind\Service\SuggestionsService;

class SuggestionsController
{
    private SuggestionsService $suggestionsService;
    private ArticleService $articleService;

    public function __construct(){
        $articleRepo = new ArticleRepository(DatabaseConfig::getConnect());
        $suggestionsRepo = new SuggestionsRepository(DatabaseConfig::getConnect());
        $this->suggestionsService = new SuggestionsService($suggestionsRepo);
        $this->articleService = new ArticleService($articleRepo);
    }

    public function postAddSuggestion()
    {
        
        $request = new SuggestionsAddRequest();
        $request->email = htmlspecialchars($_POST['email']);
        $request->name = htmlspecialchars($_POST['name']);
        $request->message = htmlspecialchars($_POST['message']);
        try{
            $this->suggestionsService->addSuggestion($request);

            ViewRender::redirect("/");
        } catch (Exception $e){
            ViewRender::redirect("/");
        }
    }

    public function suggestions()
    {
        try{
            $suggestions = $this->suggestionsService->displayAll();

            ViewRender::adminRender("Admin/suggestions", [
                "title"=>"Suggestion",
                "suggestions"=>$suggestions->suggestions
            ]);
        } catch(Exception $e){
            ViewRender::adminRender("Admin/suggestions", [
                "title"=>"Suggestion",
                "error"=>$e->getMessage()
            ]);
        }
    }

    public function postSuggestions()
    {
        $request = new SuggestionsDeleteRequest();
        $request->id = htmlspecialchars($_POST['post_id']);
        try{
            $this->suggestionsService->deleteById($request);

            ViewRender::redirect("/suggestions");
        } catch(Exception $e){
            ViewRender::redirect("/suggestions");
        }
    }
}