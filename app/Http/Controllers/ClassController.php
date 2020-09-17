<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->get('name')!='' || $request->get('number')!=''){
            $class = New Classes;
            if($request->get('name')!=''){
                $class = $class->where('name','LIKE','%'.$request->get('name').'%');
            }
            if($request->get('number')!=''){
                $class = $class->where('number',$request->get('number'));
            }
            $class=$class->get();
        }else{
        $class = Classes::orderBy('name', 'asc')->paginate(25);
         }
        $classcount=$class->count();

            return view('class.index', compact(['class','classcount']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('class.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $create = Classes::create($request->all());
        if ($create) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Başarılı');
                return redirect()->route('class.index');

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
        $class = Classes::find($id);
        return view('class.edit', compact(['class']));

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
          $update = Classes::find($id)->update($request->all());
            if ($update) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
                return redirect()->route('class.index');
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
            $delete = Classes::find($id)->delete();
            if ($delete) {
                notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Silindi');
            } else {
                notify()->error('Maalesef Hata Oluştu','Silme Başarısız');
            }
            return redirect()->route('class.index');
    }
}
