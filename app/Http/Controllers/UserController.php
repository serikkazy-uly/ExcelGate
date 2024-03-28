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
    public function importView(Request $request)
    {
        return view('importFile');
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
