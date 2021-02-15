<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ArticleController extends AbstractController
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @Route("/", name="home")
     */
    public function list(ArticleRepository $articleRepository): Response
    {
        return $this->render('articles/list.html.twig', [
            'articles' => $articleRepository->findByFilters(['status' => 'published']),
        ]);
    }

    /**
     * @Route("/articles", name="articles_list")
     */
    public function secondList() : Response {
        return $this->forward(
            'App\Controller\ArticleController::list',
            []
        );
    }

    /**
     * @Route("/articles/{id}", name="articles_show")
     */
    public function show(Article $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }
}
