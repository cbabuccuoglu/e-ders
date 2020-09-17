<?php

namespace App\Http\Controllers;

use App\Gains;
use App\Lesson;
use App\Videos;
use App\VideosWatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->get('name') != '' || $request->get('lesson_id') != '' || $request->get('classNumber') != '') {
            $videos = New Videos;
            if ($request->get('name') != '') {
                $videos = $videos->where('name', 'LIKE', '%' . $request->get('name') . '%');
            }

            if ($request->get('lesson_id') != '') {
                $videos = $videos->where('lesson_id', $request->get('lesson_id'));
            }

            if ($request->get('classNumber') != '') {
                $videos = $videos->where('classNumber', $request->get('classNumber'));
            }
            $videos = $videos->get();
        } else {
            $videos = Videos::orderBy('name', 'asc')->get();
        }

        $lesson = Lesson::orderBy('name', 'asc')->pluck('name', 'id');
        $videoscount = $videos->count();

        return view('videos.index', compact(['videos', 'videoscount', 'lesson']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson = Lesson::orderBy('name', 'asc')->pluck('name', 'id');
        return view('videos.create', compact(['lesson']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = Videos::create($request->all());
        if ($create) {
            notify()->success('İşleminiz başarıyla gerçekleşti', 'Kayıt Başarılı');
            return redirect()->route('videos.index');

        } else {
            notify()->error('Maalesef Hata Oluştu', 'Kayıt Başarısız');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos = Videos::find($id);
        $lesson = Lesson::orderBy('name', 'asc')->pluck('name', 'id');

        return view('videos.edit', compact(['videos', 'lesson']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Videos::find($id)->update($request->all());
        if ($update) {
            notify()->success('İşleminiz başarıyla gerçekleşti', 'Kayıt Düzenlendi');
            return redirect()->route('videos.index');
        } else {
            notify()->error('Maalesef Hata Oluştu', 'Düzenleme Başarısız');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Videos::find($id)->delete();
        if ($delete) {
            notify()->success('İşleminiz başarıyla gerçekleşti', 'Kayıt Silindi');
        } else {
            notify()->error('Maalesef Hata Oluştu', 'Silme Başarısız');
        }
        return redirect()->route('videos.index');
    }

    function watchvideos($id)
    {
        $videos = Videos::where('classNumber', Auth::user()->class->number)->where('lesson_id', $id)->get();
        $lesson = Lesson::where('id', $id)->first();
        return view('videos.watchs', compact(['videos', 'lesson']));
    }

    function watchvideosguardians()
    {
        $videos = Videos::where('classNumber', Auth::user()->student->class->number)->get();
        return view('videos.watchsGuardians', compact(['videos']));
    }

    function watchvideo($id)
    {
        $videos = Videos::where('id', $id)->first();
        return view('videos.watch', compact(['videos']));
    }

    function setVideosWatch(Request $request)
    {

        $id=$request->get("id");
        $saniye=$request->get("saniye");
        $sorgula=VideosWatch::where('videos_id',$id)->where('student_id',Auth::user()->id)->count();
        if($sorgula==0) {
            VideosWatch::create([
                'videos_id' => $id,
                'student_id' => Auth::user()->id,
                'minute' => round($saniye / 60),
            ]);
        }else{
            $getir=VideosWatch::where('videos_id',$id)->where('student_id',Auth::user()->id)->first();
            $minute=$getir->minute+round($saniye / 60);
            $duzenle=VideosWatch::where('videos_id',$id)->where('student_id',Auth::user()->id)->update(['minute'=>$minute]);
        }

    }

    function watchvideosstudent($id)
    {
        $videosWatchs=VideosWatch::where('videos_id',$id)->get();
        $videos = Videos::where('id', $id)->first();
        return view('videos.watchsStudents', compact(['videosWatchs','videos']));
    }
}
