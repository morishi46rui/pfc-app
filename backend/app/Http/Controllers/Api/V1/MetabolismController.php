<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Metabolism\CalculateBasalMetabolismRequest;
use App\UseCases\Metabolism\CalculateBasalMetabolism;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Metabolism', description: '代謝関連')]
class MetabolismController extends Controller
{
    #[OA\Post(
        path: '/basal-metabolism',
        tags: ['Metabolism'],
        summary: '基礎代謝量の計算',
        description: '基礎代謝量を計算する',
        operationId: 'calculateBasalMetabolism',
        requestBody: new OA\RequestBody(
            description: '基礎代謝量計算リクエスト',
            required: true,
            content: new OA\JsonContent(
                ref: '#/components/schemas/calculateBasalMetabolismRequest'
            )
        ),
        responses: [
            new OA\Response(
                response: '200',
                description: '計算結果を返却',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/basalMetabolismResponse'
                )
            ),
            new OA\Response(response: '400', ref: '#/components/responses/400'),
            new OA\Response(response: '401', ref: '#/components/responses/401'),
            new OA\Response(response: '403', ref: '#/components/responses/403'),
            new OA\Response(response: '422', ref: '#/components/responses/422'),
        ]
    )]
    public function index(CalculateBasalMetabolismRequest $request, CalculateBasalMetabolism $action): JsonResponse
    {
        $response = $action($request);

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
