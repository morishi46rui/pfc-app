<?php

declare(strict_types=1);

namespace App\UseCases\Metabolism;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'basalMetabolismResponse',
    title: '基礎代謝量計算結果',
    required: ['result'],
    properties: [
        new OA\Property(
            property: 'result',
            ref: '#/components/schemas/metabolism/properties/result',
        ),
    ]
)]

class CalculateBasalMetabolism
{
    public function __invoke(): array
    {
        return ['result' => 1];
    }
}
