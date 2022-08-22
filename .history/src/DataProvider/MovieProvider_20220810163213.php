<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

final class MovieProvider implements RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        
    }
}
