<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::forStudent(auth()->id())->get();
        return view('student.documents.index', compact('documents'));
    }
}
