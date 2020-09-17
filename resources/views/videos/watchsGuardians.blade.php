@extends('layout.master')

@section('title',Auth::user()->student->class->number.'.Sınıfa Ait Videolar')

@section('content')

    <div class="content">
                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{Auth::user()->student->class->number}}.Sınıfa Ait Videoları</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>


                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ders</th>
                                <th>Sınıf</th>
                                <th>Video İsmi</th>
                                <th>Ekleyen Öğretmen</th>
                                <th>Öğrencimin İzleme Süresi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos AS $video)
                                @php
                                $whatccount=\App\VideosWatch::where('videos_id',$video->id)->where('student_id',Auth::user()->user_id)->count();
                                @endphp
                            <tr>
                                <td>{{$video->id ?? '1'}}</td>
                                <td>{{$video->lesson->name}}</td>
                                <td>{{$video->classNumber}}.Sınıf</td>
                                <td>{{$video->name}}</td>
                                <td>{{$video->teacher->name}}</td>
                                @if($whatccount==0)
                                <td>0 Dakika</td>

                                @else
                                    @php
                                        $whatc=\App\VideosWatch::where('videos_id',$video->id)->where('student_id',Auth::user()->user_id)->first();
                                    @endphp
                                <td>{{$whatc->minute ?? '0'}} Dakika</td>

                                @endif
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>






@endsection
