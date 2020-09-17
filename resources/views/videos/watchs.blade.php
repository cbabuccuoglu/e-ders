@extends('layout.master')

@section('title',Auth::user()->class->number.'.Sınıf '.$lesson->name.' Videoları')

@section('content')

    <div class="content">
                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{Auth::user()->class->number}}.Sınıf {{$lesson->name}} Videoları</h5>
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
                                <th>İzleme Sürem</th>
                                <th >İzleme</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos AS $video)
                                @php
                                $whatccount=\App\VideosWatch::where('videos_id',$video->id)->where('student_id',Auth::user()->id)->count();
                                @endphp
                            <tr>
                                <td>{{$video->id ?? '1'}}</td>
                                <td>{{$video->lesson->name}}</td>
                                <td>{{$video->classNumber}}.Sınıf</td>
                                <td>{{$video->name}}</td>
                                <td>{{$video->teacher->name}}</td>
                                @if($whatccount==0)
                                <td>0 Dakika</td>
                                <td><a href="{{route('watch.video',$video->id)}}" class="btn btn bg-teal">İzlemeye Başla</a><td>
                                @else
                                    @php
                                        $whatc=\App\VideosWatch::where('videos_id',$video->id)->where('student_id',Auth::user()->id)->first();
                                    @endphp
                                <td>{{$whatc->minute}} Dakika</td>
                                <td> <a href="{{route('watch.video',$video->id)}}" class="btn btn bg-teal">İzlemeye Devam Et</a><td>
                                @endif
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>






@endsection
