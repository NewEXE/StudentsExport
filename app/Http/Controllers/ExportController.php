<?php

namespace App\Http\Controllers;

use App\Helpers\CsvProcessor;
use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use CSV;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class ExportController extends Controller
{
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exportStudentsToCSV(Request $request)
    {
        $checkedIds = explode(',', $request->checkedIds);

        $students = Students::whereIn('id', $checkedIds)->with(['course', 'address'])->get();

        try {
            CSV::outputCsv($students, 0, 'export-students');
        } catch (InvalidParameterException $e) {
            return back()->with('message', $e->getMessage());
        }

    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     * @param CsvProcessor $csv CsvProcessor injection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exportCourseAttendenceToCSV(CsvProcessor $csv)
    {
        $courses = Course::with('students')->get();

        $csvData = $this->_coursesToCsvData($courses);

        try {
            $csv->outputCsv($csvData, 1, 'export-attendence');
        } catch (InvalidParameterException $e) {
            return back()->with('message', $e->getMessage());
        }

    }

    private function _coursesToCsvData($courses)
    {
        $csvData = [];
        foreach ($courses as $course)
        {
            $csvData[$course['id']] = [
                'course_name' => $course['course_name'],
                'university' => $course['university'],
                'students_count' => $course['students']->count(),
            ];
        }
        return $csvData;
    }
}
