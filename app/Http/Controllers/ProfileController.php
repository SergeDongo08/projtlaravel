<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function profile() {

        return view('pages.profile');

    }

    //update
    public function profileUpdate(Request $request){
        //validation rules
        $user =Auth::user();

        $updateImageName = time().'-'.'2'. '.'.$request->image->extension();

        $request->image->move(public_path('/storage/pict/'), $updateImageName);

        $user->name = $request['name'];
        $user->secondName = $request['secondName'];
        $user->email = $request['email'];
        $user->gender = $request['gender'];
        $user->fonction = $request['fonction'];
        $user->number = $request['number'];
        $user->image=$updateImageName;


        $user->save();
        return back()->with('newMessage','Profile Updated');
    }

}
