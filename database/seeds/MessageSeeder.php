<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Appartment;
use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $appartments = Appartment::all();

        foreach ($appartments as $appartment) {
            $newMessage = new Message();
            $newMessage->appartment_id = $appartment->id;
            $newMessage->name = $faker->firstName(). ' ' .$faker->firstName();
            $newMessage->email = $faker->freeemail();
            $newMessage->message = $faker->text(200);

            $newMessage->save();
        }
    }
}
