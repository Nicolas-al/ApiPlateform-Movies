<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

final class MovieProvider implements RestrictedDataProviderInterface, ContextAwareCollectionDataProviderInterface
{
    public function getCollection(string $resourceClass, ?string $operationName = null, array $context = [])
    {
        
    }

    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Movie::class;
    }
}
