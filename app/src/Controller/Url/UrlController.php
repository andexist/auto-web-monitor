<?php

namespace App\Controller\Url;

use App\Service\Url\UrlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    public function __construct(private UrlService $urlService)
    {
    }

    #[Route('/url', name: 'app_url')]
    public function index(): JsonResponse
    {
        $urls = $this->urlService->findAll();

        return $this->json($urls);
    }
}
