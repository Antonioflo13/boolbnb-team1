<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'WiFi',
            'Free parking',
            'Pool',
            'Sauna',
            'Sea view',
            'Air coditioning',
            'Concierge',
            'Pets allowed'
        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service;
            $newService->slug = Str::slug($service, '-');
            
            $newService->save();
        }
    }
}
