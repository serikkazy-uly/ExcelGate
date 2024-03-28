<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\ExportUser;
use App\Exports\UserExport;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->has('filter')) {
            $filter = $request->input('filter');

            if (isset($filter['name'])) {
                $users->where('name', 'like', '%' . $filter['name'] . '%');
            }

            if (isset($filter['email'])) {
                $users->where('email', 'like', '%' . $filter['email'] . '%');
            }
        }

        $users = $users->get();

        return view('users.index', compact('users'));
    }
    public function create(Request $request)
    {
        return view('users.create');
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = auth()->user();

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->users()->create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
    public function importView(Request $request)
    {
        return view('importUser');
    }

    public function import(Request $request)
    {
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportUsers(Request $request)
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }
}
