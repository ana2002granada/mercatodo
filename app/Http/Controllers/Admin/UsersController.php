<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\FormUserRequest;
use App\Models\User;
use http\Env\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', User::class);
        $users = User::orderBy('name')->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $this->authorize('view', $user);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);
        return view('admin.users.edit', compact('user'));
    }
    public function update(FormUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->save();

        return response()->redirectToRoute('users.index');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return response()->redirectToRoute('users.index');
    }

    public function toggle(User $user)
    {
        $this->authorize('toggle', $user);
        $user->disabled_at = $user->disabled_at ? null : now();
        $user->save();
        return response()->redirectToRoute('users.index')->with('success', 'Acción realizada con exito');
    }
}
