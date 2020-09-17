<?php

namespace App\Http\Controllers;

use App\Gains;
use App\Lesson;
use App\TrialExam;
use App\User;
use Illuminate\Http\Request;

class TrialExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('name')!='' || $request->get('type')!='' || $request->get('classNumber')!=''){
            $trialexams = New TrialExam;
            if($request->get('name')!=''){
                $trialexams = $trialexams->where('name','LIKE','%'.$request->get('name').'%');
            }

            if($request->get('type')!=''){
                $trialexams = $trialexams->where('type',$request->get('type'));
            }

            if($request->get('classNumber')!=''){
                $trialexams = $trialexams->where('classNumber',$request->get('classNumber'));
            }

            $trialexams=$trialexams->orderBy('name', 'asc')->get();

        }else {
            $trialexams = TrialExam::orderBy('name', 'asc')->paginate(25);
        }
        $trialexamscount=$trialexams->count();

        return view('trialexam.index', compact(['trialexams','trialexamscount']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trialexam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        $input['start_date']=str_replace('T',' ',$input['start_date']);
        $input['finish_date']=str_replace('T',' ',$input['finish_date']);
        $create = TrialExam::create($input);
        if ($create) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Başarılı');
            return redirect()->route('trialexam.index');

        } else {
            notify()->error('Maalesef Hata Oluştu','Kayıt Başarısız');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trialexam = TrialExam::find($id);
        return view('trialexam.edit', compact(['trialexam']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input=$request->all();
        $input['start_date']=str_replace('T',' ',$input['start_date']);
        $input['finish_date']=str_replace('T',' ',$input['finish_date']);
        $update = TrialExam::find($id)->update($input);
        if ($update) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
            return redirect()->route('trialexam.index');
        } else {
            notify()->error('Maalesef Hata Oluştu','Düzenleme Başarısız');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = TrialExam::find($id)->delete();
        if ($delete) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Silindi');
        } else {
            notify()->error('Maalesef Hata Oluştu','Silme Başarısız');
        }
        return redirect()->route('trialexam.index');
    }
}
