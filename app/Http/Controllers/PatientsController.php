<?php

namespace App\Http\Controllers;

use App\Helpers\CMail;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\RegistrationFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatientsController extends Controller
{
    public function viewPatient(Request $request, $id){
       $patient = Patient::with('receptionist')->findOrFail($id);
        $data = [
            'pageTitle' => 'View Patient',
            'patient' => $patient
        ];
        return view('back.pages.patients.view-patient',$data);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::orderBy('id','desc')->get();
       
        $data = [
            'pageTitle' => 'List Patients',
            'patients' => $patients
        ];
        return view('back.pages.patients.list-patients',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fees = RegistrationFee::pluck('fee_amount')->first();
      
        $data = [
            'pageTitle' => 'Patients Registration'
            
        ];
        return view('back.pages.patients.create-patient',$data,compact('fees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone_number' => 'required|numeric',
            'age' => 'required|integer|min:0',
            'address' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'registration_fee' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,mobile_money,credit_card',
            'medical_history' => 'nullable|string',
        ]);
    
       // Generate MRN Number
        $lastPatient = Patient::latest()->first();
        $nextId = $lastPatient ? $lastPatient->id + 1 : 1;
        // Generate a secure MRN with a mix of numbers and letters
        $randomString = Str::upper(Str::random(5)); 
        $mrnNumber = 'MRN-' . $nextId . $randomString;
    
        // Store patient information in the database
        $patient = Patient::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'address' => $request->address,
            'gender' => $request->gender,
            'registration_fee' => $request->registration_fee,
            'payment_method' => $request->payment_method,
            'medical_history' => $request->medical_history,
            'mrn_number' => $mrnNumber,
            'receptionist_id' => auth()->id(),
        ]);
              $patient_id =  $patient->id;
               
           // Create a notification for all doctors
            $doctors = User::where('type', 'doctor')->get();
            foreach ($doctors as $doctor) {
                Notification::create([
                    'user_id' => $doctor->id,
                    'patient_id' => $patient_id,
                    'type' => 'New Patient Registration',
                    'message' => 'A new patient, ' . $patient->first_name . ' ' . $patient->last_name . ', has been registered.',
                    'read' => false,
                ]);
            }
    
        // Prepare email data
        $hospitalName = config('services.mail.from_name');
        $emailData = [
            'patient' => $patient,
            'hospitalName' => $hospitalName,
            'companyLocation' => '123 Majichunvi Street, Dar es salaam, Tanzania',
            'time' => now()->toDateTimeString(),
        ];
    
        // Render email body
        $mailBody = view('email-templates.send-patient-invoice', $emailData)->render();
    
        // Send email
        $mailConfig = [
            'recipient_address' => $patient->email,
            'recipient_name' => $patient->first_name . ' ' . $patient->last_name,
            'subject' => 'Registration Confirmation - ' . $hospitalName,
            'body' => $mailBody,
        ];
    
        $emailSent = CMail::send($mailConfig);
    
        // Flash message for the user
        if ($emailSent) {
            return redirect()->route('admin.create-patient')
                ->with('success', 'Patient registered successfully with MRN: ' . $mrnNumber . ' and email sent.');
        } else {
            return redirect()->route('admin.create-patient')
                ->with('success', 'Patient registered successfully with MRN: ' . $mrnNumber . ', but email could not be sent due to an internet issue.');
        }
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::findOrFail($id);
       
        $data = [
            'pageTitle' => 'Edit Patients',
            'patient' => $patient
        ];
        return view('back.pages.patients.edit-patient',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
            // Validate the input data
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:patients,email,' . $id,
                'phone_number' => 'required|numeric|digits_between:10,15',
                'age' => 'required|numeric|min:0|max:150',
                'address' => 'required|string|max:255',
                'gender' => 'required|in:male,female',
                'medical_history' => 'nullable|string|max:2000',
            ]);
        
            // Find the patient by ID
            $patient = Patient::findOrFail($id);
        
            // Update the patient record with validated data
            $patient->update([
                'first_name' => $validatedData['first_name'],
                'middle_name' => $validatedData['middle_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'age' => $validatedData['age'],
                'address' => $validatedData['address'],
                'gender' => $validatedData['gender'],
                'medical_history' => $validatedData['medical_history'],
            ]);
        
            // Redirect with a success message
            return redirect()->route('admin.list-patients')
                ->with('success', 'Patient information updated successfully!');
    
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
