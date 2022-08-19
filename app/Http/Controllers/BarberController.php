<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        return Barber::all(['id','avatar_url','name','stars']);
    }

    public function show($id) {
        $barber = Barber::where('id', $id)->first();
        if ($barber) {
            return $barber;
        } else {
            return $response = json_encode([
                "error" => true,
                "mensage" => "Barbeiro não encotrado!"
            ]);
        }
    }

    public function store(Request $request) {

        $barber = new Barber;

        //Defini os dados para serem inseridos
        $barber->avatar_url = $request->avatar_url;
        $barber->name = $request->name;
        $barber->stars = $request->stars;
        $barber->services = $request->services;
        $barber->available = $request->available;

        //var_dump($request->services);exit;

        $barber->save();
            return $response = json_encode([
                "error" => false,
                "mensage" => "Barbeiro cadastrado com successo"
            ]);
    }
}
