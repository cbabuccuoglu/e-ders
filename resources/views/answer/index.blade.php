@extends('layout.master')

@section('title','Bekleyen Sınavlar')

@section('content')

    <div class="content">
                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Bekleyen Sınavları [LÜTFEN SINAV SAATİ SAYFAYI YENİLEYİNİZ]</h5>
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
                                <th>Sınıf</th>
                                <th>Sınav Türü</th>
                                <th>Sınav İsmi</th>
                                <th>Toplam Soru Sayısı</th>
                                <th>Sınav </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($answers AS $answer)
                                @php
                                    $sorusorgula=\App\ExamQuestion::where('trialexam_id',$answer->id)->count();
                                    $sinavdurum=\App\Answer::where('trialexam_id',$answer->id)->where('user_id',Auth::user()->id)->orderBy('net','desc')->count();
                                    if($sinavdurum>=1){
                                      $sinav=\App\Answer::where('trialexam_id',$answer->id)->where('user_id',Auth::user()->id)->orderBy('net','desc')->first();
                                    }
                                @endphp
                            <tr>
                                <td>{{$answer->classNumber}}.Sınıf</td>
                                <td>@if($answer->type==1){{"Online Deneme Sınavı"}} @else {{"Deneme Sınavı"}} @endif</td>
                                <td>{{$answer->name}}</td>
                                <td>{{$sorusorgula}}</td>
                                <td>

                                            @if($sinavdurum>=1)
                                                @if($sinav->type==1)
                                                    @if($sinav->trialexam->resulttype==2)
                                                        <a href="{{route('view.answerresult',$sinav->id)}}" class="btn btn bg-teal"> Sınav Sonucunu Görüntüler</a>
                                                    @else Sınav Tamamlandı. Henüz Sonuçlar Açıklanmadı@endif
                                                @else
                                            @if($answer->finish_date <= date('Y-m-d H:i'))
                                                <a href="#" class="btn btn bg-teal">Sınav Süresi Doldu. Henüz Sonuçlar Açıklanmadı.</a>
                                            @else
                                            <a href="{{route('answer.show',$sinav->id)}}" class="btn btn bg-teal">Sınava Devam Et</a>
                                            @endif
                                        @endif
                                            @else
                                        @if($answer->start_date > date('Y-m-d H:i'))
                                            <a href="#" class="btn btn bg-teal">Henüz Sınava Giriş Yapamazsınız.</a>
                                        @else
                                            @if($answer->finish_date <= date('Y-m-d H:i'))
                                                <a href="#" class="btn btn bg-teal">Sınav Süresi Doldu.</a>
                                            @else
                                        <a href="{{route('answer.create')}}?id={{$answer->id}}" class="btn btn bg-teal">Sınava Başla</a>
                                            @endif
                                        @endif
                                    @endif

                                </td>


                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>






@endsection
