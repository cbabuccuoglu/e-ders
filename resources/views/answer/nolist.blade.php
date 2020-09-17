@extends('layout.master')

@section('title','Sınav Sonuçları')

@section('content')

    <div class="content">
        
                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Sınav Girmeyen Öğrenciler</h5>
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
                                <th>Öğrenci</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                         
                            @foreach($notstudent AS $answer)
                          
                            <tr>
                                <td>{{$answer ?? ''}}</td>
                               


                            </tr>
                        
                        @endforeach
                      

                        </tbody>
                    </table>

                </div>






@endsection
