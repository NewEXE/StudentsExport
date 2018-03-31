<?php

namespace App\Http\Controllers;

use App\Helpers\CsvProcessor;
use App\Models\Students;
use Illuminate\Http\Request;
use CSV;

class ExportController extends Controller
{
    public function __construct()
    {

    }

    public function welcome()
    {
        return view('hello');
    }

    /**
     * View all students found in the database
     */
    public function viewStudents()
    {
        $students = Students::with('course')->get();
        return view('view_students', compact(['students']));
    }

    /**
     * Exports all student data to a CSV file
     * @param Request $request
     */
    public function exportStudentsToCSV(Request $request)
    {
        $checkedIds = $request->checkedIds;

        $students = Students::whereIn('id', $checkedIds)->with(['address', 'course'])->get();

        CSV::outputCsv($students);
    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     * @param Request $request
     * @param CsvProcessor $csv CsvProcessor injection demonstration
     */
    public function exporttCourseAttendenceToCSV(Request $request, CsvProcessor $csv)
    {

    }
}
