<?php

namespace App\Http\Controllers;
use App\Models\revenue;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RevenueController extends Controller
{
    //
    public function revenue() {
        $search = request()->query('search');
        if($search){
            $revenues = Revenue::where('montant', 'LIKE', "%{$search}%")->paginate(3);
        }
        else{
            $revenues = Revenue::paginate(3);
        }
        return view('pages.revenue', compact('revenues'));
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
           'montant' => ['required', 'string', 'max:200'],

       ]);
   }

   public function ajout_revenue(Request $request){

     $revenue = new Revenue();


    $revenue->montant=$request->montant;



    $revenue->save();

    return redirect()->back()->with('message', 'Recording completed.');
    }

     //fonction de mise à jour ou update
     public function revenueUpdate($id){
        $data = revenue::find($id);

        return view('update.revenueUpdate', compact('data'));
    }
    //edit
    public function editrevenue(Request $request, $id){

        $revenue = revenue::find($id);

        $revenue->montant=$request->montant;



        $revenue->save();
        return redirect()->back()->with('message', 'update done.');
    }
    //delete receipt
    public function deleterevenue($id){
        $data = revenue::find($id);
        $data->delete();

        return redirect('/revenue')->with('status', 'Receipt successfully deleted.');
    }

}
