<?php

namespace App\Exports;

use App\Http\Controllers\ApplicationController;
use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApplicationsExport implements FromCollection
{
    public function collection()
    {
        // return Application::all();
        $controller = new ApplicationController();
        $applications = $controller->index()->original['applications'];

        return $applications;
    }
}
