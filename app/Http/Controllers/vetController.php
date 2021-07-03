<?php

namespace App\Http\Controllers;

use App\Models\Ppost;
use App\vet;
use App\Schedule;
use App\Puser;
//use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//relation

class vetController extends BaseController
{
    public function data(){
        $vets=vet::all();
        return view( 'vetview',compact('vets'));

    }
    /*public function add (Request $request){
        $vet=new vet();

        $vet->name =$request->input('namevet');
        $vet->age =$request->input('agevet');
        $vet->phone =$request->input('phonevet');
        $vet->save();
        return redirect()->back();
    }*/
    public function add (Request $request)
    {
        $vet= new vet();
        $vet->name=$request->input('namevet');
        $vet->age=$request->input('agevet');
        $vet->phone=$request->input('phonevet');
        $vet->save();
        return redirect()->back();

    }
    public function drop ($id){
        $vet =  vet::where('id',$id);
        $vet->delete();
        return redirect()-> back();

    }
    public function viewvet($id)
    {
        $vets=vet::find($id);
        return response()->json($vets);
    }
     public function allvet()
     {
         $vet=vet::all();
         return response()->json($vet);
     }
    public function searchvet(Request $request)
    {
        $data = $request->input('vet_name');
        $Validator = Validator::make($request->all(), [
            'vet_name' => 'required | min:3']);
        if ($Validator->fails()) {
            return $Validator->errors();
        } else {
            $vets = vet::where('name', 'like', "%{$data}%")->get();

            return response()->json($vets);
        }
    }
    public function addshedule(Request $request)
    {
        $data=$request->input('vet_id');

        $vet = vet::find($data);
            $Shedule = new Schedule();

            $Shedule->date = $request->input('date');
            $Shedule->day = $request->input('day');
            $Shedule->start_time = $request->input('start_time');
            $Shedule->end_time = $request->input('end_time');
            $vet = $vet->shedule()->save($Shedule);
            return $Shedule;


    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
