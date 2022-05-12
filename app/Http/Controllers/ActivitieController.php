<?php

namespace App\Http\Controllers;
use App\Models\activitie;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class ActivitieController extends Controller
{
    //
    public function activitie() {

        $search = request()->query('search');
        if($search){
            $activities = Activitie::where('name_activities', 'LIKE', "%{$search}%")->paginate(3);
        }
        else{
            $activities = Activitie::paginate(3);
        }
        return view('pages.activitie', compact('activities'));
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
           'name_activities' => ['required', 'string', 'max:30'],
           'image_activitie' => 'required|mimes:jpg,png,jpeg|max:5048',
           'activities' => ['required', 'string'],

       ]);
   }

   public function ajout_activitie(Request $request){

     $activitie = new Activitie();

     $newImageName = time().'-'.'1'. '.'.$request->image_activitie->extension();

     $request->image_activitie->move(public_path('pictures_activities'), $newImageName);

    $activitie->name_activities=$request->name_activities;
    $activitie->image_activitie=$newImageName;
    $activitie->activities=$request->activities;



    $activitie->save();

    return redirect()->back()->with('message', 'Recording completed.');

    }

     //fonction de mise à jour ou update
     public function activitieUpdate($id){
        $data = activitie::find($id);

        return view('update.activitieUpdate', compact('data'));
    }
    //edit
    public function editactivitie(Request $request, $id){

        $activitie = activitie::find($id);

       //update d'image
       $updateImageName = time().'-'.'2'. '.'.$request->image_activitie->extension();

       $request->image_activitie->move(public_path('pictures_activities'), $updateImageName);


       $activitie->name_activities=$request->name_activities;
       $activitie->image_activitie=$updateImageName;
       $activitie->activities=$request->activities;


        $activitie->save();
        return redirect()->back()->with('message', 'update done.');
    }
    //delete member
    public function deleteactivitie($id){
        $data = activitie::find($id);
        $data->delete();

        return redirect('/activitie')->with('status', 'Activitie successfully deleted.');
    }

}
