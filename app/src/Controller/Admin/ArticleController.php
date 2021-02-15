<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleEditType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/admin/articles")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("", name="admin_articles_list")
     */
    public function list(ArticleRepository $articleRepository): Response
    {
        return $this->render('admin/articles/list.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_articles_edit", methods={"GET", "POST"})
     */
    public function edit(Article $article, Request $request, TranslatorInterface $translator): Response
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ArticleEditType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', $translator->trans('flash.articles.edited.success'));
        }

        return $this->render('admin/articles/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_articles_delete", methods={"DELETE"})
     */
    public function delete(Article $article, TranslatorInterface $translator): Response
    {
        $this->getDoctrine()->getManager()->remove($article);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', $translator->trans('flash.articles.deleted.success'));

        return $this->redirectToRoute('admin_articles_list');
    }
}
