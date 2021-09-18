<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() 
    {
        return view("welcome");
    }

    public function store(Request $request)
    {
        $request->validate([
            'addMoreInputFields.*.subject' => 'required'
        ]);
     
        foreach ($request->addMoreInputFields as $key => $value) {
            Student::create($value);
        }
     
        return back()->with('success', 'New subject has been added.');
    }
}
