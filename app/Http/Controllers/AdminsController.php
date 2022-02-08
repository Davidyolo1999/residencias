<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = User::query()
            ->with(['admin'])
            ->isAdmin()
            ->paginate();

        return view('admins.index', [
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(StoreAdminRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->userData());

            $user->admin()->create($request->adminData());

            DB::commit();
        } catch(Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('admins.index')->with('alert', [
            'type' => 'success',
            'message' => 'El administrador se agrego correctamente',
        ]);
    }
    
    public function destroy(Admin $admin)
    {
        User::destroy($admin->user_id);

        return redirect()->route('admins.index')->with('alert', [
            'type' => 'success',
            'message' => 'El administrador ha sido eliminado',
        ]);
    }
    
    public function edit(Admin $admin)
    {
        return view('admins.edit', [
            'admin' => $admin,
        ]);
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        DB::beginTransaction();
        
        try {
            $admin->update($request->adminData());

            $admin->user->update($request->userData());

            DB::commit();
        } catch(Throwable $t) {            
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('admins.index')->with('alert', [
            'type' => 'success',
            'message' => 'El administrador ha sido actualizado',
        ]);
    }

    public function updatePassword(Request $request, Admin $admin)
    {
        $request->validate(['password' => 'required|min:6|confirmed']);

        $admin->user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('teachers.index')->with('alert',[
            'type' => 'success',
            'message' =>'la contraseña ha sido actualizada',
        ]);
    }
}
