<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\create_class;
use App\Models\studentclass;
use Symfony\Component\HttpFoundation\Response;


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
                if($user->role=='student'){

                    return redirect('sdashboard');

                }

                else
                {

                    return redirect('dashboard');

                }

            } 
            
            else {
                return redirect('/');
            }
        }
    }
    public function dashboard(){
        return view('dashboard');
    }

    public function sdashboard(){
        return view('sdashboard');
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
        $class=create_class::find($id);
        return view('deatils',compact('class','id'));


    }
    public function addclass(Request $request){
        $idd=$request->id;
        $mydata=new studentclass;
        $data=DB::table('registers')->where('id', $idd)->first();
        $email=DB::table('studentclasses')->where('class',$request->class )->where('email',$data->email)->exists();
    if ($email) {

        return redirect()->back();


    }else{
        $mydata->name=$data->name;
        $mydata->class=$request->class;
        $mydata->email=$data->email;
        
        $mydataa=  $mydata->save();
        if ($mydataa) {
            return redirect()->back();
        }
    }
}



    
    public function addfile(Request $req){
      
        $userEmail=session('email');
    //    dd($req);

            $file=$req->file('file');
        
            $extention=$file->getClientOriginalExtension();
        
            $filename=time().'.'.$extention;
            $file->move('education',$filename);
            $date=date('d').' '.date('F').' '.date('Y');
            $class=$req->class;
            $UploadResume=DB::table('education')->insert(array('education_data'=>$filename,'date'=>$date,
            'class'=>$class, 'user_email'=>$userEmail));
            return redirect('/dashboard');
    }



    public function download(Request $req)
    {
        $pdf_name =$req->edudata;
        $file= public_path(). "/education/".$pdf_name;
                                                                                                                                                                                                                                                                                                                                                            
        $headers = array(
                  'Content-Type: application/pdf',
                );
    
        return response()->download($file, $pdf_name, $headers);
    }
    public function downloadv(Request $req)
    {
        $pdf_name =$req->edudata;
        $file= public_path(). "/education_video/".$pdf_name;
                                                                                                                                                                                                                                                                                                                                                            
        $headers = array(
                  'Content-Type: application/video',
                );
    
        return response()->download($file, $pdf_name, $headers);
    }


    public function vupload(Request $req){
          
            $userEmail=session('email');
            $file=$req->file('file');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $date=date('d').' '.date('F').' '.date('Y');
            $class=$req->class;
            $file->move('education_video',$filename);
            
            $UploadResume=DB::table('videodatas')->insert(array('video_data'=>$filename,'date'=>$date,
            'class'=>$class, 'user_email'=>$userEmail));
            return redirect('/dashboard');
           
        
    }
    

    } 

