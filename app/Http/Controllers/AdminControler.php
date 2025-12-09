<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\GeneralSetting;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Receptionist;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SawaStacks\Utils\Library\Kropify;

class AdminControler extends Controller
{
    public function adminDashboard(Request $request){
        $receptionistId = auth()->user()->id;
        $totalPatients = Patient::where('receptionist_id', $receptionistId)->count();
        $totalRFemalepatient = Patient::where('receptionist_id', $receptionistId)
            ->where('gender', 'female')
            ->count();
        $totalRMalepatient = Patient::where('receptionist_id', $receptionistId)
            ->where('gender', 'male')
            ->count();

        $totalTpatient = Prescription::where('doctor_id',auth()->id())->count();
        $totalFemalePatients = Prescription::where('doctor_id', auth()->id())
        ->whereHas('patient', function ($query) {
            $query->where('gender', 'female'); 
        })
        ->distinct('patient_id') // Ensure unique patients are counted
        ->count('patient_id');

        $totalMalepatient = Prescription::where('doctor_id', auth()->id())
        ->whereHas('patient', function ($query) {
            $query->where('gender', 'male'); 
        })
        ->distinct('patient_id') // Ensure unique patients are counted
        ->count('patient_id');


        
        $totalUsers = User::where('status', 'active')->count();
        $totalReceptionist = Receptionist::all()->count();
        $totalSuperAdmin = User::where('type', 'superAdmin')->count();

         // Fetch count of appointments with pending status for the logged-in doctor
        $pendingAppointmentsCount = Prescription::where('status', 'pending')
        ->whereNotNull('appointment_date')
        ->where('doctor_id', Auth::id()) 
        ->count();

        
        // Current week (from the start of the week to now)
        $startOfWeek = Carbon::now()->startOfWeek();  // Start of this week
        $endOfWeek = Carbon::now()->endOfWeek();      // End of this week
        // Current month (from the start of the month to now)
        $startOfMonth = Carbon::now()->startOfMonth(); // Start of this month
        $endOfMonth = Carbon::now()->endOfMonth();     // End of this month
        // Total for the current week
        $totalPrescriptionWeekly = Prescription::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_price');
        $registraFeeWeekly = Patient::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('registration_fee');
        $totalSalesWeekly = $totalPrescriptionWeekly + $registraFeeWeekly;
        // Weekly data for the past 6 weeks 
        $weeks = collect();
        $salesData = collect();

        // Generate sales data for each of the past 6 weeks
        for ($i = 8; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->startOfWeek()->subWeeks($i);  // Start of each week
            $endOfWeek = Carbon::now()->endOfWeek()->subWeeks($i);      // End of each week
            // Get the total sales for the week
            $totalPrescription = Prescription::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total_price');
            $registraFee = Patient::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('registration_fee');
            $totalSales = $totalPrescription + $registraFee;
            // Add to our collection
            $salesData->push($totalSales);
            $weeks->push($startOfWeek->format('M d') . ' - ' . $endOfWeek->format('M d'));

        }

        // Total for the current month
        $totalPrescriptionMonthly = Prescription::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_price');
        $registraFeeMonthly = Patient::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('registration_fee');
        $totalSalesMonthly = $totalPrescriptionMonthly + $registraFeeMonthly;
        $totalPrescription = Prescription::sum('total_price');
        $registraFee = Patient::sum('registration_fee');
        $totalSales = $totalPrescription + $registraFee;
        $totalPatient = Patient::all()->count();
        $totalDoctors = Doctor::all()->count();
        $data = [
            'pageTitle' => 'Dashboard',
            'totalPatient' => $totalPatient,
            'totalDoctors' => $totalDoctors,
            'totalUsers' => $totalUsers,
            'totalReceptionist' => $totalReceptionist,
            'totalSuperAdmin' => $totalSuperAdmin,
            'totalSales' => $totalSales,
            'totalSalesWeekly' => $totalSalesWeekly,
            'totalSalesMonthly' => $totalSalesMonthly,
            'salesData' => $salesData,
            'weeks' => $weeks,
            'pendingAppointmentsCount' => $pendingAppointmentsCount,
            'totalTpatient' => $totalTpatient,
            'totalMalepatient' => $totalMalepatient,
            'totalFemalePatients' => $totalFemalePatients,
            'totalMalepatient' => $totalMalepatient,
            'totalRFemalepatient'  => $totalRFemalepatient,
            'totalRMalepatient' => $totalRMalepatient,
            'totalPatients' => $totalPatients
        ];

        return view('back.pages.dashboard',$data);
    }

    //REGISTER NEW USER
    public function registerUsers(Request $request){
        $users = User::where('type', 'doctor')
             ->orWhere('type', 'receptionist')
             ->get();
      $data = [
        'pageTitle' => 'Register User'

      ];

      return view('back.pages.getRegisterUserForm',$data,compact('users'));

    }

