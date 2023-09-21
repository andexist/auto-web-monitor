<?php

namespace App\Controller\Url;

use App\CacheClient\Redis\Interface\RedisClientInterface;
use App\HttpClient\RickAndMorty\Interface\RickAndMortyApiClientInterface;
use App\Service\Url\UrlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    public function __construct(
        private UrlService $urlService,
        private RickAndMortyApiClientInterface $client
    ) {
    }

    #[Route('/url', name: 'app_url')]
    public function index(): JsonResponse
    {
       
        $response = $this->client->fetchCharacters(43);

        dd($response);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Url/UrlController.php',
        ]);
    }
}
