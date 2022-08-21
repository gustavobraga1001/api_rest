<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Available;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barber;

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
    public function store (Request $request){
        var_dump($request->name);exit;
        $day = $request->selectedDay;
        $month = $request->selectedMonth;
        $year = $request->selectedYear;
        $date = $year .'-' .$month. '-'. $day;

        $barberDate = Available::where('date', $date)->first();

        $availables = $barberDate->hours;

        $key = array_search($request->selectedHour, $availables);
        if($key!==false){
        unset($availables[$key]);
        }




        $appointment = new Appointment;

        //Defini os dados para serem inseridos
        $appointment->id_barber = $request->id_barber;
        $appointment->avatar_url = $request->avatar_url;
        $appointment->name = $request->name;
        $appointment->service = $request->service;
        $appointment->selectedYear = $request->selectedYear;
        $appointment->selectedMonth = $request->selectedMonth;
        $appointment->selectedDay = $request->selectedDay;
        $appointment->selectedHour = $request->selectedHour;
        $user = auth()->user();
        $appointment->user_id = $user->id;
        $appointment->user_name = $user->name;

        //Checa a data
        /*$checkHora = Appointment::where('selectedHour', $request->selectedHour)->first();
        $checkdia = Appointment::where('selectedDay', $request->selectedDay)->first();
        $checkmes = Appointment::where('selectedMonth', $request->selectedMonth)->first();
        $checkano = Appointment::where('selectedYear', $request->selectedYear)->first();

        //$request2 = $request->toArray();
        //var_dump($user->name);exit;

        if ($checkHora && $checkdia && $checkmes && $checkano) {
            return $response = json_encode([
                "error" => true,
                "mensage" => "Essa data já esta em uso"
            ]);
        }*/

        $id = $user->id;

        $check = Appointment::where('user_id', $id)->first();



        if ($check){
            return $response = json_encode([
                "error" => true,
                "mensage" => "Você só pode ter um agendamento por vez"
            ]);

        } else {

            $appointment->save();
            $this->update($availables, $barberDate->id);
            $deleteHours = Available::where('date', $date)->first();
            if ($deleteHours->hours == null) {
                $this->deleteHour($barberDate->id);
            }
                return $response = json_encode([
                    "error" => false,
                    "mensage" => "Agendamento publicado com successo"
                ]);


        }


    }

    public function update($availables, $id)
        {

            $post = Available::findOrFail($id);

            $post->update(["hours" => $availables]);
        }

        public  function deleteHour($id){
            $post = Available::findOrFail($id);
            $post->delete();
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

        //return $appointmentOwner->service;exit;

        if ($appointmentOwner){
            return $appointmentOwner;
            //var_dump($appointmentOwner);exit;
        } else {
            return $response = json_encode([
                "error" => true,
                "mensage" => "Não há agendamentos cadastrados"
            ]);
        }
    }
}
