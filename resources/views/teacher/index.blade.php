@extends('layout.master')

@section('title','Öğretmenler')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('teacher.create')}}">Öğretmen Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Öğretmenler</h5>
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
                            <form action="{{route('teacher.index')}}" method="GET">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Öğretmen İsmi Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Hangi Dersin Öğretmeni</label>
                                        {!! Form::select('lesson_id', $lesson, NULL, ['placeholder' => 'Ders Seçiniz', 'class' => 'form-control select2']) !!}

                                    </div>

                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('teacher.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Öğretmen Adı</th>
                                <th>Ders Adı</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers AS $teacher)

                            <tr>
                                <td>{{$teacher->id ?? '1'}}</td>
                                <td>{{$teacher->name}}</td>
                                <td>{{$teacher->lesson->name ?? ''}}</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('teacher.edit',$teacher->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Öğretmen Düzenle</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$teachercount}}</b>



@endsection
