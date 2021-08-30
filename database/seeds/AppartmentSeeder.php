<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

use App\Appartment;
use App\User;

class AppartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $appartments = [
            [
                'title' => 'Beach House Belgrade',
                'description' => 'Beach House is unique place in Belgrade. Only 15 minutes drive from city centar. This house on Sava river will give you unique experience in Belgrade. With total of 270 m2 and 400 m2 of garden will give you all that you need. There are 2 terrace where you can enjoy outside. Inside there are living room, kitchen 3 full bathrooms and 4 bedrooms. There is Hi-fi, WiFi, TV, electricity and water. Beside that there is for rent speed boat that can make your experience even better and jet - ski rent.',
                'rooms_number' => '4',
                'bathrooms_number' => '2',
                'beds_number' => '4',
                'square_meters' => '270',
            ],
            [
                'title' => 'Country House immersed in a Winery Estate',
                'description' => 'Beach House is unique place in Belgrade. Only 15 minutes drive from city centar. This house on Sava river will give you unique experience in Belgrade. With total of 270 m2 and 400 m2 of garden will give you all that you need. There are 2 terrace where you can enjoy outside. Inside there are living room, kitchen 3 full bathrooms and 4 bedrooms. There is Hi-fi, WiFi, TV, electricity and water. Beside that there is for rent speed boat that can make your experience even better and jet - ski rent.',
                'rooms_number' => '5',
                'bathrooms_number' => '3',
                'beds_number' => '5',
                'square_meters' => '200',
            ],
            [
                'title' => 'Boheme Cottage with swimming pool',
                'description' => 'Beach House is unique place in Belgrade. Only 15 minutes drive from city centar. This house on Sava river will give you unique experience in Belgrade. With total of 270 m2 and 400 m2 of garden will give you all that you need. There are 2 terrace where you can enjoy outside. Inside there are living room, kitchen 3 full bathrooms and 4 bedrooms. There is Hi-fi, WiFi, TV, electricity and water. Beside that there is for rent speed boat that can make your experience even better and jet - ski rent.',
                'rooms_number' => '2',
                'bathrooms_number' => '1',
                'beds_number' => '1',
                'square_meters' => '80',
            ],
            [
                'title' => 'House in the countryside with pool.',
                'description' => 'Beach House is unique place in Belgrade. Only 15 minutes drive from city centar. This house on Sava river will give you unique experience in Belgrade. With total of 270 m2 and 400 m2 of garden will give you all that you need. There are 2 terrace where you can enjoy outside. Inside there are living room, kitchen 3 full bathrooms and 4 bedrooms. There is Hi-fi, WiFi, TV, electricity and water. Beside that there is for rent speed boat that can make your experience even better and jet - ski rent.',
                'rooms_number' => '8',
                'bathrooms_number' => '3',
                'beds_number' => '8',
                'square_meters' => '400',
            ]
        ];

        foreach ($appartments as $appartment) {
            $newAppartment = new Appartment();
            $newUser = User::where('id',1)->first();
            $newAppartment->user_id = $newUser->id;
            $newAppartment->title = $appartment['title'];
            $newAppartment->slug = Str::slug($appartment['title']);
            $newAppartment->description = $appartment['description'];
            $newAppartment->rooms_number = $appartment['rooms_number'];
            $newAppartment->bathrooms_number = $appartment['bathrooms_number'];
            $newAppartment->beds_number = $appartment['beds_number'];
            $newAppartment->square_meters = $appartment['square_meters'];
            $newAppartment->image = $faker->imageUrl(500,300,'Appartment');
            $newAppartment->longitude = $faker->longitude(-90,90);
            $newAppartment->latitude = $faker->latitude(-180,180);
            
            $newAppartment->save();
        }
    }
}
