<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Hash;
use App\User;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
  }

    public function showForm()
    {
        if (Auth::check() == true) {
            return redirect(url('/'));
        }
        return view('auth.login');
    }

     // Function login check if is admin or normal user
    public function login(Request $r)
    {
        
        $validator = Validator::make($r->all(), [
            'email' => 'required',
            'password' => 'required|min:2',
        ]);

//dd(Hash::make('biadmin'));
        if (Auth::attempt([
            'email' => $r->email,
            'password' => $r->password

        ])){
            $user = User::where('email',$r->email)->first();

            if ($user->is_admin()) {
                return redirect()->route('generatehtml.index');
            }
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors($validator)->withInput();

    }
}