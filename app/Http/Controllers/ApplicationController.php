<?php

namespace App\Http\Controllers;

use App\Exports\ApplicationsExport;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = Application::query();

        if ($request->has('filter')) {
            $filter = $request->input('filter');

            if (isset($filter['title'])) {
                $applications->where('title', 'like', '%' . $filter['title'] . '%');
            }

            if (isset($filter['description'])) {
                $applications->where('description', 'like', '%' . $filter['description'] . '%');
            }
        }

        $applications = $applications->get();

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

        $application = new Application([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $user->applications()->save($application);

        return redirect()->route('applications.index')
            ->with('success', 'Application created successfully.');
    }


    public function show($id)
    {
        $application = Application::findOrFail($id);
        return view('applications.show', compact('application'));
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

    public function export()
    {
        return Excel::download(new ApplicationsExport, 'applications.xlsx');
    }
}
