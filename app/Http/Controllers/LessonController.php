<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Gains;
use Illuminate\Http\Request;
use App\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('name')!=''){
        $lessons = New Lesson;
        if($request->get('name')!=''){
            $lessons = $lessons->where('name','LIKE','%'.$request->get('name').'%');
        }
        $lessons=$lessons->get();
        }else{
            $lessons = Lesson::orderBy('name', 'asc')->paginate(25);
        }
        $lessoncount=$lessons->count();

            return view('lesson.index', compact(['lessons','lessoncount']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           return view('lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = Lesson::create($request->all());
        if ($create) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Başarılı');
                return redirect()->route('lesson.index');

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
        return view('lesson.import');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $lesson = Lesson::find($id);
        return view('lesson.edit', compact(['lesson']));
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
       $update = Lesson::find($id)->update($request->all());
            if ($update) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
                return redirect()->route('lesson.index');
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
         $delete = Lesson::find($id)->delete();
            if ($delete) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Silindi');
            } else {
                notify()->error('Maalesef Hata Oluştu','Silme Başarısız');
            }
            return redirect()->route('lesson.index');
    }
    function getIdByPoints(Request $request){
        $id=$request->get("id");
        $names = Lesson::where('id',$id)->first();
        return $names->point;
    }
}
