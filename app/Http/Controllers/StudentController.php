<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Student;

class StudentController extends Controller
{
    //This method will show Student
    public function view(){
        $students = DB::select('select * from student');
        return view('students.table', ['students' => $students  ]);

    }
    //This method will create student page
    public function create(){
        return view('students.create');

    }
    //This method will store  student in DB
     public function store(Request $request)
    {
            $request->validate([

                'image' => [
                    'required',
                    'image',
                    'mimes:png,jpg,jpeg',
                    'min:100'   //minimum 100kb
                ],
                ], [
                    'image.required' => 'Please upload an image.',
                    'image.image' => 'The file must be an image.',
                    'image.mimes' => 'Only jpeg, jpg, png formats are allowed.',
                    'image.min' => 'The image must be at least 100 KB.',

            ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->mobile = $request->mobile;
        $student->father = $request->father;
        $student->mother = $request->mother;
        $student->state = $request->state;
        $student->district = $request->district;

        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $student->image = $filename;
        }

        $student->save();
        if($student){
            return redirect('/list')->with('success', 'Student added successfully!');
        }else{
            return "Something Error!!";
        }
       

        
    }
    //This method will show edit  student page
    public function edit(){

    }
    //This method will update a student
    public function update(Request $request, $id){
        $student = Student::find($id);
        File::delete(public_path('uploads/'.$student->image));
       
        $student->name = $request->name;
        $student->email = $request->email;
        $student->mobile = $request->mobile;
        $student->father = $request->father;
        $student->mother = $request->mother;
        $student->state = $request->state;
        $student->district = $request->district;

        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $student->image = $filename;
        }

        $student->save();
        if($student){
            return redirect('/list')->with('success', 'Student added successfully!');
        }else{
            return "Something Error!!";
        }
        



    }
    //This method will delete a student
    public function destory($id){
        
        $student = Student::find($id);
        // Delete the image from the folder
        File::delete(public_path('uploads/'.$student->image));
        $delete = Student::destroy($id);
        if($delete){
            return redirect('/list')->with('success', 'Deleted successfully!');
            
        }

    }
}
