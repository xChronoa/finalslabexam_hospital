<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        // Define validation rules
        $rules = [
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'visit_date' => 'required|date',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'required|string',
        ];

        // Validate the incoming request data
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()], 400);
        }

        try {
            // If the product doesn't exist, create a new entry
            $appointment = new Appointment();
            $appointment->patient_id = $request->patient_id;
            $appointment->doctor_id = $request->doctor_id;
            $appointment->visit_date = $request->visit_date;
            $appointment->diagnosis = $request->diagnosis;
            $appointment->treatment = $request->treatment;
            $appointment->notes = $request->notes;
            $appointment->save();
            return response()->json(['status' => 201, 'message' => 'Successfully booked an appointment'], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error'], 500);
        }
    }

    public function reschedule(Request $request)
    {

    }

    public function cancel($id)
    {
        // Fetch the product from the database
        $appointment = Appointment::find($id);

        if (!$appointment) {
            // Product not found, return appropriate response (e.g., 404 Not Found)
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        // Delete the product
        $appointment->delete();

        // Return a success response
        return response()->json(['message' => 'Appointment cancelled successfully']);
    }
}
