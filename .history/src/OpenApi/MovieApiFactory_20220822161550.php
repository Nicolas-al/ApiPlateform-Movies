<?php

declare(strict_types=1);

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;

final class MovieApiFactory implements OpenApiFactoryInterface
{
    public function __construct(private OpenApiFactoryInterface $decorated )
    {
        
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        $randomItem = $openApi->getPaths()->getPath('/api/movies/random');

        $getItem = $openApi->getPaths()->getPath('/api/movies/{id}');

        $randomOperation = $randomItem->getGet();

        $getOperation = $getItem->getGet();

        $randomOperation->addResponse($getOperation->getResponses()[200]);

        $response = $operation->getResponses()[200];

        $response = $response->withDescription('Movie item');

        $content = $response->getContent();
        dd($response);
    }
}