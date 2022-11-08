<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store (Request $request){
        $service = new Service;

        $service->barber_id = $request->barber_id;
        $service->name = $request->name;
        $service->price = $request->price;

        $service->save();
            return $response = json_encode([
                "error" => false,
                "mensage" => "Serviço cadastrado com sucesso"
            ]);
    }
}
