<?php

declare(strict_types=1);

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'pfc-app API',
    version: '0.1',
    description: 'pfc-app API',
    contact: new OA\Contact(email: 'pfc-app@example.com')
)]
#[OA\Server(
    url: 'http://localhost:8000/api/v1',
    description: 'Localhost API Server'
)]
class OpenApi {}
