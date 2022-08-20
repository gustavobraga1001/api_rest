<?php

namespace App\Classes;

use App\Models\Appointment;
use Illuminate\Http\Request;


class Update {

    public function update (Request $request, $id) {
        $event = Appointment::findOrFail($id);
        $event->update($request);
    }
}
