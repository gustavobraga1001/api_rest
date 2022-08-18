<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\User;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Appointment::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Verifica os campos da requisição
        $request->validate([
            'dia' => 'required|string',
            'mes' => 'required|string',
            'ano' => 'required|string',
            'hora' => 'required|string'
        ]);

        $appointment = new Appointment;

        //Defini os dados para serem inseridos
        $appointment->dia = $request->dia;
        $appointment->mes = $request->mes;
        $appointment->ano = $request->ano;
        $appointment->hora = $request->hora;
        $user = auth()->user();
        $appointment->user_id = $user->id;
        $appointment->user_name = $user->name;

        //Checa a data
        $checkHora = Appointment::where('hora', $request->hora)->first();
        $checkdia = Appointment::where('dia', $request->dia)->first();
        $checkmes = Appointment::where('mes', $request->mes)->first();
        $checkano = Appointment::where('ano', $request->ano)->first();

        if ($checkHora && $checkdia && $checkmes && $checkano) {
            return $response = json_encode([
                "error" => true,
                "mensage" => "Essa data já esta em uso"
            ]);
        }

        $id = $user->id;

        $check = Appointment::where('user_id', $id)->first();

        if ($check){
            return $response = json_encode([
                "error" => true,
                "mensage" => "Você só pode ter um agendamento por vez"
            ]);
        } else {
            $appointment->save();
            return $response = json_encode([
                "error" => false,
                "mensage" => "Agendamento publicado com successo"
            ]);
        }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = auth()->user();

        $id = $user->id;

        $appointment = Appointment::where('user_id', $id)->first();

        if ($appointment){
            $appointment->delete();
            return $response = json_encode([
                "error" => false,
                "mensage" => "Agendamento deletado com sucesso!"
            ]);
        } else {
            return $response = json_encode([
                "error" => true,
                "mensage" => "Não há agendamentos cadastrados"
            ]);
        }
    }

    public function one () {

        $user = auth()->user();

        $id = $user->id;
        //var_dump($id);exit;

        $appointmentOwner = Appointment::where('user_id', $id)->first();

        if ($appointmentOwner){
            return $response = json_encode($appointmentOwner);
            //var_dump($appointmentOwner);exit;
        } else {
            return $response = json_encode([
                "error" => true,
                "mensage" => "Não há agendamentos cadastrados"
            ]);
        }
    }
}

