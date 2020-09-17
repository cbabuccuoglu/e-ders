<?php

namespace App\Imports;

use App\Classes;
use App\Gains;
use App\Lesson;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class GainsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $i=0;
        foreach ($rows as $row)
        {

            if($i>=1){
                $lessoncount=Lesson::where('name',$row[0])->count();
                if($lessoncount > 0) {
                    $lesson=Lesson::where('name',$row[0])->first();

                    Gains::create([
                        'units' => $row[2],
                        'name' => $row[3],
                        'classNumber' => $row[1],
                        'lesson_id' => $lesson->id,
                    ]);
                }
            }

            $i=$i+1;

        }
    }
}
