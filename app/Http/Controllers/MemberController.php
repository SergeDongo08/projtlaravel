<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Member;

class MemberController extends Controller
{
    //
    public function member() {
        //Demander à laravel de récupérer tous les objets de la table members
        // $members = Member::paginate(3);
        $search = request()->query('search');
        if($search){
            $members = Member::where('name', 'LIKE', "%{$search}%")->paginate(3);
        }
        else{
            $members = Member::paginate(3);
        }
        //Retourne notre vue avec les members intégrés
        return view('pages.member', compact('members'));

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
           'matricule' => ['required', 'string', 'max:10'],
           'name' => ['required', 'string', 'max:255'],
           'secondName' => ['required', 'string', 'max:255'],
           'gender' => ['required'],
           'email' => ['required', 'string', 'email', 'max:255'],
           'fonction' => ['required', 'string', 'max:255'],
           'image' => 'required|mimes:jpg,png,jpeg|max:5048',
           'tel' => ['required', 'string', 'max:50'],
       ]);
   }

    public function ajout(Request $request){

        $member = new Member();

        $newImageName = time().'-'.$request->name . '.'.$request->image->extension();

        $request->image->move(public_path('pictures'), $newImageName);

        $member->matricule=$request->matricule;
        $member->name=$request->name;
        $member->secondName=$request->secondName;
        $member->genre=$request->genre;
        $member->email=$request->email;
        $member->fonction=$request->fonction;
        $member->image=$newImageName;
        $member->tel=$request->tel;

        $member->save();

        return redirect()->back()->with('message', 'Recording completed.');

     }
     //fonction de mise à jour ou update
     public function memberUpdate($id){
         $data = member::find($id);

         return view('update.memberUpdate', compact('data'));
     }
     //edit
     public function editmember(Request $request, $id){

         $member = member::find($id);

        //update d'image
        $updateImageName = time().'-'.$request->name .'2'. '.'.$request->image->extension();

        $request->image->move(public_path('pictures'), $updateImageName);

         $member->matricule=$request->matricule;
         $member->name=$request->name;
         $member->secondName=$request->secondName;
         $member->genre=$request->genre;
         $member->email=$request->email;
         $member->fonction=$request->fonction;
         $member->image=$updateImageName;
         $member->tel=$request->tel;


         $member->save();
         return redirect()->back()->with('message', 'update done.');
     }
     //delete member
     public function deletemember($id){
         $data = member::find($id);
         $data->delete();

         return redirect('/member')->with('status', 'Member successfully deleted.');
     }

}
