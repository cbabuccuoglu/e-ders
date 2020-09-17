@extends('layout.master')

@section('title','Öğrenciler')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('student.create')}}">Öğrenci Tanımla</a>
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('import.student')}}">Excel İçeri Aktar</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Öğrenciler</h5>
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
                            <form action="{{route('student.index')}}" method="GET">

                                <div class="row">


                                    <div class="form-group col-md-3">
                                        <label>Öğrenci İsmi Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Sınıf Seçiniz:</label>
                                        <select name="class_id" class="form-control select2">
                                            <option value="">Sınıf Seçiniz</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->number}}.Sınıf - {{$class->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('student.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Öğrenci Adı</th>
                                <th>Öğrenci Sınıfı</th>
                                <th>Öğrenci Not Ortalaması</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students AS $student)
                                @php
                                    $ortnet=\App\Answer::where('user_id',$student->id)->avg('net');

                                @endphp
                            <tr>
                                <td>{{$student->id ?? '1'}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->class->number ?? ''}}. Sınıf - {{$student->class->name ?? ''}}</td>
                                <td>{{$ortnet}}</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('student.edit',$student->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Öğrenci Düzenle</a>
                                                <a href="{{route('list.student.answerresult',$student->id)}}" class="dropdown-item"><i class="icon-stats-bars2"></i>Öğrenci Raporlarını Görüntüle</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$studentcount}}</b>



@endsection
