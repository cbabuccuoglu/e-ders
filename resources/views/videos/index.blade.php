@extends('layout.master')

@section('title','Videolar')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('videos.create')}}">Video Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Videolar</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <fieldset class="content-group">
                            <form action="{{route('videos.index')}}" method="GET">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Video İsmi Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Video Ders</label>
                                        {!! Form::select('lesson_id', $lesson, NULL, ['placeholder' => 'Ders Seçiniz', 'class' => 'form-control select2']) !!}

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Video Sınıf</label>
                                        <label>Sınıf Seçiniz:</label>
                                        <select name="classNumber"  class="form-control" >
                                            <option value="">Sınıf Seçiniz</option>
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{$i}}">{{$i}}.Sınıf </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('videos.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ders</th>
                                <th>Sınıf</th>
                                <th>Video İsmi</th>
                                <th>Ekleyen Öğretmen</th>
                                <th>İzlenme Sayısı</th>
                                <th>İzleyen Farklı Öğrenci Sayıları</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos AS $video)

                            <tr>
                                <td>{{$video->id ?? '1'}}</td>
                                <td>{{$video->lesson->name ?? ''}}</td>
                                <td>{{$video->classNumber ?? ''}}.Sınıf</td>
                                <td>{{$video->name}}</td>
                                <td>{{$video->teacher->name ?? ''}}</td>
                                <td>1</td>
                                <td>1</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('videos.edit',$video->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Video Düzenle</a>
                                                <a href="{{route('watch.videos.students',$video->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Video İzlenme İstatistikleri</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$videoscount}}</b>



@endsection
