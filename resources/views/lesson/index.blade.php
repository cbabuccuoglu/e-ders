@extends('layout.master')

@section('title','Dersler')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('lesson.create')}}">Ders Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Dersler</h5>
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
                            <form action="{{route('lesson.index')}}" method="GET">

                                <div class="row">


                                    <div class="form-group col-md-3">
                                        <label>Ders İsmi Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>


                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('lesson.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ders Adı</th>
                                <th>Soru Sayısı</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lessons AS $lesson)
                                @php
                                    $lessonsay=\App\ExamQuestion::where('lesson_id',$lesson->id)->count();
                                @endphp
                            <tr>
                                <td>{{$lesson->id ?? '1'}}</td>
                                <td>{{$lesson->name}}</td>
                                <td>{{$lessonsay}}</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('lesson.edit',$lesson->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Dersi Düzenle</a>
                                                <a href="{{route('lesson.show',$lesson->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Kazanımlarını İçeri Aktar</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$lessoncount}}</b>



@endsection
