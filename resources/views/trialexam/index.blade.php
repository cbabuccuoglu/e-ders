@extends('layout.master')

@section('title','Deneme Sınavları')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('trialexam.create')}}">Deneme Sınavı Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Deneme Sınavları</h5>
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
                            <form action="{{route('trialexam.index')}}" method="GET">

                                <div class="row">


                                    <div class="form-group col-md-3">
                                        <label>Deneme Sınav İsmi</label>
                                        <input type="search" class="form-control" id="search" name="name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Deneme Sınav Türü</label>
                                        <select name="type"  class="form-control" >
                                            <option value="">Sınav Türü Seçiniz</option>
                                            <option value="1">Online Deneme Sınavı </option>
                                            <option value="2">Deneme Sınavı </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
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
                                    <a class="btn btn-success" href="{{route('trialexam.index')}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sınav Türü</th>
                                <th>Deneme Sınav İsmi</th>
                                <th>Soru Sayısı</th>
                                <th>Sınıf</th>
                                <th>Deneme Sınavı Baz Puanı</th>
                                <th>Sınavı Tamamlayan Öğrenci</th>
                                <th>Ortalama Net</th>
                                <th>Sınav Başlangıç</th>
                                <th>Sınav Bitiş</th>
                                <th>Öğrenci Sonuç Gösterimi</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trialexams AS $trialexam)
                                @php
                                    $totalstudents=\App\Answer::where('trialexam_id',$trialexam->id)->count();
                                    $sorusayisi=\App\ExamQuestion::where('trialexam_id',$trialexam->id)->count();
                                    $ortnet=\App\Answer::where('trialexam_id',$trialexam->id)->avg('net');

                                @endphp
                            <tr>
                                <td>{{$trialexam->id ?? '1'}}</td>
                                <td>@if($trialexam->type==1){{"Online Deneme Sınavı"}} @else {{"Deneme Sınavı"}} @endif</td>
                                <td>{{$trialexam->name}}</td>
                                <td>{{$sorusayisi}}</td>
                                <td>{{$trialexam->classNumber}}.Sınıf</td>
                                <td>{{$trialexam->startpoint}} Baz Puan</td>
                                <td>{{$totalstudents}}</td>
                                <td>{{round($ortnet,2,2)}}</td>
                                <td>{{$trialexam->start_date}}</td>
                                <td>{{$trialexam->finish_date}}</td>
                                <td>@if($trialexam->resulttype==1){{"Gösterme"}} @else {{"Göster"}} @endif</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('trialexam.edit',$trialexam->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Deneme Sınavını Düzenle</a>
                                                <a href="{{route('copy.finish',$trialexam->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Deneme Sınavını Kopyala</a>
                                                <a href="{{route('examquestion.index')}}?id={{$trialexam->id ?? '1'}}" class="dropdown-item"><i class="icon-design"></i>Deneme Sınavı Soruları</a>
                                                <a href="{{route('list.noanswers',$trialexam->id)}}" class="dropdown-item"><i class="icon-design"></i>Deneme Sınavı Girmeyen Öğrenciler</a>
                                                <a href="{{route('list.answerresult',$trialexam->id)}}" class="dropdown-item"><i class="icon-stats-bars2"></i>Deneme Sınav Sonuçları</a>
                                                <a href="{{route('answer.finish',$trialexam->id)}}" class="dropdown-item"><i class="icon-stats-bars2"></i>Deneme Sınavını Sonuçlandır</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$trialexamscount}}</b>



@endsection
