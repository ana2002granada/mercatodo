<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->paginate(2);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(User $user): View
    {
        return view('admin.users.update', compact('user'));
    }
}
