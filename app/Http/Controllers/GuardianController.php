<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use Illuminate\Http\Request;
use App\Imports\GuardianImport;
use Maatwebsite\Excel\Facades\Excel;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('name')!='' || $request->get('units')!='' || $request->get('lesson_id')!='' || $request->get('classNumber')!=''){
            $guardians = New User;
            if($request->get('name')!=''){
                $guardians = $guardians->where('name','LIKE','%'.$request->get('name').'%');
            }

            if($request->get('user_id')!=''){
                $guardians = $guardians->where('user_id',$request->get('user_id'));
            }

            $guardians=$guardians->where('type', 3)->orderBy('name', 'asc')->get();

        }else {
            $guardians = User::where('type', 3)->orderBy('name', 'asc')->paginate(25);
        }
        $lesson=User::where('type',2)->orderBy('name','asc')->pluck('name','id');
        $guardiancount=$guardians->count();

        return view('guardian.index', compact(['guardians','guardiancount','lesson']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson=User::where('type',2)->orderBy('name','asc')->pluck('name','id');
        return view('guardian.create', compact(['lesson']));
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
            return redirect()->route('guardian.index');
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
        $lesson=User::where('type',2)->orderBy('name','asc')->pluck('name','id');

        return view('guardian.edit', compact(['teacher','lesson']));
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
            return redirect()->route('guardian.index');
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
        return redirect()->route('guardian.index');
    }

       function guardianimport()
    {
        return view('guardian.import');
    }

    function guardianimported(Request $request)
    {

        Excel::import(new GuardianImport,request()->file('file'));
        notify()->success('İşleminiz başarıyla gerçekleşti','Veriler İçeri Aktarıldı');
        return redirect()->route('guardian.index');
    }
}
