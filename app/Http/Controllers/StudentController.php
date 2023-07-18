<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Importer;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('upload-excel', ['students' => $students]);
    }

    public function downloadTemplate()
    {
        $filePath = storage_path('app/public/template-students.xlsx');

        return response()->download($filePath, 'template-students.xlsx');
    }

    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $path = $request->file('file')->getRealPath();

            // Read the Excel file data starting from row 2 (skipping the header)
            $rows = Excel::toArray(null, $path, null, \Maatwebsite\Excel\Excel::XLSX)[0];
            array_shift($rows); // Remove the header row

            $successCount = 0; // Initialize success counter

            foreach ($rows as $row) {
                $studentData = [
                    'name' => $row[0],
                    'class' => $row[1],
                    'level' => $row[2],
                    'parent_contact' => $row[3],
                ];

                // Check if the student record already exists
                $existingStudent = Student::where('name', $studentData['name'])
                ->where('class', $studentData['class'])
                ->where('level', $studentData['level'])
                ->where('parent_contact', $studentData['parent_contact'])
                ->exists();

                if (!$existingStudent) {
                    // Create a new student record
                    Student::create($studentData);
                    $successCount++;
                }
            }

            $totalCount = count($rows);
            $existingCount = $totalCount - $successCount;

            return redirect()->back()->with('success', $successCount . ' student(s) data uploaded successfully! ' . $existingCount . ' data already exists.');
        }

        return redirect()->back()->withErrors(['error' => 'Failed to upload the file. Please try again.']);
    }
}
