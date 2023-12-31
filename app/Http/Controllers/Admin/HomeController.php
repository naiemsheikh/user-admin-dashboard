<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = array(
            'title' => 'Admin',
            'menuActive' => 'home'
        );

        return view('admin.home.dashboard', $data);
    }
    public function create(){
        
    }
    public function changePassword(Request $request)
    {

        $user = new User();

        $userId = $request->input('user_id');
        $newPassword = bcrypt($request->input('new_password'));

        $userData = $user->find($userId);
        $userData->password = $newPassword;
        $userData->save();

        $request->session()->flash('message', 'Password has been updated successfully');
        $request->session()->flash('message_type', 'success');
        return redirect('admin/home');
    }

}
