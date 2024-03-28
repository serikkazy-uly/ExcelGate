<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Exports\ApplicationsExport;
use App\Imports\ApplicationsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    public function create(Request $request)
    {
        return view('applications.create');
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        // ]);
        // $user = auth()->user();

        // $user->applications()->create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        // ]);
        
        // return redirect()->route('applications.create')->with('success', 'Application created successfully.');
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $user = auth()->user();
        // Debugging messages
        // dd($request->all()); 
        // dd($user); 
        // dd($user->applications());

        $application = new Application([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        // $user->applications->save($application);
        $user->applications()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        // dd($user);
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

    // public function export()
    // {
    //     return Excel::download(new ApplicationsExport, 'applications.xlsx');
        
        // return new ApplicationsExport;

        // $export = new ApplicationsExport();
        // $fileName = 'applications.xlsx';
        // $export->store($fileName, 'public');
    
        // $filePath = storage_path('app/public/' . $fileName);
        // $headers = [
        //     'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        // ];
    
        // return new BinaryFileResponse($filePath, 200, $headers);
    // }
    public function fileImportExport()
    {
        return view('applications.file-import-export');
    }
   
    /**
     * Импортирует данные о заявках из файла Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx',
        ]);

        Excel::import(new ApplicationsImport, $request->file('file')->store('temp'));

        return back()->with('success', 'Applications imported successfully.');
    }


    public function export() 
    {
        return Excel::download(new ApplicationsExport, 'applications.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }    
}
