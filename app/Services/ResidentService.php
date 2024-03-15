<?php 

namespace App\Services;

use Illuminate\Support\Str;
use App\Mail\AccountCreated;
use App\Models\Resident;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResidentService {

    public function create_account(Resident $resident, $email)
    {
       $password = Str::random(10); // the random password;

       $user = $resident->user()->create(['email' => $email, 'password' => Hash::make($password), 'role_id' => 2 ]);   // create an account 

       return  Mail::to($user)->send( new AccountCreated($user, $password));        // email the resident for the account creation
    }
}