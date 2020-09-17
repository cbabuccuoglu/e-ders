@extends('layout.master')

@section('title','Veliler')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('guardian.create')}}">Veli Tanımla</a>
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('import.guardian')}}">Velileri İçeri Aktar</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Veliler</h5>
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
                            <form action="{{route('guardian.index')}}" method="GET">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Veli İsmi Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Hangi Öğrencinin Velisi</label>
                                        {!! Form::select('user_id', $lesson, NULL, ['placeholder' => 'Öğrenci Seçiniz', 'class' => 'form-control select2']) !!}

                                    </div>

                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('guardian.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Veli Adı</th>
                                <th>Öğrenci Adı</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guardians AS $guardian)

                            <tr>
                                <td>{{$guardian->id ?? '1'}}</td>
                                <td>{{$guardian->name}}</td>
                                <td>{{$guardian->student->name ?? ''}}</td>

                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('guardian.edit',$guardian->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Veli Düzenle</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$guardiancount}}</b>



@endsection
