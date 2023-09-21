<?php

namespace App\Controller\Url;

use App\CacheClient\Redis\Interface\RedisClientInterface;
use App\HttpClient\RickAndMorty\Interface\RickAndMortyApiClientInterface;
use App\Message\Url\UrlGeneratorMessage;
use App\Service\Url\UrlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    public function __construct(
        private UrlService $urlService,
        private MessageBusInterface $messageBus
    ) {
    }

    #[Route('/url', name: 'app_url')]
    public function index(): JsonResponse
    {
       
        $this->messageBus->dispatch(new UrlGeneratorMessage());

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Url/UrlController.php',
        ]);
    }
}
