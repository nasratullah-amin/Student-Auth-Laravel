<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        return $this->dashboard($request);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()->id;

        Course::create($data);

        return redirect()->route('dashboard')->with('success', 'Course registered.');
    }

    public function show(Request $request, int $course): View
    {
        $record = $this->ownedCourse($request, $course);

        return $this->dashboard($request, null, $record);
    }

    public function edit(Request $request, int $course): View
    {
        $record = $this->ownedCourse($request, $course);

        return $this->dashboard($request, $record);
    }

    public function update(Request $request, int $course): RedirectResponse
    {
        $record = $this->ownedCourse($request, $course);
        $record->update($this->validatedData($request, $record));

        return redirect()->route('dashboard')->with('success', 'Course updated.');
    }

    public function destroy(Request $request, int $course): RedirectResponse
    {
        $record = $this->ownedCourse($request, $course);
        $record->delete();

        return redirect()->route('dashboard')->with('success', 'Course deleted.');
    }

    private function dashboard(
        Request $request,
        ?Course $editing = null,
        ?Course $viewing = null
    ): View {
        $courses = Course::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('dashboard', compact('courses', 'editing', 'viewing'));
    }

    /** Retrieve a course only when it belongs to the signed-in user. */
    private function ownedCourse(Request $request, int $course): Course
    {
        return Course::query()
            ->where('user_id', $request->user()->id)
            ->findOrFail($course);
    }

    private function validatedData(Request $request, ?Course $course = null): array
    {
        $code = $request->input('course_code');

        if (is_string($code)) {
            $request->merge(['course_code' => strtoupper(trim($code))]);
        }

        $uniqueCode = Rule::unique('courses', 'course_code')
            ->where('user_id', $request->user()->id);

        if ($course !== null) {
            $uniqueCode->ignore($course->getKey(), $course->getKeyName());
        }

        return $request->validate([
            'course_code' => ['required', 'string', 'max:20', $uniqueCode],
            'course_name' => ['required', 'string', 'max:150'],
            'credit_hours' => ['required', 'integer', 'between:1,6'],
            'semester' => ['required', Rule::in(['Spring 2026', 'Fall 2026'])],
        ]);
    }
}
