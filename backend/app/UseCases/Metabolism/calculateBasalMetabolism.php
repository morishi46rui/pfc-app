<?php

declare(strict_types=1);

namespace App\UseCases\Metabolism;

use App\Http\Requests\Metabolism\CalculateBasalMetabolismRequest;
use App\Utils\Metabolism\BasalMetabolismCalculator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'basalMetabolismResponse',
    title: '基礎代謝量計算結果',
    required: ['result'],
    properties: [
        new OA\Property(
            property: 'result',
            type: 'number',
            format: 'float',
            description: '基礎代謝量（kcal/日）',
            example: 1550.72
        ),
    ]
)]
class CalculateBasalMetabolism
{
    public function __invoke(CalculateBasalMetabolismRequest $request): array
    {
        $bmr = BasalMetabolismCalculator::calculate(
            $request->input('gender'),
            $request->input('weight'),
            $request->input('height'),
            $request->input('age')
        );

        return ['result' => round($bmr, 2)];
    }
}
