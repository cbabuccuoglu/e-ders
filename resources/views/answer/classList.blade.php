@extends('layout.master')

@section('title','Sınav Sonuçları')

@section('content')

    <div class="content">

        
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
                                <th>Detay</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($answerss AS $answer)

                            <tr>
                                <td>{{$answer->user->class->number ?? ''}}.Sınıf / {{$answer->user->class->name ?? ''}}</td>
                                <td>{{$answer->trialexam->name ?? ''}}</td>
                               

                                <td>{{$answer->user->name ?? ''}}</td>
                                <td>{{$answer->net ?? ''}}</td>
                                @if(isset($answer->trialexam->trial_type))
                                @if($answer->trialexam->trial_type==1)
                                    <td>{{$answer->point}}</td>
                                @elseif($answer->trialexam->trial_type==2)
                                    <td>{{$answer->tytpuan}}</td>
                                @else
                                    <td>Sözel :  {{$answer->aytsozel}} - Eşit Ağırlık : {{$answer->aytesit}} - Sayısal : {{$answer->aytsayisal}}</td>
                                @endif
                                 @endif
                                <td> <a href="{{route('view.answerresult',$answer->id)}}" target="_blank" class="btn btn bg-teal"> Sınav Sonucunu Görüntüle</a></td>


                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>






@endsection
