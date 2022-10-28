<?php

namespace App\Http\Controllers;

use App\Models\AppoTest;
use Illuminate\Http\Request;

class AppoTestController extends Controller
{
    public function store(Request $request)
    {
        $appo = new AppoTest;

        $appo->id_barber = $request->id_barber;
        $appo->avatar_url = $request->avatar_url;
        $appo->name = $request->name;
        $appo->service = $request->service;
        $appo->selectedYear = $request->selectedYear;
        $appo->selectedMonth = $request->selectedMonth;
        $appo->selectedDay = $request->selectedDay;
        $appo->selectedHour = $request->selectedHour;

        $appo->save();
            return $response = json_encode([
                "error" => false,
                "mensage" => "Appo cadastrado com sucesso"
            ]);
    }
}
