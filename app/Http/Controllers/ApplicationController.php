<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Application::create($request->all());
        $user = auth()->user();

        // Создаем новую заявку и привязываем ее к текущему пользователю
        $user->applications()->create($request->all());

        return redirect()->route('applications.index')
            ->with('success', 'Application created successfully.');
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $application = Application::findOrFail($id);
        $application->update($request->all());

        return redirect()->route('applications.index')
            ->with('success', 'Application updated successfully.');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
