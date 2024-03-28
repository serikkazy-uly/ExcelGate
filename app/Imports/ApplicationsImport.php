<?php

namespace App\Imports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\ToModel;

class ApplicationsImport implements ToModel
{

    public function model(array $row)
    {
        return new Application([
            'title'       => $row['title'],
            'description' => $row['description'],
        ]);
    }
}
