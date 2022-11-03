<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function store(Request $request) {

        $admin = new Admin;

        $admin->email = $request->email;
        $admin->password = $request->password;

        $admin->save();
            return $response = json_encode([
                "error" => false,
                "mensage" => "Admin cadastrado com successo"
            ]);
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return $response = json_encode([
            "error" => false,
            "mensage" => "Admin deletado com sucesso!"
        ]);
    }
}
