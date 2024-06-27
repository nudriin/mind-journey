<?php

use Nurdin\Mind\App\Router;
use Nurdin\Mind\Controller\AdminHomeController;
use Nurdin\Mind\Controller\ArticleController;
use Nurdin\Mind\Controller\HomeController;
use Nurdin\Mind\Controller\SuggestionsController;
use Nurdin\Mind\Controller\AdminController;
use Nurdin\Mind\Controller\DiaryController;
use Nurdin\Mind\Controller\UserHomeController;
use Nurdin\Mind\Middleware\AdminMustLoginMiddleware;
use Nurdin\Mind\Middleware\AdminMustNotLoginMiddleware;
use Nurdin\Mind\Controller\UsersController;
use Nurdin\Mind\Domain\User;
use Nurdin\Mind\Middleware\UserMustLoginMiddleware;
use Nurdin\Mind\Middleware\UserMustNotLoginMiddleware;

require_once "../vendor/autoload.php";
require_once "../app/App/Router.php";


Router::add("GET", "/", HomeController::class, "index");

Router::add("GET", "/article", ArticleController::class, "article");
Router::add("GET", "/active-article", ArticleController::class, "activeArticle", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/active-article", ArticleController::class, "postActiveArticle", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/deactive-article", ArticleController::class, "deactiveArticle", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/deactive-article", ArticleController::class, "postDeactiveArticle", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/article/([a-zA-Z]+)/([a-z0-9A-Z]+)", ArticleController::class, "viewArticle");
Router::add("GET", "/post-article", ArticleController::class, "postingArticle", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/post-article", ArticleController::class, "postPostingArticle", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/article/([a-zA-Z]+)", ArticleController::class, "articleByCategory");
Router::add("GET", "/edit-article/([a-z0-9A-Z]+)", ArticleController::class, "editArticle", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/edit-article/([a-z0-9A-Z]+)", ArticleController::class, "postEditArticle", [AdminMustLoginMiddleware::class]);


Router::add("POST", "/", SuggestionsController::class, "postAddSuggestion");
Router::add("GET", "/suggestions", SuggestionsController::class, "suggestions", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/suggestions", SuggestionsController::class, "postSuggestions", [AdminMustLoginMiddleware::class]);


Router::add("GET", "/admin", AdminHomeController::class, "index", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/admin/login", AdminController::class, "login", [AdminMustNotLoginMiddleware::class]);
Router::add("POST", "/admin/login", AdminController::class, "postLogin", [AdminMustNotLoginMiddleware::class]);
Router::add("GET", "/admin/logout", AdminController::class, "logout", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/admin/profile", AdminController::class, "profileUpdate", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/admin/profile", AdminController::class, "postProfileUpdate", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/admin/password", AdminController::class, "passwordUpdate", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/admin/password", AdminController::class, "postPasswordUpdate", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/admin/register", AdminController::class, "register", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/admin/register", AdminController::class, "postRegister", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/admin/admin-account", AdminController::class, "adminAccount", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/admin/chat/([a-zA-Z0-9_.%+-]+@[a-zA-Z0-9.-]+)", AdminController::class, "chat", [AdminMustLoginMiddleware::class]);
Router::add("POST", "/admin/chat/([a-zA-Z0-9_.%+-]+@[a-zA-Z0-9.-]+)", AdminController::class, "postChat", [AdminMustLoginMiddleware::class]);
Router::add("GET", "/admin/chat", AdminController::class, "listChat", [AdminMustLoginMiddleware::class]);
// Router::add("POST", "/admin/chat", AdminController::class, "postChat", [AdminMustLoginMiddleware::class]);

Router::add("GET", "/user", UserHomeController::class, "index", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/register", UsersController::class, "register", [UserMustNotLoginMiddleware::class]);
Router::add("POST", "/user/register", UsersController::class, "postRegister", [UserMustNotLoginMiddleware::class]);
Router::add("GET", "/user/login", UsersController::class, "login", [UserMustNotLoginMiddleware::class]);
Router::add("POST", "/user/login", UsersController::class, "postLogin", [UserMustNotLoginMiddleware::class]);
Router::add("GET", "/user/password", UsersController::class, "passwordUpdate", [UserMustLoginMiddleware::class]);
Router::add("POST", "/user/password", UsersController::class, "postPasswordUpdate", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/logout", UsersController::class, "logout", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/profile", UsersController::class, "profile", [UserMustLoginMiddleware::class]);
Router::add("POST", "/user/profile", UsersController::class, "postProfile", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/chat", UsersController::class, "chat", [UserMustLoginMiddleware::class]);
Router::add("POST", "/user/chat", UsersController::class, "postChat", [UserMustLoginMiddleware::class]);

Router::add("GET", "/user/diary", DiaryController::class, "diary", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/diary/([a-zA-Z0-9_.%+-]+@[a-zA-Z0-9.-]+)/([a-z0-9A-Z]+)", DiaryController::class, "viewDiary", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/post-diary", DiaryController::class, "addDiary", [UserMustLoginMiddleware::class]);
Router::add("POST", "/user/post-diary", DiaryController::class, "postAddDiary", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/edit-diary/([a-zA-Z0-9_.%+-]+@[a-zA-Z0-9.-]+)/([a-z0-9A-Z]+)", DiaryController::class, "updateDiary", [UserMustLoginMiddleware::class]);
Router::add("POST", "/user/edit-diary/([a-zA-Z0-9_.%+-]+@[a-zA-Z0-9.-]+)/([a-z0-9A-Z]+)", DiaryController::class, "postUpdateDiary", [UserMustLoginMiddleware::class]);
Router::add("POST", "/user/delete/([a-zA-Z0-9_.%+-]+@[a-zA-Z0-9.-]+)/([a-z0-9A-Z]+)", DiaryController::class, "deleteDiary", [UserMustLoginMiddleware::class]);
Router::add("GET", "/user/delete/([a-zA-Z0-9_.%+-]+@[a-zA-Z0-9.-]+)/([a-z0-9A-Z]+)", DiaryController::class, "deleteDiary", [UserMustLoginMiddleware::class]);

// Router::add("GET", "/user/diary/([a-z0-9A-Z^\w!@£]+)/([a-z0-9A-Z]+)", DiaryController::class, "viewDiary", [UserMustLoginMiddleware::class]);

Router::run();


