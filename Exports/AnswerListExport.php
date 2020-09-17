<?php

namespace App\Exports;

use App\Models\Transport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AnswerListExport implements FromView
{
    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function view(): View
    {
        return view('answer.listtable', [
            'answers' => $this->model
        ]);
    }
}
