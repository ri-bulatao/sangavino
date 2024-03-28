<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\Purok;
use App\Models\Resident;
use App\Models\Admin\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $puroks;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

     /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $puroks = Purok::pluck('name', 'id');
        return view('auth.register', compact('puroks'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'numeric'],
            'gender' => ['required', 'string', 'in:male,female'],
            'civil_status' => ['required', 'string', 'in:single,married,divorced,widowed'],
            'citizenship' => ['required', 'string', 'max:255'],
            'is_voter' => ['nullable', 'boolean'],
            'birth_date' => ['required', 'date'],
            'purok_id' => ['required', 'exists:puroks,id'],
        ]);
    }

    protected function create(array $data) 
    {
        
        // Create the resident
        $resident = Resident::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'purok_id' => $data['purok_id'],
            'civil_status' => $data['civil_status'],
            'citizenship' => $data['citizenship'],
            'is_voter' => $data['is_voter'] ?? 0
        ]);

        
        // Create the user
        $user = User::create([
            'id' => 5,
            'resident_id' => $resident->id,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_activated' => false, 
            'role_id' => Role::RESIDENT,
            'created_at' => now()
        ]);

        return $user;
    }

    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        
        return redirect(route('login'))->with('success', 'Registration successful! Please check your email for the verification');
    }
}
