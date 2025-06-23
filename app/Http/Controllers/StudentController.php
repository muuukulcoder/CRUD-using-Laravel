<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use App\Models\Student;

class StudentController extends Controller
{
    //This method will show Student
    public function view()
    {
        $students = DB::select('select * from student');
        return view('students.table', ['students' => $students]);
    }
    //This method will create student page
    public function create()
    {
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
                'max:2048', // 2MB max
                'min:50'    // min 50KB, optional
            ],
            'mobile' => [
                'required',
                'digits:10',
                'unique:student,mobile',
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:student,email', // match `student` with your actual table name
            ],
        ], [
            'image.required' => 'Please upload an image.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only jpeg, jpg, png formats are allowed.',
            'image.max' => 'The image must not exceed 2MB.',
            'image.min' => 'The image must be at least 50 KB.',

            'mobile.required' => 'Mobile number is required.',
            'mobile.unique' => 'Mobile number is already registered.',
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',

            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'Email is already registered.',
            'email.max' => 'Email cannot exceed 50 characters.',
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
        if ($student) {
            return redirect('/list')->with('success', 'Student added successfully!');
        } else {
            return "Something Error!!";
        }
    }
    //This method will show edit  student page
    public function data($id)
    {
        $student = Student::find($id);
        return view('/students/update', ['data' => $student]);
    }
    //This method will update a student
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $request->validate([
            'image' => [
                
                'image',
                'mimes:png,jpg,jpeg',
                'max:2048', // 2MB max
                'min:50'    // min 50KB, optional
            ],
            'mobile' => [
                
                'digits:10',
                Rule::unique('student', 'mobile')->ignore($student->id),
            ],
            'email' => [
                
                'email',
                'max:50',
                Rule::unique('student', 'email')->ignore($student->id),
            ],
        ], [
            
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only jpeg, jpg, png formats are allowed.',
            'image.max' => 'The image must not exceed 2MB.',
            'image.min' => 'The image must be at least 50 KB.',

            
            'mobile.unique' => 'Mobile number is already registered.',
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',

            
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'Email is already registered.',
            'email.max' => 'Email cannot exceed 50 characters.',
        ]);

        


        $student->name = $request->name;
        $student->email = $request->email;
        $student->mobile = $request->mobile;
        $student->father = $request->father;
        $student->mother = $request->mother;


        if ($request->hasFile('image')) {
            // delete old image
            File::delete(public_path('uploads/' . $student->image));
            // Store new image
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $student->image = $filename;
        }

        $student->save();
        if ($student) {
            return redirect('/list')->with('success', 'Updated successfully!');
        } else {
            return "Something Error!!";
        }
    }
    //This method will delete a student
    public function destory($id)
    {

        $student = Student::find($id);
        // Delete the image from the folder
        File::delete(public_path('uploads/' . $student->image));
        $delete = Student::destroy($id);
        if ($delete) {
            return redirect('/list')->with('success', 'Deleted successfully!');
        }
    }
}
