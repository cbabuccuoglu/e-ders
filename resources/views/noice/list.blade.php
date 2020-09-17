@extends('layout.master')

@section('title','Duyurular')

@section('content')

    <div class="content">
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
                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Duyuru Başlık</th>
                                <th>Duyuru Açıklama</th>
                                <th>Duyuru Tarih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($noices AS $noice)
                            <tr>
                                <td>{{$noice->id ?? '1'}}</td>
                                <td>{{$noice->name}}</td>
                                <td>{{$noice->description}}</td>
                                <td>{{$noice->created_at}}</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>




@endsection
