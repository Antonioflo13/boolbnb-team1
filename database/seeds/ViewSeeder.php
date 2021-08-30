<?php

use Illuminate\Database\Seeder;

use App\View;
use App\Appartment;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appartments = Appartment::all();

        foreach ($appartments as $appartment) {
            $newView = new View();
            $newView->appartment_id = $appartment->id;

            $newView->save();
        }
    }
}
