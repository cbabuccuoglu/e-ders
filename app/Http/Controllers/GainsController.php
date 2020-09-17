<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Imports\GainsImport;
use Illuminate\Http\Request;
use App\Gains;
use App\Lesson;
use Maatwebsite\Excel\Facades\Excel;

class GainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->get('name')!='' || $request->get('units')!='' || $request->get('lesson_id')!='' || $request->get('classNumber')!=''){
            $gains = New Gains;
        if($request->get('name')!=''){
            $gains = $gains->where('name','LIKE','%'.$request->get('name').'%');
        }

        if($request->get('units')!=''){
            $gains = $gains->where('units','LIKE','%'.$request->get('units').'%');
        }

        if($request->get('lesson_id')!=''){
            $gains = $gains->where('lesson_id',$request->get('lesson_id'));
        }

        if($request->get('classNumber')!=''){
            $gains = $gains->where('classNumber',$request->get('classNumber'));
        }
            $gains=$gains->get();
        }else {
        $gains = Gains::orderBy('units', 'asc')->get();
        }

        $lesson=Lesson::orderBy('name','asc')->pluck('name','id');
        $gainscount=$gains->count();

            return view('gains.index', compact(['gains','gainscount','lesson']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $lesson=Lesson::orderBy('name','asc')->pluck('name','id');
        return view('gains.create', compact(['lesson']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $create = Gains::create($request->all());
        if ($create) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Başarılı');
                return redirect()->route('gains.index');

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
        $gains = Gains::find($id);
        $lesson=Lesson::orderBy('name','asc')->pluck('name','id');

        return view('gains.edit', compact(['gains','lesson']));
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
        $update = Gains::find($id)->update($request->all());
        if ($update) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
            return redirect()->route('gains.index');
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
        $delete = Gains::find($id)->delete();
        if ($delete) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Silindi');
        } else {
            notify()->error('Maalesef Hata Oluştu','Silme Başarısız');
        }
        return redirect()->route('gains.index');
    }

    function getIdByGains(Request $request){

        $id=$request->get("id");
        $names = Gains::orderBy('units','asc')->where('lesson_id',$id)->get();
        $selectform="";
        $selectform.=' <label>Kazanım Seçiniz:</label>';
        $selectform.='<select class="form-control select2" required name="gains_id">';
        $selectform.=' <option value="">Lütfen Kazanım Seçiniz</option>';
        foreach ($names as $value) {
            $selectform.='<option value="'.$value->id.'">'.$value->classNumber.'.Sınıf > '.$value->lesson->name.' > '.$value->units.' > '.$value->name.'</option>';
        }
        $selectform.='</select>';
        return $selectform;
    }

    function gainsimported(Request $request)
    {
        Excel::import(new GainsImport,request()->file('file'));
        notify()->success('İşleminiz başarıyla gerçekleşti','Veriler İçeri Aktarıldı');
        return redirect()->route('gains.index');
    }

}
