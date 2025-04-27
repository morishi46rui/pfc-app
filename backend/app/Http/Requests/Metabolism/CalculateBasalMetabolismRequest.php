<?php

declare(strict_types=1);

namespace App\Http\Requests\Metabolism;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'calculateBasalMetabolismRequest',
        title: '基礎代謝量計算リクエスト',
        required: ['age', 'height', 'weight', 'gender'],
        properties: [
            new OA\Property(property: 'age', type: 'integer', description: '年齢', example: 25),
            new OA\Property(property: 'height', type: 'integer', description: '身長 (cm)', example: 170),
            new OA\Property(property: 'weight', type: 'integer', description: '体重 (kg)', example: 70),
            new OA\Property(
                property: 'gender',
                type: 'string',
                description: '性別',
                example: 'male',
                enum: ['male', 'female']
            ),
        ]
    )
]
class CalculateBasalMetabolismRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'age' => 'required|integer|min:0|max:120',
            'height' => 'required|integer|min:0|max:300',
            'weight' => 'required|integer|min:0|max:500',
            'gender' => 'required|string|in:male,female',
        ];
    }
}
