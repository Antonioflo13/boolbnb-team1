<?php

use Illuminate\Database\Seeder;

use App\Service;
use App\Appartment;
use App\AppartmentService;

class AppartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appartments = Appartment::all();
        $services = Service::all();

        foreach ($appartments as $key => $appartment) {
            $newAppartmentService = new AppartmentService();
            $newAppartmentService->appartment_id = $appartment->id;
            $newAppartmentService->service_id = $services[$key]->id;

            $newAppartmentService->save();
        }
        foreach ($appartments as $key => $appartment) {
            $newAppartmentService = new AppartmentService();
            $newAppartmentService->appartment_id = $appartment->id;
            $newAppartmentService->service_id = $services[$key+3]->id;

            $newAppartmentService->save();
        }
    }
}
