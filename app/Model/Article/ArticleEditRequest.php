<?php
namespace Nurdin\Mind\Model\Article;

class ArticleEditRequest{
    public ?string $id = null;
    public ?string $title = null;
    public ?string $paragraph = null;
    public ?string $category = null;
    public ?string $images = null;    
}