<?php

namespace App\Http\Controllers;
use App\Models\depense;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class DepenseController extends Controller
{
    //
    public function depense() {
        $search = request()->query('search');
        if($search){
            $depenses = Depense::where('name_depense', 'LIKE', "%{$search}%")->paginate(3);
        }
        else{
            $depenses = Depense::paginate(3);
        }
        return view('pages.depense', compact('depenses'));
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
           'name_depense' => ['required', 'string', 'max:30'],
           'sumDepense' => ['required', 'string'],
           'image_depense' => 'required|mimes:jpg,png,jpeg|max:5048',


       ]);
   }

   public function ajout_depense(Request $request){

     $depense = new Depense();

     $newImageName = time().'-'.'1' . '.'.$request->image_depense->extension();

     $request->image_depense->move(public_path('pictures_depense'), $newImageName);



    $depense->name_depense=$request->name_depense;
    $depense->sumDepense=$request->sumDepense;
    $depense->image_depense=$newImageName;


    $depense->save();

    return redirect()->back()->with('message', 'Recording completed.');
    }

     //fonction de mise à jour ou update
     public function depenseUpdate($id){
        $data = depense::find($id);

        return view('update.depenseUpdate', compact('data'));
    }
    //edit
    public function editdepense(Request $request, $id){

        $depense = depense::find($id);

      $updateImageName = time().'-'.'2'. '.'.$request->image_depense->extension();

      $request->image_depense->move(public_path('pictures_depense'), $updateImageName);

        $depense->name_depense=$request->name_depense;
        $depense->sumDepense=$request->sumDepense;
        $depense->image_depense=$updateImageName;




        $depense->save();
        return redirect()->back()->with('message', 'update done.');
    }
    //delete member
    public function deletedepense($id){
        $data = depense::find($id);
        $data->delete();

        return redirect('/depense')->with('status', 'Spent successfully deleted.');
    }

}
