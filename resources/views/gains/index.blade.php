@extends('layout.master')

@section('title','Kazanımlar')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('gains.create')}}">Kazanım Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Kazanımlar</h5>
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
                            <form action="{{route('gains.index')}}" method="GET">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Kazanım İsmi Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kazanım Ünitesi Ara</label>
                                        <input type="search" class="form-control" id="search" name="units">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kazanım Ders</label>
                                        {!! Form::select('lesson_id', $lesson, NULL, ['placeholder' => 'Ders Seçiniz', 'class' => 'form-control select2']) !!}

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Kazanım Sınıf</label>
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
                                    <a class="btn btn-success" href="{{route('gains.index')}}">Temizle</a>
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
                                <th>Kazanım Ünitesi</th>
                                <th>Kazanım İsmi</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gains AS $gain)

                            <tr>
                                <td>{{$gain->id ?? '1'}}</td>
                                <td>{{$gain->lesson->name ?? ''}}</td>
                                <td>{{$gain->classNumber}}.Sınıf</td>
                                <td>{{$gain->units}}</td>
                                <td>{{$gain->name}}</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('gains.edit',$gain->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Kazanımı Düzenle</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$gainscount}}</b>



@endsection
