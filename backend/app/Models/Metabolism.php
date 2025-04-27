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
            type: 'integer',
            description: '基礎代謝量の計算結果',
            example: 1
        ),
    ]
)]
class Metabolism extends BaseModel
{
}
