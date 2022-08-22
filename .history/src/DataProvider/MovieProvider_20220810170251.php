<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\MovieRepository;

final class MovieProvider implements RestrictedDataProviderInterface, ContextAwareCollectionDataProviderInterface
{
public function __construct(private MovieRepository $movieRepository)
{
    
}

    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = [])
    {
        $page = $context['filters']['page'] ?? 1;
        return $this->movieRepository->getMovies();
    }

    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Movie::class;
    }
}
