<?php

namespace App\Http\Controllers;
use App\Models\subvention;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class SubventionController extends Controller
{
    //
    public function subvention() {
        $search = request()->query('search');
        if($search){
            $subventions = Subvention::where('name_subvention', 'LIKE', "%{$search}%")->paginate(3);
        }
        else{
            $subventions = Subvention::paginate(3);
        }
        return view('pages.subvention', compact('subventions'));
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
           'name_subvention' => ['required', 'string', 'max:30'],
           'montant' => ['required', 'string', 'max:200'],

       ]);
   }

   public function ajout_subvention(Request $request){

     $subvention = new subvention();


    $subvention->name_subvention=$request->name_subvention;
    $subvention->montant=$request->montant;



    $subvention->save();

    return redirect()->back()->with('message', 'Recording completed.');


    }

     //fonction de mise à jour ou update
     public function subventionUpdate($id){
        $data = subvention::find($id);

        return view('update.subventionUpdate', compact('data'));
    }
    //edit
    public function editsubvention(Request $request, $id){

        $subvention = subvention::find($id);

        $subvention->name_subvention=$request->name_subvention;
        $subvention->montant=$request->montant;


        $subvention->save();
        return redirect()->back()->with('message', 'update done.');
    }
    //delete subvention
    public function deletesubvention($id){
        $data = subvention::find($id);
        $data->delete();

        return redirect('/subvention')->with('status', 'Grant successfully deleted.');
    }


}
