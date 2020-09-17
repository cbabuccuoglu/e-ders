<?php

namespace App\Http\Controllers;

use App\AnswerItem;
use App\ExamQuestion;
use App\Models\JobsLogs;
use App\Models\Jobs;
use App\TrialExam;
use App\User;
use Illuminate\Http\Request;

use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total=array();
        $total['totaltrial']=0;
        $total['totalstudent']=0;
        $total['totalteacher']=0;
        $total['totalquestion']=0;
        $total['totalanswer']=0;
        $total['totalanswertrue']=0;
        $total['totalanswerany']=0;
        $total['totalanswerfalse']=0;

      

        return view('welcome', compact(['total']));
    }
}
