<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\create_class;
use App\Models\studentclass;


class users extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function regsubmit(Request $req)
    {


        if (!session()->has('email')) {
            //     $this->validate($req, [
            //     'email' => 'unique:users|required|regex:/(.+)@(.+)\.(.+)/i',
            //     'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            //   ]);


            $name = $req->name;
            $email = $req->email;
            $roll = $req->roll;
            $ph_num = $req->phone_number;
            $password =$req->password;

            $user = DB::table('registers')->insert(array('name' => $name, 'email' => $email, 'role' => $roll, 'ph_number' => $ph_num, 'password' => $password));
            if ($user) {
                return redirect('/');
            } else {
                return redirect('register');
            }
        } else {
            return redirect('dashboard');
        }
    }

    public function logincheck(Request $req)
    {
        if (session()->has('email')) {
            return redirect('/dashboard');
        } else {
           
            $email = $req->email;
            $password = $req->password;
            
            $user = DB::table('registers')->where('email', $email)->first();
            $userPass = $user->password;
       
            if ($password==$userPass) {
                $session = session()->put('email', $email);
                
                return redirect('dashboard');
            } 
            
            else {
                return redirect('/');
            }
        }
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function managestudent(){
    return view('managstudent');
    }
    public function createclass(Request $req){
        $data =new create_class;
        $data->class_name=$req->class;
        $data->topic=$req->topic;
        $data->email=session()->get('email');
        $data->save();
        if($data){
            return redirect('dashboard');
        }

    }


    public function deatils($id){
        $data=create_class::find($id);
        return view('deatils',compact('data','id'));


    }
    public function addclass(Request $request){
        $idd=$request->id;
        $mydata=new studentclass;
        $data=DB::table('registers')->where('id', $idd)->get();
      
        // $class_name_data=DB::table('create_classes')->where('email', session('email'))->get();
dd($data->name);
        // $mydata->name=$data->name;
        // $mydata->email=$data->email;
        // $mydataa=  $mydata->save();
        // if ($mydataa) {
        //     return redirect()->back();
        // }
    }
    
    public function addfile(Request $req){
        dd('file');
    }
    } 

