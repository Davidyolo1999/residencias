<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected const REDIRECTS = [
        User::ADMIN_ROLE => '/configurations/unit-info',
        User::STUDENT_ROLE => '/students/personal-info',
        User::TEACHER_ROLE => '/students',
        User::EXTERNAL_ADVISOR_ROLE => '/students',
    ];

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(self::REDIRECTS[Auth::user()->role]);
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile(Request $request)
    {
        $first_name = auth()->user()->teacher->first_name ?? auth()->user()->externalAdvisor->first_name;
        $fathers_last_name = auth()->user()->teacher->fathers_last_name ?? auth()->user()->externalAdvisor->fathers_last_name;
        $mothers_last_name = auth()->user()->teacher->mothers_last_name ?? auth()->user()->externalAdvisor->mothers_last_name;
        $curp = auth()->user()->teacher->curp ?? auth()->user()->externalAdvisor->curp;
        $sex_text = auth()->user()->teacher->sex_text ?? auth()->user()->externalAdvisor->sex_text;
        $phone_number = auth()->user()->teacher->phone_number ?? auth()->user()->externalAdvisor->phone_number;
        $state_id = auth()->user()->teacher->state_id ?? auth()->user()->externalAdvisor->state_id;
        $municipality_id = auth()->user()->teacher->municipality_id ?? auth()->user()->externalAdvisor->municipality_id;
        $locality_id = auth()->user()->teacher->locality_id ?? auth()->user()->externalAdvisor->locality_id;
        $career = auth()->user()->externalAdvisor->career ?? '';
        $charge = auth()->user()->externalAdvisor->charge ?? '';


        $states = Location::with(['locations.locations'])->state()->get();

        return view('profile', [
            'first_name' => $first_name,
            'fathers_last_name' => $fathers_last_name,
            'mothers_last_name' => $mothers_last_name,
            'curp' => $curp,
            'sex_text' => $sex_text,
            'phone_number' => $phone_number,
            'state_id' => $state_id,
            'municipality_id' => $municipality_id,
            'locality_id' => $locality_id,
            'states' => $states,
            'career' => $career,
            'charge' => $charge
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->isExternalAdvisor()) {
            $user->externalAdvisor->update($request->validated());
        }

        if ($user->isTeacher()) {
            $user->teacher->update($request->validated());
        }



        return redirect()->route('profile')->with('alert', [
            'type' => 'success',
            'message' => 'La información se actualizo correctamente',
        ]);
    }
}
