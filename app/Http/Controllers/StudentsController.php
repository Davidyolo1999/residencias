<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentCompanyInfoRequest;
use App\Http\Requests\UpdateStudentPersonalInfo;
use App\Http\Requests\UpdateStudentProjectInfoRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Career;
use App\Models\Company;
use App\Models\ExternalAdvisor;
use App\Models\Location;
use App\Models\Period;
use App\Models\Project;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use App\Http\Requests\StoreProjectProgressRequest;
use App\Http\Requests\UpdateProjectProgressRequest;
use App\Models\Configuration;
use App\Models\ProjectProgress;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Throwable;

class StudentsController extends Controller
{
    protected static $documents = [
        'residencyRequest' => 'presentationLetter',
        'presentationLetter' => 'commitmentLetter',
        'commitmentLetter' => 'acceptanceLetter',
        'acceptanceLetter' => 'assignmentLetter',
        'assignmentLetter' => 'preliminaryLetter',
        'preliminaryLetter' => 'paperStructure',
        'paperStructure' => 'complianceLetter',
        'complianceLetter' => 'qualificationLetter',
        'qualificationLetter' => 'completionLetter',
        'completionLetter' => 'submissionLetter',
        'submissionLetter' => 'authorizationLetter',
        'authorizationLetter' => null,
    ];

