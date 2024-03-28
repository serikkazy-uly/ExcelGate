<?php

namespace App\Exports;

use App\Http\Controllers\ApplicationController;
use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
class ApplicationsExport implements FromCollection
{
    public function collection()
    {
        return Application::all();

        // return Application::chunk(1000, function ($applications) {
        //     foreach ($applications as $application) {
        //         yield $application;
        //     }
        // });
    }
}
