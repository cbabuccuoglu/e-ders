@extends('layout.master')

@section('title','Sınav Sonuçları')

@section('content')

    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Sınav Ortalaması</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Toplam Katılan Öğrenci Sayısı</th>
                        <th>Ortalama Net</th>
                        <th>Ortalama Puan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$totalstudents}}</td>
                        <td>{{round($ortnet,2,2)}}</td>
                        <td>{{round($ortpuan,3,3)}}</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Sınav Sonuçları</h5>
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
                                <th>Sınıf / Şube</th>
                                <th>Sınav İsmi</th>
                                <th>Öğrenci</th>
                                <th>Net Sayısı</th>
                                <th>Puan</th>
                                <th>Detaylar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 

                            $user=array();

                             @endphp
                            @foreach($answers AS $answer)
                            @php 
                            array_push($user,$answer->user_id);
                            @endphp   
                             @if(in_array($answer->user_id, $user)) 
                            <tr>
                                <td>{{$answer->user->class->number ?? ''}}.Sınıf / {{$answer->user->class->name ?? ''}}</td>
                                <td>{{$answer->trialexam->name ?? ''}}</td>
                                <td>{{$answer->user->name ?? ''}}</td>
                                <td>{{$answer->net}}</td>
                                                               @if($answer->trialexam->trial_type==1)
                                    <td>{{$answer->point}}</td>
                                @elseif($answer->trialexam->trial_type==2)
                                    <td>{{$answer->tytpuan}}</td>
                                @else
                                    <td>Sözel :  {{$answer->aytsozel}} - Eşit Ağırlık : {{$answer->aytesit}} - Sayısal : {{$answer->aytsayisal}}</td>
                                @endif
                                <td> <a href="@if($answer->net>0){{route('view.answerresult',$answer->id)}}@else{{'#'}}@endif" @if($answer->net>0) target="_blank" @endif class="btn btn bg-teal"> Sınav Sonucunu Görüntüle</a></td>


                            </tr>
                            @endif
                        @endforeach
                      

                        </tbody>
                    </table>

                </div>






@endsection
