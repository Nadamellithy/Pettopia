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


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
