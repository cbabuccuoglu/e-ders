@extends('layout.master')

@section('title','Sınıflar')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('class.create')}}">Sınıf Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Sınıflar</h5>
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
                            <form action="{{route('class.index')}}" method="GET">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Sınıf Seçiniz:</label>
                                        <select name="number"  class="form-control" >
                                            <option value="">Sınıf Seçiniz</option>
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{$i}}">{{$i}}.Sınıf </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Sınıf Şubesi Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>


                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('class.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sınıf</th>
                                <th>Şube</th>
                                <th>Öğrenci Sayısı</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($class AS $class)
                                @php
                                    $studentsay=\App\User::where('class_id',$class->id)->count();

                                @endphp
                            <tr>
                                <td>{{$class->id ?? '1'}}</td>
                                <td>{{$class->number ?? ''}}.Sınf</td>
                                <td>{{$class->name ?? ''}}</td>
                                <td>{{$studentsay ?? ''}}</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('class.edit',$class->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Sınıfı Düzenle</a>
                                                <a href="{{route('student.index')}}?id={{$class->id ?? '1'}}" class="dropdown-item"><i class="icon-users4"></i>Öğrencileri Görüntüle</a>
                                                <a href="{{route('list.class.answerresult',$class->id)}}" class="dropdown-item"><i class="icon-stats-bars2"></i>Sınav Sonuçlarını Görüntüle</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$classcount}}</b>



@endsection
