<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function view()
    {
        $appointment = new Appointment();
        $appointments = $appointment->all();

        return response()->json(['status' => 200, 'data' => $appointments]);
    }

    public function patientView($id) {

    }

    public function book(Request $request)
    {
    }

    public function reschedule(Request $request)
    {
    }

    public function cancel(Request $request, $id)
    {
    }
}
