<?php

use Illuminate\Database\Seeder;

use App\Promotion;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            [
                'title' => 'Base',
                'price' => 2.99,
                'hours' => 24
            ],
            [
                'title' => 'Standard',
                'price' => 5.99,
                'hours' => 72
            ],
            [
                'title' => 'Premium',
                'price' => 9.99,
                'hours' => 144
            ]
        ];

        foreach ($promotions as $promotion) {
            $newPromotion = new Promotion();
            $newPromotion->title = $promotion['title'];
            $newPromotion->price = $promotion['price'];
            $newPromotion->hours = $promotion['hours'];

            $newPromotion->save();
        }

    }
}
