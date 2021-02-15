<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testEntity(): void
    {
        $article = new Article();
        $article->setAuthor($author = new User());
        $article->setTitle('Mon premier article');
        $article->setContent('Voici mon premier article !');

        static::assertSame($author, $article->getAuthor());
        static::assertSame('Mon premier article', $article->getTitle());
        static::assertSame('Voici mon premier article !', $article->getContent());
    }
}
