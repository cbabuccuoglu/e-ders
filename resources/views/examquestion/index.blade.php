@extends('layout.master')

@section('title',$trialexam->name.' Soruları')

@section('content')

    <div class="content">
        <a style="margin-bottom: 20px;" class="btn btn-primary" href="{{route('examquestion.create')}}?id={{request()->get('id') ?? ''}}">Soru Tanımla</a>

                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{$trialexam->name}} Soruları</h5>
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
                            <form action="{{route('examquestion.index')}}?id={{request()->get('id') ?? ''}}" method="GET">

                                <div class="row">


                                    <div class="form-group col-md-3">
                                        <label>Ders Seçiniz</label>
                                        {!! Form::select('lesson_id', $lesson, NULL, ['placeholder' => 'Ders Seçiniz', 'class' => 'form-control select2']) !!}

                                    </div>
                                    <input type="hidden" name="id" value="{{request()->get('id') ?? ''}}">


                                </div>


                                <div class="pull-right" style="float: right;">
                                    <button class="btn btn-primary">Göster</button>
                                    <a class="btn btn-success" href="{{route('examquestion.index')}}?id={{request()->get('id') ?? ''}}">Temizle</a>
                                </div>
                            </form>


                    </fieldset>
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Soru Sırası</th>
                                <th>Ders</th>
                                <th>Sınav Sorusu</th>
                                <th>Soru Cevabı</th>
                                <th>Soru Puanı</th>
                                <th>Soru Kazanımı</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examquestions AS $examquestion)

                            <tr>
                                <td>{{$examquestion->id ?? '1'}}</td>
                                <td>{{$examquestion->order}}</td>
                                <td>{{$examquestion->lesson->name ?? ''}}</td>
                                <td>@if($examquestion->questionstype==1)<a href="/upload/questions/{{$examquestion->image}}" data-fancybox="gallery"><img src="/upload/questions/{{$examquestion->image}}" style="width: 100px"></a>@else {{$examquestion->Wquestion}} @endif</td>
                                <td>{{$examquestion->trueresult}}</td>
                                <td>{{$examquestion->point}}</td>
                                <td>{{$examquestion->gains->units ?? ''}} > {{$examquestion->gains->name ?? ''}}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{route('examquestion.edit',$examquestion->id)}}" class="dropdown-item"><i class="icon-pencil7"></i>Soruyu Düzenle</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>


                         Toplam Bulunan Kayıt = <b>{{$examquestioncount}}</b>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

@endsection
