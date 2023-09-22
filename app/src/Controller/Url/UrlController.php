<?php

namespace App\Controller\Url;

use App\Message\Url\DataExtractor\RickAndMortyUrlDataExtractorMessage;
use App\Service\Url\UrlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    public function __construct(
        private UrlService $urlService,
        private MessageBusInterface $bus
    ) {
    }

    #[Route('/url', name: 'app_url')]
    public function index(): JsonResponse
    {
        
        $this->bus->dispatch(new RickAndMortyUrlDataExtractorMessage());

       // $url = $this->urlService->findUrlsWithEmptyFields();

        //dd($url);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Url/UrlController.php',
        ]);
    }
}
