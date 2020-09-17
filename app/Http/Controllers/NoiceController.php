<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Noice;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('name')!=''){
            $noices = New Noice;
            if($request->get('name')!=''){
                $noices = $noices->where('name','LIKE','%'.$request->get('name').'%');
            }
            $noices=$noices->orderBy('id', 'desc')->get();
        }else{
            $noices = Noice::orderBy('id', 'desc')->paginate(25);
        }
        $noicecount=$noices->count();

        return view('noice.index', compact(['noices','noicecount']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons=User::where('type','!=',0)->orderBy('name','asc')->get();
        return view('noice.create', compact(['lessons']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = Noice::create($request->all());
        if ($create) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Başarılı');
            return redirect()->route('noice.index');

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
        $noice = Noice::find($id);
        $lessons=User::where('type','!=',0)->orderBy('name','asc')->get();
        return view('noice.edit', compact(['noice','lessons']));

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

        $update = Noice::find($id)->update($request->all());
        if ($update) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Düzenlendi');
            return redirect()->route('noice.index');
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
        $delete = Noice::find($id)->delete();
        if ($delete) {
            notify()->success('İşleminiz başarıyla gerçekleşti','Kayıt Silindi');
        } else {
            notify()->error('Maalesef Hata Oluştu','Silme Başarısız');
        }
        return redirect()->route('noice.index');
    }

    function lists(){
        $noices = New Noice;
        $noices=$noices->Where('type',Auth::user()->type)->orWhere('type',4)->orWhere('user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('noice.list', compact(['noices']));
    }
}
