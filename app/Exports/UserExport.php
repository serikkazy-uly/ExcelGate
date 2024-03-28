<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class UserExport implements FromView
class UserExport implements FromCollection
{

    public function collection()
    {
        // return User::all();
        return User::select('name', 'email')->get();
    }

    // public function view(): View
    // {
    //     return view('exports.users', [
    //         'users' => User::all()
    //     ]);
    // }
}
