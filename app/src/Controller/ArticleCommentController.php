<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleComment;
use App\Form\ArticleCommentCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleCommentController extends AbstractController
{
    /**
     * Used in Twig only, with `render(controller())`.
     */
    public function form(Article $article): Response
    {
        $form = $this->createForm(ArticleCommentCreateType::class);

        return $this->render('articles/comments/_form.html.twig', [
            'article' => $article,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/articles/{id}/comments", name="articles_comments_create", methods={"POST"})
     */
    public function create(Article $article, Request $request): Response
    {
        $comment = new ArticleComment();
        $article->addComment($comment);

        $form = $this->createForm(ArticleCommentCreateType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_show', ['id' => $article->getId()]);
        }

        throw new \RuntimeException('Traiter les erreurs de formulaires...');
    }

    /**
     * @Route("/comment/{id}", name="show_comment", methods={"GET"})
     * @param ArticleComment $comment
     * @return Response
     */
    public function show(ArticleComment $comment) : Response{
        return $this->render('articles/comments/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/comments", name="list_comment", methods={"GET"})
     * @return Response
     */
    public function list() : Response{
        return $this->render('articles/comments/list.html.twig', [
            'comments' => $this->getDoctrine()->getManager()->getRepository(ArticleComment::class)->findAll(),
        ]);
    }
}