    public function createUser(Request $request){
         // Validation
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
            'type' => 'required|in:superAdmin,doctor,receptionist',
            'status' => 'required|in:active,pending,rejected',
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create the user in the database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'status' => $request->status,
            
        ]);
        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function EditUser($userId) {
        $data = [
            'pageTitle' => 'Edit User'
        ];
        $user = User::findOrFail($userId);
        return view('back.pages.edit-user',$data,compact('user'));
    }

    public function DeleteUser(User $user){
        if($user->delete()){
            return back()->with('success','User deleted successfully');
        }
    }

    public function updateUser(Request $request, $userId){
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $userId,
        'email' => 'required|email|max:255|unique:users,email,' . $userId,
        'password' => 'nullable|string|min:5', 
        'type' => 'required|in:superAdmin,doctor,receptionist',
        'status' => 'required|in:active,pending,rejected',
    ]);

    // If validation fails, return back with errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $user = User::findOrFail($userId);
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->type = $request->type;
    $user->status = $request->status;

    if ($request->has('password') && !empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    $user->save();
    return redirect()->route('admin.register-users')->with('success', 'User updated successfully!');

    }

    


    public function logoutHandler(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('fail','You are now logged out!.');
  
    }

    public function profileView(Request $request) {
        $data = [
            'pageTitle' => 'Profile',

        ];
        return view('back.pages.profile',$data);
     }

     public function updateProfilePicture(Request $request)
     {
         // Validate the uploaded file
         $request->validate([
             'profilePictureFile' => 'required|file|mimes:jpeg,png,jpg|max:2048',
         ]);
     
         $user = User::findOrFail(auth()->id());
         $path = 'images/users/';
         $file = $request->file('profilePictureFile');
     
         // Check if the file is valid
         if (!$file || !$file->isValid()) {
             return response()->json([
                 'status' => 0,
                 'message' => 'Invalid file uploaded. Error: ' . ($file ? $file->getError() : 'No file provided.'),
             ]);
         }
     
         // Extract the filename from the user's current picture
         $old_picture = $user->getOriginal('picture'); 
         $filename = 'IMG_' . uniqid() . '.png';
     
         try {
             // Upload the new picture
             $upload = Kropify::getFile($file, $filename)->maxWOH(255)->save($path);
         } catch (Exception $e) {
             return response()->json([
                 'status' => 0,
                 'message' => 'Error: ' . $e->getMessage(),
             ]);
         }
     
         if ($upload) {
             // Delete old profile picture if it exists
             if ($old_picture) {
                $old_picture_path = public_path($path . $old_picture);
                if (File::exists($old_picture_path)) {
                    File::delete($old_picture_path);
                    \Log::info("Deleted old picture: " . $old_picture_path);
                } else {
                    \Log::warning("Old picture not found: " . $old_picture_path);
                }
            }
            
     
             // Update the user's profile picture
             $user->update(['picture' => $filename]);
     
             return response()->json([
                 'status' => 1,
                 'message' => 'Your profile picture has been updated successfully.',
                 'newPictureUrl' => asset($path . $filename), 
                 'userData' => $user, 
             ]);
         } else {
             return response()->json([
                 'status' => 0,
                 'message' => 'Something went wrong.',
             ]);
         }
     }
     
    public function generalSettings(){
        $data = [
            'pageTitle' => 'General settings'
        ];
        return view('back.pages.general_settings',$data);
    }

    public function updateLogo(Request $request) {
        $settings = GeneralSetting::take(1)->first();
    
        if (!is_null($settings)) {
            $path = 'images/site';
            $old_logo = $settings->site_logo;
    
            if ($request->hasFile('site_logo')) {
                $file = $request->file('site_logo');
                $filename = 'logo_' . uniqid() . '.png';
                $upload = $file->move(public_path($path), $filename);
    
                if ($upload) {
                    // Check if the old logo exists and delete it
                    if ($old_logo != null && File::exists(public_path($path . '/' . $old_logo))) {
                        File::delete(public_path($path . '/' . $old_logo));
                    }
    
                    // Update the settings with the new logo
                    $settings->update(['site_logo' => $filename]);
    
                    return response()->json([
                        'status' => 1,
                        'image_path' => $path . '/' . $filename,
                        'message' => 'Site logo has been updated successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Something went wrong in uploading the new logo.'
                    ]);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'No file was uploaded.']);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Make sure you update the general settings form first.']);
        }
    }
    

    public function updateFavicon(Request $request) {
        $settings = GeneralSetting::take(1)->first();
    
        if (!is_null($settings)) {
            $path = 'images/site';
            $old_favicon = $settings->site_favicon;
            $file = $request->file('site_favicon');
            $filename = 'favicon_' . uniqid() . '.png';
    
            if ($request->hasFile('site_favicon')) {
                // Move the uploaded favicon to the specified path
                $upload = $file->move(public_path($path), $filename);
    
                if ($upload) {
                    // Delete the old favicon if it exists
                    if ($old_favicon != null && File::exists(public_path($path . '/' . $old_favicon))) {
                        File::delete(public_path($path . '/' . $old_favicon));
                    }
    
                    // Update the settings with the new favicon
                    $settings->update(['site_favicon' => $filename]);
    
                    return response()->json([
                        'status' => 1,
                        'image_path' => $path . '/' . $filename,
                        'message' => 'Favicon has been updated successfully'
                    ]);
    
                } else {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Something went wrong in uploading the new favicon.'
                    ]);
                }
            }
    
        } else {
            return response()->json(['status' => 0, 'message' => 'Make sure you update general settings form first.']);
        }
    }


   
    

}
