<?php

declare(strict_types=1);

namespace Tests\Feature\HTTP\Controllers\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Spectator\Spectator;
use Tests\TestCase;

class MetabolismControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function basal_metabolism_レスポンス200が返ること(): void
    {
        Spectator::using('api-docs.json');
        $this->getJson('/api/v1/basal-metabolism')
            ->assertValidRequest()
            ->assertValidResponse(200);
    }
}
