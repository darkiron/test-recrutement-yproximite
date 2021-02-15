<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleCategory;
use App\Repository\ArticleCategoryRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleCategoryController extends AbstractController
{
    /**
     * @Route("/articles/categories", name="articles_categories_list")
     */
    public function list(ArticleCategoryRepository $categoryRepository): Response
    {
        return $this->render('articles/categories/list.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/articles/categories/{id}", name="articles_categories_show")
     */
    public function show(ArticleCategory $category, ArticleRepository $articleRepository): Response
    {
        return $this->render('articles/categories/show.html.twig', [
            'category' => $category,
            'articles' => $articleRepository->findByFilters([
                'status'     => Article::STATUS_PUBLISHED,
                'categories' => [$category],
            ]),
        ]);
    }
}
