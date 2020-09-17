@extends('layout.master')

@section('title','Duyurular')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('noice.create')}}">Duyuru Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Duyurular</h5>
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
                            <form action="{{route('noice.index')}}" method="GET">
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label>Duyuru Ara</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>


                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('noice.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Duyuru Tipi</th>
                                <th>Duyuru Başlık</th>
                                <th>Duyuru Açıklama</th>
                                <th>Duyuru Tarih</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($noices AS $noice)
                            <tr>
                                <td>{{$noice->id ?? '1'}}</td>
                                <td>@if($noice->type==1) Sadece Öğretmenlere @elseif($noice->type==2) Sadece Öğrencilere @elseif($noice->type==3) Sadece Velilere @elseif($noice->type==4) Bütün Herkese @else Kişiye Özel ({{$noice->user->name}}) @endif </td>
                                <td>{{$noice->name}}</td>
                                <td>{{$noice->description}}</td>
                                <td>{{$noice->created_at}}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('noice.edit',$noice->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Duyuru Düzenle</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$noicecount}}</b>



@endsection
