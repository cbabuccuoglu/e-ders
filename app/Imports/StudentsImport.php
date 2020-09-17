<?php

namespace App\Imports;

use App\Classes;
use App\User;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $i=0;
        foreach ($rows as $row)
        {
            if($i>=1){

                $classescount=Classes::where('number',$row[2])->where('name',$row[3])->count();
                if($classescount > 0) {
                    $classes=Classes::where('number',$row[2])->where('name',$row[3])->first();

                    User::create([
                        'name' => $row[1],
                        'tcno' => $row[0],
                        'type' => '2',
                        'password' => bcrypt($row[0]),
                        'class_id' => $classes->id,
                    ]);
                }
            }

            $i=$i+1;

        }
    }
}