    public function index(Request $request)
    {
        $user = Auth::user();

        $students = Student::query()
            ->withEmail()
            ->with('career')
            ->when($request->period_id, function ($query, $periodId) {

                $period = Period::where('id', $periodId)->first();

                if ($period) {
                    $query->whereBetween('users.created_at', [$period->start, $period->end]);
                }
            })
            ->when($request->search, fn ($query, $search) => $query->orWhere('user_id', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhereRelation('user', 'email', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('first_name', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('fathers_last_name', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('mothers_last_name', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('account_number', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhereRelation('career', 'name', 'like', "%$search%"))
            ->when($request->career_id, fn ($query, $carrerId) => $query->where('career_id', $carrerId))
            ->when($user->role === User::TEACHER_ROLE, fn ($query) => $query->where('teacher_id', $user->id))
            ->when($user->role === User::EXTERNAL_ADVISOR_ROLE, fn ($query) => $query->where('external_advisor_id', $user->id))
            ->when($request->document && array_key_exists($request->document, self::$documents), function ($query) use ($request) {
                $nextDocument = self::$documents[$request->document];

                return $query
                    ->whereHas($request->document)
                    ->when($nextDocument !== null, fn ($query) => $query->whereDoesntHave($nextDocument));
            })
            ->paginate();

        return view('students.index', [
            'students' => $students,
            'careers' => Career::all(),
            'periods' => Period::all()
        ]);
    }

    public function excel(Request $request)
    {
        $user = Auth::user();

        $students = Student::query()
            ->withEmail()
            ->with('career')
            ->when($request->period_id, function ($query, $periodId) {

                $period = Period::where('id', $periodId)->first();

                if ($period) {
                    $query->whereBetween('users.created_at', [$period->start, $period->end]);
                }
            })
            ->when($request->search, fn ($query, $search) => $query->orWhere('user_id', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhereRelation('user', 'email', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('first_name', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('fathers_last_name', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('mothers_last_name', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhere('account_number', 'like', "%$search%"))
            ->when($request->search, fn ($query, $search) => $query->orWhereRelation('career', 'name', 'like', "%$search%"))
            ->when($request->career_id, fn ($query, $carrerId) => $query->where('career_id', $carrerId))
            ->when($user->role === User::TEACHER_ROLE, fn ($query) => $query->where('teacher_id', $user->id))
            ->when($user->role === User::EXTERNAL_ADVISOR_ROLE, fn ($query) => $query->where('external_advisor_id', $user->id))
            ->when($request->document && array_key_exists($request->document, self::$documents), function ($query) use ($request) {
                $nextDocument = self::$documents[$request->document];

                return $query
                    ->whereHas($request->document)
                    ->when($nextDocument !== null, fn ($query) => $query->whereDoesntHave($nextDocument));
            })
            ->get();

        $configuration = Configuration::first();

        $reportName = 'BASE DE DATOS RESIDENCIAS PROFESIONALES-' . Carbon::now()->format('d-m-Y') . '-' . uniqid() . '.xlsx';
        return Excel::download(new StudentsExport($students, $configuration, $request->notes ? true : false, $request->covenants ? true : false), $reportName);
    }

    public function create()
    {
        return view('students.create', [
            'careers' => Career::get(),
            'teachers' => Teacher::get(),
            'externalAdvisors' => ExternalAdvisor::get(),
            'states' => Location::with(['locations.locations'])->state()->get(),
        ]);
    }

    public function show(Student $student)
    {
        return view('students.show', [
            'student' => $student,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        DB::beginTransaction();

        try {

            $user = User::create($request->userData());

            $user->student()->create($request->studentData());

            DB::commit();
        } catch (Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('students.index')
            ->with('alert', [
                'type' => 'success',
                'message' => 'El estudiante se agrego correctamente',
            ])
            ->with('userPassword', $request->password)
            ->with('userId', $user->id);
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'student' => $student,
            'careers' => Career::get(),
            'teachers' => Teacher::get(),
            'externalAdvisors' => ExternalAdvisor::get(),
            'states' => Location::with(['locations.locations'])->state()->get(),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        DB::beginTransaction();

        try {
            $student->update($request->studentData());

            $student->user->update($request->userData());

            DB::commit();
        } catch (Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('students.index')->with('alert', [
            'type' => 'success',
            'message' => 'El estudiante ha sido actualizado',
        ]);
    }

    public function personalInfo()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->load(['student.career', 'student.state']);

        return view('students.personal-info', [
            'user' => $user,
            'states' => Location::with(['locations.locations'])->state()->get()
        ]);
    }

    public function updatePersonalInfo(UpdateStudentPersonalInfo $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->student->update($request->validated());

        return redirect()->route('students.personalInfo')->with('alert', [
            'type' => 'success',
            'message' => 'La información se actualizo correctamente',
        ]);
    }

    public function companyInfo()
    {
        $company = Company::firstWhere('user_id', Auth::id()) ?? new Company();

        return view('students.company-info', [
            'company' => $company,
        ]);
    }

    public function updateCompanyInfo(UpdateStudentCompanyInfoRequest $request)
    {
        $userData = ['user_id' => Auth::id()];

        $company = Company::firstWhere($userData) ?? new Company($userData);

        $company->fill($request->validated());

        $company->save();

        return redirect()->route('students.companyInfo')->with('alert', [
            'type' => 'success',
            'message' => 'La información se actualizo correctamente',
        ]);;
    }

    public function projectInfo()
    {
        $project = Project::firstWhere('user_id', Auth::id()) ?? new Project();


        $period = Period::whereBetween('start', [$project->start_date, $project->end_date])
            ->orWhereBetween('end', [$project->start_date, $project->end_date])
            ->first();


        return view('students.project-info', [
            'project' => $project,
            'period' => $period
        ]);
    }

    public function updateProjectInfo(UpdateStudentProjectInfoRequest $request)
    {
        $userData = ['user_id' => Auth::id()];

        $project = Project::firstWhere($userData) ?? new Project($userData);

        $data = $request->validated();

        if (!$project->exists() && !$request->activity_schedule_image) {
            throw ValidationException::withMessages([
                'activity_schedule_image' => 'La imagen del cronograma es requerida',
            ]);
        }

        if ($request->activity_schedule_image) {
            $path = $request->activity_schedule_image->store('public/project');

            $data['activity_schedule_image'] = $path;
        }

        $project->fill(Arr::except($data, 'specific_objectives'));

        DB::beginTransaction();

        try {
            $project->specificObjectives()->delete();

            $project->save();

            $mappedObjectives = array_map(fn ($obj) => ['name' => $obj], $request->specific_objectives);

            $project->specificObjectives()->createMany($mappedObjectives);

            DB::commit();
        } catch (Throwable $t) {
            dd($t->getMessage());
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde',
            ]);
        }

        return redirect()->route('students.projectInfo')->with('alert', [
            'type' => 'success',
            'message' => 'La información se actualizo correctamente',
        ]);
    }

    public function viewProjectProgress(Request $request, Project $project)
    {
        return view('students.view-project-progress', [
            'project' => $project
        ]);
    }

    public function exportProjectProgress(Project $project)
    {
        $configuration = Configuration::firstOrfail();


        $pdf = PDF::loadView('students.project-progress-pdf', [
            'student' => $project->student,
            'project' => $project,
            'configuration' => $configuration,
            'teacher' => Teacher::findOrFail($project->student->teacher_id),
        ])->setPaper('a4', 'landscape');

        $customReportName = "REVISIÓN DE AVANCES DE RESIDENCIAS PROFESIONALES-{$project->student->full_name}-" . Carbon::now()->format('d-m-Y') . '.pdf';

        return $pdf->stream($customReportName);
    }

    public function loadProjectProgress(Request $request, Project $project)
    {
        return view('students.load-project-progress', [
            'project' => $project
        ]);
    }

    public function storeProjectProgress(StoreProjectProgressRequest $request)
    {
        ProjectProgress::create($request->validated());

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El avance se ha guardado exitosamente.',
        ]);
    }

    public function editProjectProgress(Request $request, Project $project, ProjectProgress $progress)
    {
        return view('students.edit-project-progress', [
            'project' => $project,
            'progress' => $progress
        ]);
    }

    public function updateProjectProgress(UpdateProjectProgressRequest $request, ProjectProgress $progress)
    {
        $progress->update($request->validated());

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El avance se ha actualizado exitosamente.',
        ]);
    }

    public function deleteProjectProgress(ProjectProgress $progress)
    {
        $progress->delete();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'El avance se ha eliminado exitosamente.',
        ]);
    }

    public function destroy(Student $student)
    {
        User::destroy($student->user_id);

        return redirect()->route('students.index')->with('alert', [
            'type' => 'success',
            'message' => 'El alumno ha sido eliminado',
        ]);
    }

    public function updatePassword(Request $request, Student $student)
    {
        $request->validate(['password' => 'required|min:6|confirmed']);

        $student->user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('students.index')->with('alert', [
            'type' => 'success',
            'message' => 'la contraseña ha sido actualizada',
        ]);
    }
}
