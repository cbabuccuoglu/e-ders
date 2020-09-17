@extends('layout.master')

@section('title','Bekleyen Sınavlar')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Bekleyen Sınavlar</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                            {{ Form::model($trialexam, array('route' => array('trialexam.update', $trialexam->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                        @csrf

                                <div class="form-group">
                                    <label>Deneme Sınavı Türü:</label>
                                    <select name="type" required class="form-control" >
                                        <option value="">Sınav Türünü Seçiniz </option>
                                        <option value="1" @if($trialexam->type=1) selected @endif>Online Deneme Sınavı </option>
                                        <option value="2" @if($trialexam->type=2) selected @endif>Deneme Sınavı </option>
                                    </select>
                                </div>
                                     <div class="form-group">
                                        <label>Sınıf Seçiniz:</label>
                                        <select name="classNumber"  class="form-control" >
                                        @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}" @if($trialexam->classNumber==$i) selected @endif>{{$i}}.Sınıf </option>
                                        @endfor
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <label>Deneme Sınavı İsmi:</label>
                                    <input type="text" class="form-control" name="name"  placeholder="Lütfen Deneme Sınavı Giriniz"  value="{{$trialexam->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Deneme Sınavı Baz Puan:</label>
                                    <input type="text" class="form-control" name="startpoint" placeholder="Lütfen Baz Puan Giriniz (Örn:182.500)"  value="{{$trialexam->startpoint}}">
                                </div>
                                <div class="form-group">
                                    <label>Doğru Yanlış Türü:</label>
                                    <select name="dyType" class="form-control" required >
                                        <option value="">Doğru Yanlış Türünü Seçiniz </option>
                                        <option value="1" @if($trialexam->dyType=1) selected @endif>4 Yanlış 1 Doğruyu Götürsün</option>
                                        <option value="2" @if($trialexam->dyType=2) selected @endif>3 Yanlış 1 Doğruyu Götürsün</option>
                                        <option value="3" @if($trialexam->dyType=3) selected @endif>Yanlışlar Doğruları Götürmesin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Öğrenciler Sonuçları Görsün mü?</label>
                                    <select name="resulttype" class="form-control" required >
                                        <option value="">Lütfen Seçiniz </option>
                                        <option value="1"  @if($trialexam->resulttype=1) selected @endif>Görmesin</option>
                                        <option value="2"  @if($trialexam->resulttype=2) selected @endif>Görsün</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sınav Başlangıç Zamanı</label>
                                    <input type="datetime-local" class="form-control" name="start_date" value="{{$trialexam->start_date}}">
                                </div>

                                <div class="form-group">
                                    <label>Sınav Bitiş Zamanı</label>
                                    <input type="datetime-local" class="form-control" name="finish_date" value="{{$trialexam->finish_date}}">
                                </div>

                                <div class="d-flex justify-content-start align-items-center" style="float: right">
                                    <button type="submit" class="btn bg-blue ml-3">Kaydet <i class="icon-paperplane ml-2"></i></button>
                                </div>
                        {{Form::close()}}
                        {{ Form::open(['route' => ['trialexam.destroy', $trialexam->id], 'method' => 'delete']) }}
                        <div class="pull-left">
                            <button type="submit" class="btn btn-danger"> <i class="icon-trash  mr-2"></i> Sil</button>
                        </div>
                            {{Form::close()}}
                             </div>
                        </div>
                <!-- /form horizontal -->

            </div>
        </div>
        <!-- /dashboard content -->


        @section('css')
            {{Html::style('select2/select2.min.css')}}
        @stop
        @section('js')
            {{ Html::script('select2/select2.min.js') }}

            <script>
                $(document).ready(function() {
                    $('.select2').select2();
                });
            </script>
@stop
@endsection
