<?php

namespace App\Http\Controllers;
use App\Models\vet;
use App\Models\phone;
use App\Models\pet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TestController extends Controller
{
    public function hasOneRelation()
    {
        $vet=vet::with(['phone'=>function($q){
            $q->select('code','phone','vet_id');//;lw 3aia azhr 7aga mo3aina bs

        }])->find(3);
        /*$vet=vet::Where('id',3)->first();
        return $vet=phone::all();*/
        return response() ->json ($vet);
    }

    public function hasonetomany()
    {
        //$vet=vet::where('vet_id',2)->first(); //elvet el id ba3o 2
       // $pet=pet::where('pet_id',2)->first(); // pet::find(2); //pet::first();
        //$vet=vet::with('pet')->find(2);
        //$pet=pet::find(2);

        //$vet=vet::find(2);ret
        //return $pet->vet;
        $vet=vet::with(['pet'=>function($q){
        $q->select('name','color','vet_id');}])->find('1'); // el 2 f nfs el w2t

       return response() ->json ($vet);

    }
    //

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
