<?php

namespace App\Http\Controllers;
use App\Models\news;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function news() {
        $search = request()->query('search');
        if($search){
            $news = News::where('name_news', 'LIKE', "%{$search}%")->paginate(3);
        }
        else{
            $news = News::paginate(3);
        }
        return view('pages.news', compact('news'));
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
           'name_news' => ['required', 'string', 'max:30'],
           'image_news' => 'required|mimes:jpg,png,jpeg|max:5048',
           'news' => ['required', 'string'],

       ]);
   }

   public function ajout_news(Request $request){

     $news = new News();

     $newImageName = time().'-'.$request->image_news->extension();

     $request->image_news->move(public_path('pictures_news'), $newImageName);

    $news->name_news=$request->name_news;
    $news->image_news=$newImageName;
    $news->news=$request->news;



    $news->save();

    return redirect()->back()->with('message', 'Recording completed.');

    }

     //fonction de mise à jour ou update
     public function newsUpdate($id){

        $data = news::find($id);

        return view('update.newsUpdate', compact('data'));
    }
    //edit
    public function editnews(Request $request, $id){

        $news = News::find($id);


        // $pv = time().'.'.$request->file('note_reunion')->getClientOriginalExtension();
       //update d'image
     $updateImageName = time().'2'. '.'.$request->file('image_news')->getClientOriginalExtension();

     $request->image_news->move(public_path('pictures_news'), $updateImageName);

        $news->name_news=$request->name_news;
        $news->image_news=$updateImageName;
        $news->news=$request->news;


        $news->save();
        return redirect()->back()->with('message', 'update done.');
    }
    //delete news
    public function deletenews($id){
        $data = news::find($id);
        $data->delete();

        return redirect('/news')->with('status', 'news successfully deleted.');
    }

}
