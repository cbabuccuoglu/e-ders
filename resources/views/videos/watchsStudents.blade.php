@extends('layout.master')

@section('title',$videos->name.' Raporları')

@section('content')

    <div class="content">
                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{$videos->name}} Raporları</h5>
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
                                <th>İzleyen Öğrenci</th>
                                <th>İzleme Süresi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videosWatchs AS $videosWatch)
                            <tr>
                                <td>{{$videosWatch->id ?? '1'}}</td>
                                <td>{{$videosWatch->videos->lesson->name}}</td>
                                <td>{{$videosWatch->videos->classNumber}}.Sınıf</td>
                                <td>{{$videosWatch->videos->name}}</td>
                                <td>{{$videosWatch->videos->teacher->name}}</td>
                                <td>{{$videosWatch->student->name}}</td>
                                <td>{{$videosWatch->minute}}</td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>






@endsection
