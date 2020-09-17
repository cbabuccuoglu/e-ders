<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use App\User;
use App\Classes;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->get('name')!='' || $request->get('class_id')!='' || $request->get('id')!=''){
            $students = New User;
        if($request->get('name')!=''){
            $students = $students->where('name','LIKE','%'.$request->get('name').'%');
        }

        if($request->get('class_id')!=''){
            $students = $students->where('class_id',$request->get('class_id'));
        }
         if($request->get('id')!=''){
            $students = $students->where('class_id',$request->get('id'));
        }
            $students=$students->where('type', 2)->orderBy('name', 'asc')->paginate(25);
        }else {
        $students = User::where('type', 2)->orderBy('name', 'asc')->paginate(25);
        }
        $classes=Classes::orderBy('name','asc')->get();

        $studentcount=$students->count();

        return view('student.index', compact(['students','studentcount','classes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $classes=Classes::orderBy('name','asc')->get();
        return view('student.create', compact(['classes']));
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
                return redirect()->route('student.index');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::find($id);
          $classes=Classes::orderBy('name','asc')->get();

        return view('student.edit', compact(['student','classes']));
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
         $update = User::find($id)->update(['name'=>$request->get('name'),'email'=>$request->get('email'),'username' => $request->get('username'),'tcno' => $request->get('tcno'), 'class_id' => $request->get('class_id')]);
         if($request->get('password')!=null){
            if($request->get('password')!=''){
              $updatepassword=User::where('id',$id)->update(['password' => bcrypt($request->get('password'))]);
            }

         }
            if ($update) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
                return redirect()->route('student.index');
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
            return redirect()->route('student.index');
    }

    function studentimport()
    {
        return view('student.import');
    }

    function studentimported(Request $request)
    {

        Excel::import(new StudentsImport,request()->file('file'));
        notify()->success('İşleminiz başarıyla gerçekleşti','Veriler İçeri Aktarıldı');
        return redirect()->route('student.index');
    }
}
