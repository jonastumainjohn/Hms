<?php
namespace App\Http\Controllers;
use App\Helpers\CMail;
use App\Models\Diagnosis;
use App\Models\Doctor;
use App\Models\Medical;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\prescription_item;
use App\Models\prescriptionProductItem;
use App\Models\Product;
use App\Models\Receptionist;
use App\Models\RegistrationFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorsController extends Controller
{

    //Doctors Function
    public function index(){
        $doctors = Doctor::with('user')->get();
        $data = [
            'pageTitle' => 'Doctors List'

        ];
        return view('back.pages.list-doctors',$data,compact('doctors'));
    }
    public function create()
    {
        $doctors = User::where('type' , 'doctor')->get();
        

        $data = [
            'pageTitle' => 'Doctor Registration'
        ];
       return view('back.pages.register-doctor',$data ,compact('doctors'));
    }

    public function store(Request $request)
    {
    // Validate the form input
    $request->validate([
        'user_id' => [
            'required',
            'exists:users,id',
            function ($attribute, $value, $fail) {
                if (\App\Models\Doctor::where('user_id', $value)->exists()) {
                    $fail('This doctor is already registered.');
                }
            },
        ],
        'specialization' => 'required|string|max:255',
        'availability' => 'required|string|max:255',
    ]);
    
    Doctor::create([
        'user_id' => $request->user_id,
        'specialization' => $request->specialization,
        'availability' => $request->availability,
    ]);

    return redirect()->route('admin.list-doctors')->with('success', 'Doctor information added successfully.');

    }

    public function edit($id)
    {
       $doctors = Doctor::with('user')->findOrFail($id);  
       $users = User::where('type' , 'doctor')->get();
      
       if (!$doctors || !$doctors->user) {
        return redirect()->route('admin.list-doctors')->with('error', 'Doctor or associated user not found.');
    }
       $data = [
        'pageTitle' => 'Edit Doctor',
        
       ];
        return view('back.pages.edit_doctor',$data,compact('doctors','users'));
    }

    public function update(Request $request, $id)
        {
            $request->validate([
                'specialization' => 'required|string|max:255',
                'availability' => 'required|string',
            ]);

            // Find doctor
            $doctor = Doctor::find($id);
            if (!$doctor) {
                return redirect()->route('admin.list-doctors')->with('error', 'Doctor not found.');
            }

            $doctor->specialization = $request->specialization;
            $doctor->availability = $request->availability;
            $doctor->save();

            return redirect()->route('admin.list-doctors')->with('success', 'Doctor updated successfully.');
        }

    public function destroy( $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()
            ->route('admin.list-doctors')
            ->with('success', 'Doctor deleted successfully.');
    }

    //Receptionist Functions
    public function createRecept(){
        $receptionists = User::where('type' , 'receptionist')->get();
        
        $data = [
            'pageTitle' => 'Receptionist Registration',
        ];
        return view('back.pages.getReceptRegistration',$data,compact('receptionists'));
    }

    public function storeRecept(Request $request){
        $validator = Validator::make($request->all(),[
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    if (\App\Models\Receptionist::where('user_id', $value)->exists()) {
                        $fail('This Receptionist is already registered.');
                    }
                },
            ],
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(16)->format('Y-m-d'),
            ],
            'shift' => 'required|in:day,night,full time'

        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $receptionist = Receptionist::create([
            'user_id' => $request->user_id,
            'date_of_birth' => $request->date_of_birth,
            'shift' => $request->shift
        ]);

        if($receptionist){
            return redirect()->route('admin.list-receptionist')->with('success', 'Receptionist information added successffully');

        }else{
            return redirect()->back()->with('error','Something went wrong Try again later.');
        }



    }

    public function listRecept(){
        $receptionists = Receptionist::with('user')->get();
        $data = [
            'pageTitle' => 'Receptionist List'
        ];
        return view('back.pages.getReceptList',$data,compact('receptionists'));
        
    }
    public function editRecept($id)
        {
            $receptionist = Receptionist::with('user')->findOrFail($id);
            $users = User::where('type', 'receptionist')->get();

            $data = [
                'pageTitle' => 'Edit Receptionist',
                'receptionist' => $receptionist, 
                'users' => $users, 
            ];
            return view('back.pages.edit-receptionist', $data);
        }

        public function updateReceptionist(Request $request, $id){
            $request->validate([
                'date_of_birth' => [
                    'required',
                    'date',
                    'before_or_equal:' . now()->subYears(16)->format('Y-m-d'),
                ],
                'shift' => 'required',
            ]);

            // Find receptionist
            $receptionist = Receptionist::find($id);
            if (!$receptionist) {
                return redirect()->route('admin.list-receptionist')->with('error', 'Receptionist not found.');
            }

            $receptionist->date_of_birth = $request->date_of_birth;
            $receptionist->shift = $request->shift;
            $receptionist->save();

            return redirect()->route('admin.list-receptionist')->with('success', 'Receptionist updated successfully.');

        }



    public function deleteRecept($id){
        $receptionist = Receptionist::findOrFail($id);
        if($receptionist->delete()){
            return redirect()->back()->with('success','Receptionist deleted successffully');
        }else{
            return redirect()->back()->with('error','Something went wrong try again later');
        }
    }

      //FEE REGISTRATION
      public function registrationFees()
      {
          $fee = RegistrationFee::first(); // Fetch the first record if exists
          $data = [
              'pageTitle' => 'Registration Fee',
              'fee' => $fee // Pass the record to the view
          ];
          return view('back.pages.patients.registration-fee', $data);
      }
      
      public function storeRegiFee(Request $request)
      {
          $validatedData = $request->validate([
              'fee_amount' => 'required|numeric',
              'currency' => 'required|string',
              'valid_from' => 'required|date',
              'valid_until' => 'required|date|after_or_equal:valid_from',
              'description' => 'nullable|string',
          ]);
      
          // Check if a record already exists
          $fee = RegistrationFee::first();
      
          if ($fee) {
              // Update existing record
              $fee->update($validatedData);
              $message = 'Registration Fee updated successfully!';
          } else {
              // Create new record
              RegistrationFee::create($validatedData);
              $message = 'Registration Fee added successfully!';
          }
      
          return redirect()->route('admin.registration-fee')->with('success', $message);
      }
      


    //Store Medical and price 
    public function createMedicals(){
        
        $medicals = Medical::all();
        $data = [
             'pageTitle' => 'Manage Medical',
             'medicals' => $medicals
        ];
        return view('back.pages.create-medicals',$data);
    }

    public function editMedicals($id){
        
        $medical = Medical::findOrFail($id);;
        $data = [
            'pageTitle' => 'Manage Medical',
            'medical' => $medical
        ];
        return view('back.pages.edit-medicals',$data);
    }

    public function updateMedicals(Request $request,$id){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
    
        $medical = Medical::findOrFail($id);
        $medical->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
    
        return redirect()->route('admin.create-medicals')->with('success', 'Medicine updated successfully.');
    }

    public function deleteMedicals($id){
        $medical = Medical::findOrFail($id);
        $medical->delete();

        return redirect()->route('admin.create-medicals')
            ->with('success', 'Medicine deleted successfully.');
    }

    public function storeMedicals(Request $request ){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Medical::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.create-medicals')
            ->with('success', 'Medicine registered successfully.');
   
    }


    //Prescription Functions 
    public function listPrescriptions()
    {
        $prescriptions = Prescription::with(['patient', 'prescriptionItems.medical'])->orderBy('id','desc')->get();
        $data = [
            'pageTitle' => 'Prescription List',
            'prescriptions' => $prescriptions
        ];
        return view('back.pages.list-prescription', $data);
    }
    
    public function showPrescription($id){
        $prescription = Prescription::with(['patient', 'prescriptionItems.medical'])->findOrFail($id);
        return view('back.pages.view-prescription', [
            'pageTitle' => 'View Prescription',
            'prescription' => $prescription
        ]);
    }

    

    public function createPrescription(Request $request)
        {
            // Get the list of patients and medicals
            $patients = Patient::orderBy('id', 'desc')->get();
            $medicals = Medical::all();
            $products = Product::where('status','active')->get();
            $data = [
                'pageTitle' => 'Prescription',
                'medicals' => $medicals,
                'patients' => $patients,
                'products' => $products,
            
            ];

            return view('back.pages.create-prescription', $data);
        }


    public function editPrescription(){
        $data = [
            'pageTitle' => 'Prescription'
        ];
        return view('back.pages.edit-prescription',$data);
    }

    public function storePrescription(Request $request)
{
    // Validate input data
    $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'medical_items' => 'required|array',
        'medical_items.*.id' => 'exists:medicals,id',
        'medical_items.*.quantity' => 'required|integer|min:1',
        'product_items' => 'nullable|array',
        'product_items.*.id' => 'exists:products,id',
        'product_items.*.quantity' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'appointment_date' => 'nullable|date',
    ]);

    // Check stock availability before creating the prescription
    $insufficientStock = [];
    foreach ($request->product_items as $item) {
        $product = Product::find($item['id']);
        $quantity_requested = $item['quantity'];

        // Check if the product has enough stock
        if ($product->quantity < $quantity_requested) {
            // Append the product name and available quantity to the insufficient stock array
            $insufficientStock[] = $product->name . ' (Available: ' . $product->quantity . ')';
        }

        // If there is insufficient stock, return back with error message
        if (!empty($insufficientStock)) {
            return back()->withErrors([
                'product_items' => 'Not enough stock for products: ' . implode(', ', $insufficientStock)
            ]);
        }


    // Proceed with transaction and prescription creation if stock is sufficient
    \DB::transaction(function () use ($request) {
        // Calculate total price for medical items
        $total_price = 0;
        foreach ($request->medical_items as $item) {
            $medical = Medical::find($item['id']);
            $total_price += $medical->price * $item['quantity'];
        }

        // Calculate total price for product items
        foreach ($request->product_items as $item) {
            $product = Product::find($item['id']);
            $total_price += $product->price * $item['quantity'];
        }

        // Create the prescription
        $prescription = Prescription::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => auth()->id(),
            'description' => $request->description,
            'total_price' => $total_price,
            'appointment_date' => $request->appointment_date,
            'status' => $request->appointment_date ? 'Pending' : null,
        ]);

        // Mark notifications for the patient as read
        if ($prescription) {
            $patient_id = $request->patient_id;
            $doctor_id = auth()->id();
            Notification::where('patient_id', $patient_id)
                ->where('user_id', $doctor_id)
                ->where('read', false)
                ->update(['read' => true]);
        }

        // Add medical items to the prescription
        foreach ($request->medical_items as $item) {
            $medical = Medical::find($item['id']);
            prescription_item::create([
                'prescription_id' => $prescription->id,
                'medical_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $medical->price * $item['quantity'],
            ]);
        }

        // Add product items to the prescription and update stock
        foreach ($request->product_items as $item) {
            $product = Product::find($item['id']);
            $quantity_requested = $item['quantity'];

            // Create the prescription product item
            prescriptionProductItem::create([
                'prescription_id' => $prescription->id,
                'product_id' => $item['id'],
                'quantity' => $quantity_requested,
                'price' => $product->price * $quantity_requested,
            ]);

            // Deduct the quantity from the Product table
            $product->quantity -= $quantity_requested;
            $product->save(); 
        }
    });

    // Redirect with success message
    return redirect()->route('admin.list-prescriptions')->with('success', 'Prescription created successfully.');
}
}

    public function sendPrescriptionMail($id)
{
    // Fetch patient and prescription details
    $patient = Patient::findOrFail($id);

    // Fetch the latest prescription for the patient
    $prescription = Prescription::where('patient_id', $id)->latest()->first();

    if (!$prescription) {
        return redirect()->back()->with('fail', 'No prescription found for this patient.');
    }

    
     // Fetch associated prescription items with the medicine relationship
     $prescriptionItems = prescription_item::with('medicine') 
     ->where('prescription_id', $prescription->id)
     ->get();

     
    if ($prescriptionItems->isEmpty()) {
        return redirect()->back()->with('fail', 'No prescription items found for this patient.');
    }

    // Email details
    $hospitalName = config('services.mail.from_name');
    $emailData = [
        'patient' => $patient,
        'hospitalName' => $hospitalName,
        'prescription' => $prescription,
        'prescriptionItems' => $prescriptionItems,
        'companyLocation' => '123 Maji chunvi Street, Dar es Salaam, Tanzania',
        'time' => now()->toDateTimeString(),
    ];

    // Render email body from Blade template
    $mailBody = view('email-templates.send-final-invoice', $emailData)->render();

    // Send email
    $mailConfig = [
        'recipient_address' => $patient->email,
        'recipient_name' => $patient->first_name . ' ' . $patient->last_name,
        'subject' => 'Your Prescription and Invoice Details - ' . $hospitalName,
        'body' => $mailBody,
    ];

    $emailSent = CMail::send($mailConfig);

    // Provide feedback
    if ($emailSent) {
        return redirect()->back()->with('success', 'Prescription and invoice details sent successfully to ' . $patient->email);
    } else {
        return redirect()->back()->with('fail', 'Failed to send email. Check internet connection.');
    }
}

    
  

  //payment list
  public function paymentList()
  {
      $payment = Prescription::with([
          'patient.receptionist', // Assume 'receptionist' relationship is defined in the Patient model
          'prescriptionItems.medical',
          'doctor'
      ])->get();
  
      $registrationFee = \DB::table('registration_fees')->value('fee_amount'); // Fetch registration fee
  
      $data = [
          'pageTitle' => 'Payments Records',
          'payment' => $payment,
          'registrationFee' => $registrationFee,
      ];
  
      return view('back.pages.payment-records', $data);
  }
  

   //Diagonesis Function
   public function addDiagnosis($id){
    $patient = Patient::findOrFail($id);

    $data = [ 
        'pageTitle' => 'Diagnoses',
        'patient' => $patient
    ];

    return view('back.pages.create-diagnoses',$data);

   }

   public function storeDiagnosis(Request $request,Patient $patient)
        {
            $validated = $request->validate([
                'symptoms' => 'required|string|max:255',
                'diagnosis' => 'required|string|max:255',
                'medical_history' => 'nullable|string',
            ]);

            if(!$validated){
                return redirect()->back()->withErrors($validated)->withInput();
            }

            Diagnosis::create([
                'patient_id' => $patient->id,
                'symptoms' => $validated['symptoms'],
                'diagnosis' => $validated['diagnosis'],
                'medical_history' => $validated['medical_history'],
            ]);

            return redirect()->route('admin.list-diagnosis', $patient)
                            ->with('success', 'Diagnosis added successfully.');
        }

        public function listDiagnosis(){
            $diagnoses = Diagnosis::with('patient') 
                      ->orderBy('id', 'desc')
                      ->get();

            $data = [
                'pageTitle' => 'Diagnosis List',
                'diagnoses' => $diagnoses
            ];
            return view('back.pages.list-diagnosis',$data);
        }

        public function viewDiagnosis($id){
            $diagnosis = Diagnosis::with('patient')->findOrFail($id);
            $data = [
                'pageTitle' => 'View Diagnosis',
                'diagnosis' => $diagnosis
            ];
            return view('back.pages.view-diagnosis_data',$data);
        }


        public function markAsRead(Notification $notification)
        {
            // Mark the notification as read
            $notification->update(['read' => true]);
        
            // Redirect to patient list
            return response()->json([
                'success' => true,
                'redirect_url' => route('admin.list-patients'),
            ]);
        }
        
        

        public function fetchNotifications()
        {
            $notifications = Notification::where('user_id', auth()->id())
                ->where('read', false) 
                ->orderBy('created_at', 'desc')
                ->get();
        
            // Debug the data
            logger()->info('Fetched Notifications:', $notifications->toArray());
        
            return response()->json($notifications);
        }
        
        
            //LIST APPOINTMENT FUNCTION
            public function listAppointment()
            {
                $prescriptions = Prescription::with('patient')
                    ->whereNotNull('appointment_date') 
                    ->orderBy('appointment_date', 'asc') 
                    ->get();
            
                $data = [
                    'pageTitle' => 'Appointment List',
                    'prescriptions' => $prescriptions,
                ];
            
                return view('back.pages.list_appointment', $data);
            }

            public function updateStatus(Request $request, $id)
            {
                $request->validate([
                    'status' => 'required|in:Pending,Performed',
                ]);

                $appointment = Prescription::findOrFail($id);
                $appointment->status = $request->status;
                $appointment->save();
                return redirect()->back()->with('success', 'Appointment status updated successfully.');
            }
 
}
