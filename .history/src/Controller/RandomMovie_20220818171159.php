<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/movies/random', name: 'api_movies_random_collection', methods: [Request::METHOD_GET])]
final class RandomMovie
{

}