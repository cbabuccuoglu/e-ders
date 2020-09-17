<?php

namespace App\Http\Controllers;

use App\ExamQuestion;
use App\Gains;
use App\Lesson;
use App\TrialExam;
use App\User;
use Illuminate\Http\Request;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('lesson_id')!=''){
            $examquestions = New ExamQuestion;
            if($request->get('lesson_id')!=''){
                $examquestions = $examquestions->where('lesson_id',$request->get('lesson_id'));
            }
            $examquestions=$examquestions->where('trialexam_id', $request->get('id'))->orderBy('lesson_id', 'asc')->get();
        }else {
            $examquestions = ExamQuestion::where('trialexam_id', $request->get('id'))->orderBy('lesson_id', 'asc')->paginate(25);
        }
        $trialexam=TrialExam::where('id',$request->get('id'))->first();
        $lesson=Lesson::orderBy('name','asc')->pluck('name','id');
        $examquestioncount=$examquestions->count();

        return view('examquestion.index', compact(['examquestions','examquestioncount','trialexam','lesson']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson=Lesson::orderBy('name','asc')->pluck('name','id');
        $gains=Gains::orderBy('name','asc')->get();
        return view('examquestion.create', compact(['lesson','gains']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['image']);

        $createid = ExamQuestion::create($input)->id;
        $allowedfileExtension=['pdf','jpg','png','docx','pdf','xls','xlsx','pptx','jpeg','PNG','JPG','JPEG'];
        if (is_array($request->image) || is_object($request->image)) {



                $check=in_array($request->image->getClientOriginalExtension(),$allowedfileExtension);
                if($check) {
                    $filenameUpload = $request->image->getClientOriginalName();
                    $filename = md5($filenameUpload . time()) . "." . $request->image->getClientOriginalExtension();
                    $request->image->move(public_path() . '/upload/questions/', $filename);
                    $duzenle=ExamQuestion::where('id',$createid)->update(['image'=>$filename]);
                }else{
                    notify()->error('Eser Düzenlendi Lakin Yüklemeye çalıştığınız dosya izin verilen dosya türü değildir.');
                    return redirect()->back();
                }

        }

        if ($createid > 0 ) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Başarılı');
            return redirect()->back();

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
        $examquestion = ExamQuestion::find($id);
        $lesson=Lesson::orderBy('name','asc')->pluck('name','id');
        $gains=Gains::orderBy('name','asc')->get();
        return view('examquestion.edit', compact(['examquestion','lesson','gains']));
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
        $input = $request->all();
        unset($input['image']);
        $update = ExamQuestion::find($id)->update($input);
        $allowedfileExtension=['pdf','jpg','png','docx','pdf','xls','xlsx','pptx','jpeg','PNG','JPG','JPEG'];
        if (is_array($request->image) || is_object($request->image)) {

            $check=in_array($request->image->getClientOriginalExtension(),$allowedfileExtension);
            if($check) {
                $filenameUpload = $request->image->getClientOriginalName();
                $filename = md5($filenameUpload . time()) . "." . $request->image->getClientOriginalExtension();
                $request->image->move(public_path() . '/upload/questions/', $filename);
                $duzenle=ExamQuestion::where('id',$id)->update(['image'=>$filename]);
            }else{
                notify()->error('Eser Düzenlendi Lakin Yüklemeye çalıştığınız dosya izin verilen dosya türü değildir.');
                return redirect()->back();
            }

        }
        if ($update) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
            return redirect()->back();
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
        $delete = ExamQuestion::find($id)->delete();
        if ($delete) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Silindi');
        } else {
            notify()->error('Maalesef Hata Oluştu','Silme Başarısız');
        }
        return redirect()->back();
    }
}
