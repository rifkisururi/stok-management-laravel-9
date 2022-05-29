<?php 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomAuthController extends Controller{

    public function index(){
        return view('auth.login');
    }

    public function customLogin(Request $request){
        session_start();
        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $_SESSION["userLogin"] = $user;
            return redirect()->intended('dashboard')->withSuccess('Masuk');
        }else{
            return view('auth.login');
        }
        
    }

    public function registration(){
        return view('auth.registration');
    }

    public function customRegistration(Request $request){
        $data = $request->all();
        $this->create($data);
        return redirect('login');
    }
    
    public function create(array $data){
        return User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'role' => $data['role'],
             'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard(){
        if(Auth::check()){
            return redirect('barang');
        }

        return redirect('login')->withSuccess('Anda belum punya akses');
    }

    public function logOut(){
        
        session_start();
        //Session::flush();
        Auth::logout();
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        return redirect('login');
    }

}

?>