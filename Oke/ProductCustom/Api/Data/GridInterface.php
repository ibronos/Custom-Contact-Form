<?php
namespace Oke\ProductCustom\Api\Data;

interface GridInterface
{

    const ARTICLE_ID = 'id';
    const TITLE = 'firstname';

    public function getArticleId();

    public function setArticleId($articleId);

    public function getTitle();

    public function setTitle($title);    
}