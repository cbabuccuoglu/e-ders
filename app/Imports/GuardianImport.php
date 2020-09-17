<?php

namespace App\Imports;

use App\Classes;
use App\User;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class GuardianImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $i=0;
        foreach ($rows as $row)
        {
            if($i>=1){

                $classescount=User::where('tcno',$row[1])->count();
                if($classescount > 0) {
                    $classes=User::where('tcno',$row[1])->first();

                    User::create([
                        'name' => $row[2],
                        'tcno' => $row[0],
                        'type' => '3',
                        'password' => bcrypt($row[0]),
                        'user_id' => $classes->id,
                    ]);
                }
            }

            $i=$i+1;

        }
    }
}
