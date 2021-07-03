<?php
namespace App\Http\Controllers;
use App\Models\Puser;
use App\Models\Student;

use http\Env\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;





class studentController extends Controller
{
    Public function index()
    {
        $Students = Student::all();
        //return $Students;
        return response() ->json ($Students);
    }




    //
}
