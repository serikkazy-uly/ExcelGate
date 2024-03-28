<?php

namespace App\Exports;

use App\Http\Controllers\ApplicationController;
use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;

// class ApplicationsExport implements FromView
class ApplicationsExport implements FromCollection
{
    public function collection()
    {
        return Application::all();
    }

    // public function view(): View
    // {
    //     return view('applications.export', [
    //         'applications' => Application::all()
    //     ]);
    // }
}
