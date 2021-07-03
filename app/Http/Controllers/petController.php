<?php

namespace App\Http\Controllers;

use App\Models\ppet;

use App\Product;
use App\Puser;
use App\Vet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class petController extends Controller
{
    public function showpet()
    {
        $Ppets = ppet::all();
        return response()->json($Ppets);
    }
    public function addpet(Request $request)
    {
        $file_extension=$request->photo->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path='image/pet';
        $request->photo->move($path,$file_name);
        $data=$request->input('id');

        $user = Puser::find($data);
        $Ppets = Ppet::create(
            [
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'color' => $request->color,
                'bread' => $request->bread,
                'photo' => $file_name,
                'diseases' => $request->diseases,
                'vaccinations' => $request->vaccinations,
                'type' => $request->type,
                'section'=>$request->section,

            ]);
        $user = $user->posts()->save($Ppets);

        return $Ppets;
    }
    public function adoptionsection()
    {
        $Ppets=Ppet::where('section','=','1')->get(); //section 1 - adoption
        return response()->json($Ppets);
    }
    public function matesection()
    {
        $Ppets=Ppet::where('section','=','2')->get(); //section 2 - mate
        return response()->json($Ppets);
    }
    public function hostsection()
    {
        $Ppets=Ppet::where('section','=','3')->get(); //section 3 - host
        return response()->json($Ppets);
    }
    public function searchInadoptionSection(Request $request)
    {
        $data = $request->input('pet_name');
        $Validator = Validator::make($request->all(), [
            'pet_name' => 'required | min:3']);
        if ($Validator->fails()) {
            return $Validator->errors();
        }
        else
        {
            $Ppets = Ppet::where('name', 'like', "%{$data}%")
                           ->where('section','=','1')->get();

            return response()->json($Ppets);
        }}
    public function Shostsection (Request $request) //search in host section
    {
        $pet_name = $request->input('pet_name');
        $Validator = Validator::make($request->all(), [
            'pet_name' => 'required | min:3']);
        if ($Validator->fails()) {
            return $Validator->errors();
        }
        else
        {//a7la msa 3lik ya sa7b
            $Ppets = Ppet::where('name', 'like', "%{$pet_name}%")
                           ->where('section','=','3')->get();

            return response()->json($Ppets);
        }}
    public function searchInmateSection(Request $request)
    {
        $data = $request->input('pet_name');
        $Validator = Validator::make($request->all(), [
            'pet_name' => 'required | min:3']);
        if ($Validator->fails()) {
            return $Validator->errors();
        }
        else
        {
            $Ppets = Ppet::where('name', 'like', "%{$data}%")
                         ->where('section','=','2')->get();

            return response()->json($Ppets);
        }}
        /*


   /* public function index(){
        $pets=pet::all();
        return view('petview',compact('pets'));
    }*/
    //

    public function insert (Request $request)
    {
        $pet= new pet();
        $pet->name=$request->input('namepet');
        $pet->color=$request->input('colorpet');
        $pet->save();
        return redirect()->back();

    }
    public function delete($id)
    {
       $pet =  pet::where('id',$id);
       $pet->delete();
       return redirect()->back();

    }
    public function showdata($id)
    {
        $pet=pet::find($id);
        return view('petdetails',compact('pet'));
    }
    public function update($id, Request $request){
        $pet =pet::find($id);

        $pet->name = $request->input('namepet');
        $pet->color = $request->input('colorpet');
        $pet->update();
        return redirect()->back();


    }
    public function index()
    {
        $Pusers=Puser::all();
        return $Pusers;


    }

    public function viewpet ($id)
    {
       //$Ppet=ppet::where('id',$id);
       return Ppet::find($id);


    }
    public function deletepet(Request $request)
    {
        $data = $request->input('pet_id');
        $pet = Product::where('id','=', $data);
        $pet->delete();
        return 'done';
    }
}


