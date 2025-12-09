<?php
namespace App\Livewire\Admin;

use App\Helpers\CMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
class Profile extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab' => ['keep' => true]];

    public $name,$email,$username;
    public $current_password, $new_password,$new_password_confirmation;
    protected $listeners = [
        'updateProfile' => '$refresh', 
    ];

    public function selectTab($tab){
        $this->tab = $tab;

    }

    public function mount(){
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;
        //populate
        $user = User::findOrFail(auth()->id());
       
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
    
    }
   
    public function updatePersonalDetails() {
        $user = User::findOrFail(auth()->id());
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
        ]);
    
        // Update user info
        $user->name = $this->name;
        $user->username = $this->username;
        $updated = $user->save();
    
        sleep(0.5);
        if ($updated) {
            $this->dispatch('showToastr', ['type' => 'success', 'message' => 'Your personal details have been updated successfully.']);
            $this->dispatch('updateTopUserInfo')->to(TopUserInfo::class);
        } else {
            $this->dispatch('showToastr', ['type' => 'error', 'message' => 'Something went wrong.']);
        }
        
    }

    public function updatePassword(){
        $user = User::findOrFail(auth()->id());

        //validate form
        $this->validate([
            'current_password'=>[
                'required',
                'min:5',
                function($attribute, $value, $fail) use ($user){
                    if(!Hash::check($value,$user->password)){
                        return $fail(__('Your current passsword does not match our records'));
                    }
                }
            ],
            'new_password'=>'required|min:5|confirmed'
        ]);

        //update the users password
        $updated = $user->update([
            'password' =>Hash::make($this->new_password)
        ]);
        if($updated){
            //send email notification to this user
            $data = array(
                'user' => $user,
                'new_password'=>$this->new_password
            );
            $mail_body = view('email-templates.password-changes-template',$data)->render();
            $mail_config = array(
                'recipient_address'=>$user->email,
                'recipient_name' => $user->name,
                'subject' => 'Password changed',
                'body' => $mail_body
            );
            
            CMail::send($mail_config);
            //logout and Redirect user to login page 
            auth()->logout();
           
            Session::flash('info' , 'Your password has been successfully changed. 
            please login with your new passowrd.');
            $this->redirectRoute('admin.login');
        }else{
            $this->dispatch('showToastr',['type'=>'error','message'=>'Something went wrong.']);
        }
    }



    public function render()
    {
        return view('livewire.admin.profile',[
            'user' => User::findOrFail(auth()->id())
        ]);
    }
}
