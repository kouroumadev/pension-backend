<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use Illuminate\Http\Request;
use App\Models\Doc;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;

class SecretariatController extends Controller
{
    
    public function SecretariatIndex(){
        $dep_id = Auth::user()->dept_id;
        
        $trans = Transfer::Where('to_dept', Auth::user()->dept->id)->where('status',0)->get();
        $deadline = Deadline::where('dept_id',Auth::user()->dept_id)->get();
        $dead_name = $deadline[0]->name;
       
        return view('secretariat.index', compact('dead_name','trans'));
    }
}
