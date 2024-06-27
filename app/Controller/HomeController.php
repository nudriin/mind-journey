<?php
namespace Nurdin\Mind\Controller;
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../Helper/RegexHelper.php";
use Nurdin\Mind\App\ViewRender;
use Nurdin\Mind\Service\ArticleService;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Repository\ArticleRepository;
use Exception;
use Nurdin\Mind\Model\Article\ArticleDisplayStatusRequest;

class HomeController
{
    private ArticleService $articleService;

    public function __construct() 
    {
        $connection = DatabaseConfig::getConnect();
        $articleRepo = new ArticleRepository($connection);
        $this->articleService = new ArticleService($articleRepo);
    }

    public function index() : void
    {  
        
        try{
            $request = new ArticleDisplayStatusRequest();
            $request->status = "Active";
            $article = $this->articleService->displayByStatus($request);

            ViewRender::render("Home/index", [
                "title"=>"MindJourney",
                "article"=>$article->article,
                "pattern"=>getPattern(),
                "replacement"=>getReplacement(),
                "deactive"=>"Mohon maaf untuk sekarang belum ada artikel apapun"
            ]);
        } catch(Exception $e){
            ViewRender::render("Home/index", [
                "title"=>"Mind's",
                "error"=>$e->getMessage()
            ]);
        }
    }
}

?>