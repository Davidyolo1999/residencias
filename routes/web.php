<?php

use App\Http\Controllers\AcceptanceLetterController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AssignmentLetterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizationLetterController;
use App\Http\Controllers\CommitmentLetterController;
use App\Http\Controllers\CompletionLetterController;
use App\Http\Controllers\ComplianceLetterController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CorrectionsController;
use App\Http\Controllers\ExternalAdvisorsController;
use App\Http\Controllers\ExternalQualificationLetterController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\PaperStructureController;
use App\Http\Controllers\PeriodsController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\PreliminaryLetterController;
use App\Http\Controllers\PresentationLetterController;
use App\Http\Controllers\QualificationLetterController;
use App\Http\Controllers\ResidencyProcessController;
use App\Http\Controllers\ResidencyRequestController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubmissionLetterController;
use App\Http\Controllers\TeachersController;
use App\Models\Admin;
use App\Models\ExternalAdvisor;
use App\Models\Period;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/mi-perfil', [AuthController::class, 'profile'])->name('profile');
    Route::put('/actualizar-perfil', [AuthController::class, 'updateProfile'])->name('updateProfile');

    Route::prefix('/admins')->name('admins.')->group(function () {
        Route::get('/', [AdminsController::class, 'index'])->name('index')->can('index', Admin::class);
        Route::get('/create', [AdminsController::class, 'create'])->name('create')->can('create', Admin::class);
        Route::post('/', [AdminsController::class, 'store'])->name('store')->can('create', Admin::class);
        Route::delete('/{admin}', [AdminsController::class, 'destroy'])->name('destroy')->can('destroy', 'admin');
        Route::get('/{admin}/edit', [AdminsController::class, 'edit'])->name('edit')->can('update', 'admin');
        Route::put('/{admin}', [AdminsController::class, 'update'])->name('update')->can('update', 'admin');
        Route::put('/{admin}/password', [AdminsController::class, 'updatePassword'])->name('updatePassword')->can('update', 'admin');
    });

    Route::prefix('/periods')->name('periods.')->group(function () {
        Route::get('/', [PeriodsController::class, 'index'])->name('index')->can('index', Period::class);
        Route::get('/create', [PeriodsController::class, 'create'])->name('create')->can('create', Period::class);
        Route::post('/', [PeriodsController::class, 'store'])->name('store')->can('create', Period::class);
        Route::delete('/{period}', [PeriodsController::class, 'destroy'])->name('destroy')->can('destroy', 'period');
        Route::get('/{period}/edit', [PeriodsController::class, 'edit'])->name('edit')->can('update', 'period');
        Route::put('/{period}', [PeriodsController::class, 'update'])->name('update')->can('update', 'period');
    });

    Route::prefix('/teachers')->name('teachers.')->group(function () {
        Route::get('/', [TeachersController::class, 'index'])->name('index')->can('index', Teacher::class);
        Route::get('/create', [TeachersController::class, 'create'])->name('create')->can('create', Teacher::class);
        Route::post('/', [TeachersController::class, 'store'])->name('store')->can('create', Teacher::class);
        Route::delete('/{teacher}', [TeachersController::class, 'destroy'])->name('destroy')->can('destroy', 'teacher');
        Route::get('/{teacher}/edit', [TeachersController::class, 'edit'])->name('edit')->can('update', 'teacher');
        Route::put('/{teacher}', [TeachersController::class, 'update'])->name('update')->can('update', 'teacher');
        Route::put('/{teacher}/password', [TeachersController::class, 'updatePassword'])->name('updatePassword')->can('update', 'teacher');
    });

    Route::prefix('/external-advisor')->name('externalAdvisor.')->group(function () {
        Route::get('/', [ExternalAdvisorsController::class, 'index'])->name('index')->can('index', ExternalAdvisor::class);
        Route::get('/create', [ExternalAdvisorsController::class, 'create'])->name('create')->can('create', ExternalAdvisor::class);
        Route::post('/', [ExternalAdvisorsController::class, 'store'])->name('store')->can('create', ExternalAdvisor::class);
        Route::delete('/{externaladvisor}', [ExternalAdvisorsController::class, 'destroy'])->name('destroy')->can('destroy', 'externaladvisor');
        Route::get('/{externaladvisor}/edit', [ExternalAdvisorsController::class, 'edit'])->name('edit')->can('update', 'externaladvisor');
        Route::put('/{externaladvisor}', [ExternalAdvisorsController::class, 'update'])->name('update')->can('update', 'externaladvisor');
        Route::put('/{externaladvisor}/password', [ExternalAdvisorsController::class, 'updatePassword'])->name('updatePassword')->can('update', 'externaladvisor');
    });

    Route::prefix('/students')->name('students.')->group(function () {
        Route::get('/', [StudentsController::class, 'index'])->name('index')->can('index', Student::class);
        Route::get('/excel', [StudentsController::class, 'excel'])->name('excel')->can('export', Student::class);
        Route::get('/create', [StudentsController::class, 'create'])->name('create')->can('create', Student::class);
        Route::post('/', [StudentsController::class, 'store'])->name('store')->can('create', Student::class);
        Route::get('/{student}', [StudentsController::class, 'show'])->name('show')->where('student', '[0-9]+')->can('show', 'student');
        Route::get('/personal-info', [StudentsController::class, 'personalInfo'])->name('personalInfo')->can('view-personal-info');
        Route::put('/personal-info', [StudentsController::class, 'updatePersonalInfo'])->name('updatePersonalInfo');
        Route::get('/company-info', [StudentsController::class, 'companyInfo'])->name('companyInfo')->can('view-company-info');
        Route::put('/company-info', [StudentsController::class, 'updateCompanyInfo'])->name('updateCompanyInfo');
        Route::get('/project-info', [StudentsController::class, 'projectInfo'])->name('projectInfo')->can('view-project-info');
        Route::put('/project-info', [StudentsController::class, 'updateProjectInfo'])->name('updateProjectInfo');
        Route::delete('/{student}', [StudentsController::class, 'destroy'])->name('destroy')->can('destroy', 'student');
        Route::get('/{student}/edit', [StudentsController::class, 'edit'])->name('edit')->can('update', 'student');
        Route::put('/{student}', [StudentsController::class, 'update'])->name('update')->can('update', 'student');
        Route::put('/{student}/password', [StudentsController::class, 'updatePassword'])->name('updatePassword')->can('update', 'student');
        Route::get('/residency-process', [ResidencyProcessController::class, 'residencyProcess'])->name('residencyProcess')->can('view-residency-info');
        Route::get('/{student}/registration-in-the-system', [PersonalInformationController::class, 'personalInformation'])->name('personalInformation');

        // Residency request
        Route::post('/residency-process/residency-request', [ResidencyRequestController::class, 'residencyRequest'])->name('residencyRequest');
        Route::put('/residency-process/residency-request/corrections/mark-as-solved', [ResidencyRequestController::class, 'residencyRequestMarkCorrectionsAsSolved'])->name('residencyRequestMarkCorrectionsAsSolved');
        Route::post('/{student}/residency-request/corrections', [ResidencyRequestController::class, 'residencyRequestCorrections'])->name('residencyRequestCorrections');
        Route::put('/{student}/residency-request/mark-as-approved', [ResidencyRequestController::class, 'residencyRequestMarkAsApproved'])->name('residencyRequestMarkAsApproved');
        Route::put('/{student}/residency-request/signed-document', [ResidencyRequestController::class, 'residencyRequestUploadSignedDoc'])->name('residencyRequestUploadSignedDoc');
        Route::get('/{student}/residency-request/signed-document', [ResidencyRequestController::class, 'residencyRequestDownloadSignedDoc'])->name('residencyRequestDownloadSignedDoc');
        // Presentation letter
        Route::post('/residency-process/presentation-letter', [PresentationLetterController::class, 'presentationLetter'])->name('presentationLetter');
        Route::post('/{student}/presentation-letter/corrections', [PresentationLetterController::class, 'presentatioLetterCorrections'])->name('presentatioLetterCorrections');
        Route::put('/residency-process/presentation-letter/corrections/mark-as-solved', [PresentationLetterController::class, 'presentationLetterMarkCorrectionsAsSolved'])->name('presentationLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/presentation-letter/mark-as-approved', [PresentationLetterController::class, 'presentationLetterMarkAsApproved'])->name('presentationLetterMarkAsApproved');
        // Commitment letter
        Route::post('/residency-process/commitment-letter', [CommitmentLetterController::class, 'commitmentLetter'])->name('commitmentLetter');
        Route::post('/{student}/commitment-letter/corrections', [CommitmentLetterController::class, 'commitmentLetterCorrections'])->name('commitmentLetterCorrections');
        Route::put('/residency-process/commitment-letter/corrections/mark-as-solved', [CommitmentLetterController::class, 'commitmentLetterMarkCorrectionsAsSolved'])->name('commitmentLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/commitment-letter/mark-as-approved', [CommitmentLetterController::class, 'commitmentLetterMarkAsApproved'])->name('commitmentLetterMarkAsApproved');
        Route::put('/{student}/presentation-letter/signed-document', [PresentationLetterController::class, 'presentationLetterUploadSignedDoc'])->name('presentationLetterUploadSignedDoc');
        Route::get('/{student}/presentation-letter/signed-document', [PresentationLetterController::class, 'presentationLetterDownloadSignedDoc'])->name('presentationLetterDownloadSignedDoc');
        Route::put('/{student}/commitment-letter/signed-document', [CommitmentLetterController::class, 'commitmentLetterUploadSignedDoc'])->name('commitmentLetterUploadSignedDoc');
        Route::get('/{student}/commitment-letter/signed-document', [CommitmentLetterController::class, 'commitmentLetterDownloadSignedDoc'])->name('commitmentLetterDownloadSignedDoc');
        // Acceptance Letter
        Route::post('/residency-process/acceptance-letter', [AcceptanceLetterController::class, 'acceptanceLetter'])->name('acceptanceLetter');
        Route::put('/{student}/acceptance-letter/signed-document', [AcceptanceLetterController::class, 'acceptanceLetterUploadSignedDoc'])->name('acceptanceLetterUploadSignedDoc');
        Route::get('/{student}/acceptance-letter/signed-document', [AcceptanceLetterController::class, 'acceptanceLetterDownloadSignedDoc'])->name('acceptanceLetterDownloadSignedDoc');
        Route::post('/{student}/acceptance-letter/corrections', [AcceptanceLetterController::class, 'acceptanceLetterCorrections'])->name('acceptanceLetterCorrections');
        Route::put('/residency-process/acceptance-letter/corrections/mark-as-solved', [AcceptanceLetterController::class, 'acceptanceLetterMarkCorrectionsAsSolved'])->name('acceptanceLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/acceptance-letter/mark-as-approved', [AcceptanceLetterController::class, 'acceptanceLetterMarkAsApproved'])->name('acceptanceLetterMarkAsApproved');
        // Assignment Letter
        Route::post('/residency-process/assignment-letter', [AssignmentLetterController::class, 'assignmentLetter'])->name('assignmentLetter');
        Route::post('/{student}/assignment-letter/corrections', [AssignmentLetterController::class, 'assignmentLetterCorrections'])->name('assignmentLetterCorrections');
        Route::put('/residency-process/assignment-letter/corrections/mark-as-solved', [AssignmentLetterController::class, 'assignmentLetterMarkCorrectionsAsSolved'])->name('assignmentLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/assignment-letter/mark-as-approved', [AssignmentLetterController::class, 'assignmentLetterMarkAsApproved'])->name('assignmentLetterMarkAsApproved');
        Route::put('/{student}/assignment-letter/signed-document', [AssignmentLetterController::class, 'assignmentLetterUploadSignedDoc'])->name('assignmentLetterUploadSignedDoc');
        Route::get('/{student}/assignment-letter/signed-document', [AssignmentLetterController::class, 'assignmentLetterDownloadSignedDoc'])->name('assignmentLetterDownloadSignedDoc');
        // Preliminary Letter
        Route::post('/residency-process/preliminary-letter', [PreliminaryLetterController::class, 'preliminaryLetter'])->name('preliminaryLetter');
        Route::post('/{student}/preliminary-letter/corrections', [PreliminaryLetterController::class, 'preliminaryLetterCorrections'])->name('preliminaryLetterCorrections');
        Route::put('/residency-process/preliminary-letter/corrections/mark-as-solved', [PreliminaryLetterController::class, 'preliminaryLetterMarkCorrectionsAsSolved'])->name('preliminaryLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/preliminary-letter/mark-as-approved', [PreliminaryLetterController::class, 'preliminaryLetterMarkAsApproved'])->name('preliminaryLetterMarkAsApproved');
        Route::put('/{student}/preliminary-letter/signed-document', [PreliminaryLetterController::class, 'preliminaryLetterUploadSignedDoc'])->name('preliminaryLetterUploadSignedDoc');
        Route::get('/{student}/preliminary-letter/signed-document', [PreliminaryLetterController::class, 'preliminaryLetterDownloadSignedDoc'])->name('preliminaryLetterDownloadSignedDoc');
        //Paper structure
        Route::put('/{student}/paper-structure/signed-document', [PaperStructureController::class, 'paperStructureUploadSignedDoc'])->name('paperStructureUploadSignedDoc');
        Route::get('/{student}/paper-structure/signed-document', [PaperStructureController::class, 'paperStructureDownloadSignedDoc'])->name('paperStructureDownloadSignedDoc');
        Route::post('/{student}/paper-structure/corrections', [PaperStructureController::class, 'paperStructureCorrections'])->name('paperStructureCorrections');
        Route::put('/residency-process/paper-structure/corrections/mark-as-solved', [PaperStructureController::class, 'paperStructureMarkCorrectionsAsSolved'])->name('paperStructureMarkCorrectionsAsSolved');
        Route::put('/{student}/paper-structure/mark-as-approved', [PaperStructureController::class, 'paperStructureMarkAsApproved'])->name('paperStructureMarkAsApproved');
        //Compliance Letter
        Route::post('/residency-process/compliance-letter', [ComplianceLetterController::class, 'complianceLetter'])->name('complianceLetter');
        Route::post('/{student}/compliancey-letter/corrections', [ComplianceLetterController::class, 'complianceLetterCorrections'])->name('complianceLetterCorrections');
        Route::put('/residency-process/compliance-letter/corrections/mark-as-solved', [ComplianceLetterController::class, 'complianceLetterMarkCorrectionsAsSolved'])->name('complianceLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/compliance-letter/mark-as-approved', [ComplianceLetterController::class, 'complianceLetterMarkAsApproved'])->name('complianceLetterMarkAsApproved');
        Route::put('/{student}/compliance-letter/signed-document', [ComplianceLetterController::class, 'complianceLetterUploadSignedDoc'])->name('complianceLetterUploadSignedDoc');
        Route::get('/{student}/compliance-letter/signed-document', [ComplianceLetterController::class, 'complianceLetterDownloadSignedDoc'])->name('complianceLetterDownloadSignedDoc');
        Route::post('/{student}/comliance-letter/answer-questions', [ComplianceLetterController::class, 'answerQuestions'])->name('complianceLetterAnswerQuestions');
        //Qualification Letter
        Route::post('/residency-process/qualification-letter', [QualificationLetterController::class, 'qualificationLetter'])->name('qualificationLetter');
        Route::post('/{student}/qualification-letter/corrections', [QualificationLetterController::class, 'qualificationLetterCorrections'])->name('qualificationLetterCorrections');
        Route::put('/residency-process/qualification-letter/corrections/mark-as-solved', [QualificationLetterController::class, 'qualificationLetterMarkCorrectionsAsSolved'])->name('qualificationLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/qualification-letter/mark-as-approved', [QualificationLetterController::class, 'qualificationLetterMarkAsApproved'])->name('qualificationLetterMarkAsApproved');
        Route::put('/{student}/qualification-letter/modified', [QualificationLetterController::class, 'qualificationLetterModify'])->name('qualificationLetterModify');
        Route::put('/{student}/qualification-letter/signed-document', [QualificationLetterController::class, 'qualificationLetterUploadSignedDoc'])->name('qualificationLetterUploadSignedDoc');
        Route::get('/{student}/qualification-letter/signed-document', [QualificationLetterController::class, 'qualificationLetterDownloadSignedDoc'])->name('qualificationLetterDownloadSignedDoc');
        //Completion Letter
        Route::post('/residency-process/completion-letter', [CompletionLetterController::class, 'completionLetter'])->name('completionLetter');
        Route::post('/{student}/completion-letter/corrections', [CompletionLetterController::class, 'completionLetterCorrections'])->name('completionLetterCorrections');
        Route::put('/residency-process/completion-letter/corrections/mark-as-solved', [CompletionLetterController::class, 'completionLetterMarkCorrectionsAsSolved'])->name('completionLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/completion-letter/mark-as-approved', [CompletionLetterController::class, 'completionLetterMarkAsApproved'])->name('completionLetterMarkAsApproved');
        Route::put('/{student}/completion-letter/signed-document', [CompletionLetterController::class, 'completionLetterUploadSignedDoc'])->name('completionLetterUploadSignedDoc');
        Route::get('/{student}/completion-letter/signed-document', [CompletionLetterController::class, 'completionLetterDownloadSignedDoc'])->name('completionLetterDownloadSignedDoc');
        //Submission Letter
        Route::post('/residency-process/submission-letter', [SubmissionLetterController::class, 'submissionLetter'])->name('submissionLetter');
        Route::post('/{student}/submission-letter/corrections', [SubmissionLetterController::class, 'submissionLetterCorrections'])->name('submissionLetterCorrections');
        Route::put('/residency-process/submission-letter/corrections/mark-as-solved', [SubmissionLetterController::class, 'submissionLetterMarkCorrectionsAsSolved'])->name('submissionLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/submission-letter/mark-as-approved', [SubmissionLetterController::class, 'submissionLetterMarkAsApproved'])->name('submissionLetterMarkAsApproved');
        Route::put('/{student}/submission-letter/signed-document', [SubmissionLetterController::class, 'submissionLetterUploadSignedDoc'])->name('submissionLetterUploadSignedDoc');
        Route::get('/{student}/submission-letter/signed-document', [SubmissionLetterController::class, 'submissionLetterDownloadSignedDoc'])->name('submissionLetterDownloadSignedDoc');
        //Authorization Letter
        Route::post('/residency-process/authorization-letter', [AuthorizationLetterController::class, 'authorizationLetter'])->name('authorizationLetter');
        Route::post('/{student}/authorization-letter/corrections', [AuthorizationLetterController::class, 'authorizationLetterCorrections'])->name('authorizationLetterCorrections');
        Route::put('/residency-process/authorization-letter/corrections/mark-as-solved', [AuthorizationLetterController::class, 'authorizationLetterMarkCorrectionsAsSolved'])->name('authorizationLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/authorization-letter/mark-as-approved', [AuthorizationLetterController::class, 'authorizationLetterMarkAsApproved'])->name('authorizationLetterMarkAsApproved');
        Route::put('/{student}/authorization-letter/signed-document', [AuthorizationLetterController::class, 'authorizationLetterUploadSignedDoc'])->name('authorizationLetterUploadSignedDoc');
        Route::get('/{student}/authorization-letter/signed-document', [AuthorizationLetterController::class, 'authorizationLetterDownloadSignedDoc'])->name('authorizationLetterDownloadSignedDoc');
        //External Qualification Letter
        Route::post('/residency-process/external-qualification-letter', [ExternalQualificationLetterController::class, 'externalQualificationLetter'])->name('externalQualificationLetter');
        Route::post('/{student}/external-qualification-letter/corrections', [ExternalQualificationLetterController::class, 'externalQualificationLetterCorrections'])->name('externalQualificationLetterCorrections');
        Route::put('/residency-process/external-qualification-letter/corrections/mark-as-solved', [ExternalQualificationLetterController::class, 'externalQualificationLetterMarkCorrectionsAsSolved'])->name('externalQualificationLetterMarkCorrectionsAsSolved');
        Route::put('/{student}/external-qualification-letter/mark-as-approved', [ExternalQualificationLetterController::class, 'externalQualificationLetterMarkAsApproved'])->name('externalQualificationLetterMarkAsApproved');
        Route::put('/{student}/external-qualification-letter/signed-document', [ExternalQualificationLetterController::class, 'externalQualificationLetterUploadSignedDoc'])->name('externalQualificationLetterUploadSignedDoc');
        Route::get('/{student}/external-qualification-letter/signed-document', [ExternalQualificationLetterController::class, 'externalQualificationLetterDownloadSignedDoc'])->name('externalQualificationLetterDownloadSignedDoc');
    });

    Route::post('/corrections/{correctionId}/mark-as-solved', [CorrectionsController::class, 'markAsSolved'])->name('corrections.markAsSolved');

    Route::prefix('/locations')->name('locations.')->group(function () {

        Route::get('/', [LocationsController::class, 'index'])->name('index')->can('index', Admin::class);
        Route::get('/create', [LocationsController::class, 'create'])->name('create')->can('create', Admin::class);
        Route::post('/', [LocationsController::class, 'store'])->name('store')->can('create', Admin::class);
        Route::delete('/{location}', [LocationsController::class, 'destroy'])->name('destroy');
        Route::get('/{location}/edit', [LocationsController::class, 'edit'])->name('edit');
        Route::put('/{location}', [LocationsController::class, 'update'])->name('update');
    });

    Route::prefix('/configurations')->name('configurations.')->group(function () {

        Route::get('/unit-info', [ConfigurationController::class, 'unitInfo'])->name('unitInfo')->can('index', Admin::class);
        Route::put('/unit-info', [ConfigurationController::class, 'updateUnitInfo'])->name('updateUnitInfo');
    });
});
