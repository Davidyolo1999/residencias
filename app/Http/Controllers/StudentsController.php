<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentCompanyInfoRequest;
use App\Http\Requests\UpdateStudentPersonalInfo;
use App\Http\Requests\UpdateStudentProjectInfoRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\AuthorizationLetter;
use App\Models\Career;
use App\Models\Company;
use App\Models\ExternalAdvisor;
use App\Models\Location;
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
use Throwable;

class StudentsController extends Controller
{
    protected static $documents = [
        'residencyRequest' => 'presentationLetter',
        'presentationLetter' => 'commitmentLetter',
        'commitmentLetter'=>'acceptanceLetter',
        'acceptanceLetter'=>'assignmentLetter',
        'assignmentLetter'=>'preliminaryLetter',
        'preliminaryLetter'=>'paperStructure',
        'paperStructure'=>'complianceLetter',
        'complianceLetter'=>'qualificationLetter',
        'qualificationLetter'=>'completionLetter',
        'completionLetter'=>'submissionLetter',
        'submissionLetter'=> 'authorizationLetter',
        'authorizationLetter' => null,
    ];
    public function index(Request $request)
    {
        $user = Auth::user();

        $students = Student::query()
            ->withEmail()
            ->with('career')
            ->when($user->role === User::TEACHER_ROLE, fn($query) => $query->where('teacher_id', $user->id))
            ->when($user->role === User::EXTERNAL_ADVISOR_ROLE, fn($query) => $query->where('external_advisor_id', $user->id))
            ->when($request->document && array_key_exists($request->document, self::$documents), function($query) use ($request) {
                $nextDocument = self::$documents[$request->document];
                
                return $query
                    ->whereHas($request->document)
                    ->when($nextDocument !== null, fn($query) => $query->whereDoesntHave($nextDocument));
            })
            ->paginate();

        return view('students.index', [
            'students' => $students,
        ]);
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

        return redirect()->route('students.index')->with('alert', [
            'type' => 'success',
            'message' => 'El estudiante se agrego correctamente',
        ]);
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
        } catch(Throwable $t) {            
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

        return view('students.project-info',[
            'project'=> $project,
        ] );
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
            
            $mappedObjectives = array_map(fn($obj) => ['name' => $obj], $request->specific_objectives);
            
            $project->specificObjectives()->createMany($mappedObjectives);

            DB::commit();
        } catch(Throwable $t) {
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

        return redirect()->route('students.index')->with('alert',[
            'type' => 'success',
            'message' =>'la contraseña ha sido actualizada',
        ]);
    }
}
