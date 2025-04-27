<?php

declare(strict_types=1);

namespace App\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'metabolism',
    title: '代謝関連情報',
    required: ['result'],
    properties: [
        new OA\Property(
            property: 'result',
            type: 'number',
            format: 'float',
            description: '計算された基礎代謝量（kcal/日）',
            example: 1550.72
        ),
    ]
)]
class Metabolism extends BaseModel
{
}
