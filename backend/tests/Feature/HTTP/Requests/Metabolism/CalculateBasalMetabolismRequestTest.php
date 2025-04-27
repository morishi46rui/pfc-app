<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Requests\Metabolism;

use App\Http\Requests\Metabolism\CalculateBasalMetabolismRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CalculateBasalMetabolismRequestTest extends TestCase
{
    use RefreshDatabase;

    private function getRules(): array
    {
        return (new CalculateBasalMetabolismRequest())->rules();
    }

    #[Test]
    public function 有効なペイロードでバリデーションを通過する(): void
    {
        $data = [
            'age' => 30,
            'height' => 175,
            'weight' => 68,
            'gender' => 'female',
        ];

        $validator = Validator::make($data, $this->getRules());
        $this->assertTrue($validator->passes(), 'Expected valid data to pass validation');
    }

    #[Test]
    public function 必須フィールドが欠けているとバリデーションエラーとなる(): void
    {
        $validator = Validator::make([], $this->getRules());
        $this->assertFalse($validator->passes(), 'Expected missing fields to fail');
        $errors = $validator->errors()->keys();
        $this->assertEqualsCanonicalizing(
            ['age', 'height', 'weight', 'gender'],
            $errors,
            'Expected errors for all required fields'
        );
    }

    #[Test]
    public function ageは整数で0～120の範囲内である必要がある(): void
    {
        $rules = $this->getRules();

        $v1 = Validator::make(['age' => 'abc'] + array_fill_keys(['height', 'weight', 'gender'], 1), $rules);
        $this->assertTrue($v1->fails());
        $this->assertArrayHasKey('age', $v1->errors()->messages());

        $v2 = Validator::make(['age' => -1] + ['height' => 170, 'weight' => 60, 'gender' => 'male'], $rules);
        $this->assertTrue($v2->fails());
        $this->assertArrayHasKey('age', $v2->errors()->messages());

        $v3 = Validator::make(['age' => 121] + ['height' => 170, 'weight' => 60, 'gender' => 'male'], $rules);
        $this->assertTrue($v3->fails());
        $this->assertArrayHasKey('age', $v3->errors()->messages());
    }

    #[Test]
    public function heightとweightは定義された範囲内の整数である必要がある(): void
    {
        $rules = $this->getRules();

        $v1 = Validator::make(['height' => 301, 'age' => 25, 'weight' => 60, 'gender' => 'male'], $rules);
        $this->assertTrue($v1->fails());
        $this->assertArrayHasKey('height', $v1->errors()->messages());

        $v2 = Validator::make(['weight' => 501, 'age' => 25, 'height' => 170, 'gender' => 'female'], $rules);
        $this->assertTrue($v2->fails());
        $this->assertArrayHasKey('weight', $v2->errors()->messages());
    }

    #[Test]
    public function genderは必須かつ文字列である必要がある(): void
    {
        $rules = $this->getRules();

        $v1 = Validator::make(['age' => 25, 'height' => 170, 'weight' => 60], $rules);
        $this->assertTrue($v1->fails());
        $this->assertArrayHasKey('gender', $v1->errors()->messages());

        $v2 = Validator::make(['gender' => 123, 'age' => 25, 'height' => 170, 'weight' => 60], $rules);
        $this->assertTrue($v2->fails());
        $this->assertArrayHasKey('gender', $v2->errors()->messages());
    }
}
