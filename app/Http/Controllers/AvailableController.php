<?php

namespace App\Http\Controllers;

use App\Models\Available;
use Illuminate\Http\Request;

class AvailableController extends Controller
{
    public function index () {
        return Available::all();
    }

    public function store (Request $request){
        $available = new Available;

        $available->barber_id = $request->barber_id;
        $available->date = $request->date;
        $available->hours = $request->hours;

        $available->save();
            return $response = json_encode([
                "error" => false,
                "mensage" => "Datas cadastradas com sucesso"
            ]);
    }

    public function update(Request $request, $id)
        {

            $post = Available::findOrFail($id);

            $teste = $post->update($request->all());
            if ($teste){
                return "ok";exit;
            }

            return $response = json_encode([
                "error" => false,
                "mensage" => "Post atualizado com sucesso!"
            ]);
        }

    public function destroy($id)
    {
        $post = Available::findOrFail($id);
        $post->delete();
        return $response = json_encode([
            "error" => false,
            "mensage" => "Data deletada com sucesso!"
        ]);
    }
}
