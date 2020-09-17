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
                        <th>Toplam Katıldığı Sınav Sayısı</th>
                        <th>Ortalama Net</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$totalstudents}}</td>
                        <td>{{$ortnet}}</td>

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
                                <th>Sınav Türü</th>
                                <th>Öğrenci</th>
                                <th>Net Sayısı</th>
                                <th>Puan</th>
                                <th>Detaylar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($answers AS $answer)

                            <tr>
                                <td>{{$answer->user->class->number}}.Sınıf / {{$answer->user->class->name}}</td>
                                <td>{{$answer->trialexam->name ?? ''}}</td>
                                <td>@if($answer->trialexam->trial_type==1) Klasik Deneme Sınavı @elseif($answer->trialexam->trial_type==2) TYT Deneme Sınavı @else  AYT Deneme Sınavı @endif</td>
                                <td>{{$answer->user->name}}</td>
                                <td>{{$answer->net}}</td>
                                @if($answer->trialexam->trial_type==1)
                                    <td>{{$answer->point}}</td>
                                @elseif($answer->trialexam->trial_type==2)
                                    <td>{{$answer->tytpuan}}</td>
                                @else
                                    <td>Sözel :  {{$answer->aytsozel}} - Eşit Ağırlık : {{$answer->aytesit}} - Sayısal : {{$answer->aytsayisal}}</td>
                                @endif
                                <td> <a href="{{route('view.answerresult',$answer->id)}}" target="_blank" class="btn btn bg-teal"> Sınav Sonucunu Görüntüle</a>  <a href="{{route('list.student.answerresult',$answer->user->id)}}?type=1&answerId={{$answer->id}}" class="btn btn bg-teal"> Sınavı İptal Et</a>  <a href="{{route('list.student.answerresult',$answer->user->id)}}?type=2&answerId={{$answer->id}}"  class="btn btn bg-teal"> Sınava Devam Ettir</a></td>


                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>






@endsection
