<?php

namespace App\Imports;

use App\DataTraining;
use Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataTrainingsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataTraining([
            'tanggal'  => Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal'])),
            'hari'     => $row['hari'], 
            'cuaca'    => $row['cuaca'],
            'terjual'  => $row['terjual'],
        ]);
    }
}
