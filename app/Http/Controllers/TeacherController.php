<?php

namespace App\Http\Controllers;

use App\Gains;
use Illuminate\Http\Request;
use App\User;
use App\Lesson;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->get('name')!='' || $request->get('units')!='' || $request->get('lesson_id')!='' || $request->get('classNumber')!=''){
            $teachers = New User;
            if($request->get('name')!=''){
                $teachers = $teachers->where('name','LIKE','%'.$request->get('name').'%');
            }

            if($request->get('lesson_id')!=''){
                $teachers = $teachers->where('lesson_id',$request->get('lesson_id'));
            }

            $teachers=$teachers->where('type', 1)->orderBy('name', 'asc')->get();

        }else {
            $teachers = User::where('type', 1)->orderBy('name', 'asc')->paginate(25);
        }
            $lesson=Lesson::orderBy('name','asc')->pluck('name','id');
            $teachercount=$teachers->count();

            return view('teacher.index', compact(['teachers','teachercount','lesson']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson=Lesson::orderBy('name','asc')->pluck('name','id');
        return view('teacher.create', compact(['lesson']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $id = User::create($request->all())->id;
          $update=User::where('id',$id)->update(['password' => bcrypt($request->get('password'))]);
            if ($id > 0 ) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Başarılı');
                return redirect()->route('teacher.index');
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
      $teacher = User::find($id);
        $lesson=Lesson::orderBy('name','asc')->pluck('name','id');

        return view('teacher.edit', compact(['teacher','lesson']));
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
         $update = User::find($id)->update(['name'=>$request->get('name'),'email'=>$request->get('email'),'username' => $request->get('username'), 'lesson_id' => $request->get('lesson_id')]);
         if($request->get('password')!=null){
            if($request->get('password')!=''){
              $updatepassword=User::where('id',$id)->update(['password' => bcrypt($request->get('password'))]);
            }

         }
            if ($update) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
                return redirect()->route('teacher.index');
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
          $delete = User::find($id)->delete();
            if ($delete) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Silindi');
            } else {
                notify()->error('Maalesef Hata Oluştu','Silme Başarısız');
            }
            return redirect()->route('teacher.index');
    }
}
