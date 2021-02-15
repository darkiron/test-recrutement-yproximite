<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class IndexController extends AbstractController
{
    /**
     * @Route("", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
