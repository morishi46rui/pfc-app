<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases\Metabolism;

use App\Http\Requests\Metabolism\CalculateBasalMetabolismRequest;
use App\UseCases\Metabolism\CalculateBasalMetabolism;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CalculateBasalMetabolismTest extends TestCase
{
    use RefreshDatabase;

    private CalculateBasalMetabolism $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new CalculateBasalMetabolism();
    }

    #[Test]
    public function 男性の基礎代謝量が計算できる(): void
    {
        $request = $this->getMockBuilder(CalculateBasalMetabolismRequest::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['input'])
            ->getMock();

        $request->expects($this->any())
            ->method('input')
            ->willReturnCallback(fn (string $key) => [
                'age' => 25,
                'height' => 170,
                'weight' => 70,
                'gender' => 'male',
            ][$key] ?? null);

        $result = ($this->action)($request);
        $expected = round(
            88.362
                + (13.397 * 70)
                + (4.799 * 170)
                - (5.677 * 25),
            2
        );

        $this->assertIsArray($result);
        $this->assertArrayHasKey('result', $result);
        $this->assertSame($expected, $result['result']);
    }

    #[Test]
    public function 女性の基礎代謝量が計算できる(): void
    {
        $request = $this->getMockBuilder(CalculateBasalMetabolismRequest::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['input'])
            ->getMock();

        $request->expects($this->any())
            ->method('input')
            ->willReturnCallback(fn (string $key) => [
                'age' => 30,
                'height' => 160,
                'weight' => 55,
                'gender' => 'female',
            ][$key] ?? null);

        $result = ($this->action)($request);
        $expected = round(
            447.593
                + (9.247 * 55)
                + (3.098 * 160)
                - (4.330 * 30),
            2
        );

        $this->assertIsArray($result);
        $this->assertArrayHasKey('result', $result);
        $this->assertSame($expected, $result['result']);
    }
}
