<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference' => Str::random(35),
            'payer_document' => '1000435654',
            'payer_address' => 'calle 90 # 50A-14',
            'amount' => 79678,
            'status' => 'successful',
            'paid_at' => Carbon::now(),
            'process_url' => 'https://www.example.com',
            'user_id' => User::factory()->create()->id,

        ];
    }
}
