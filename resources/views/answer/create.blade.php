@extends('layout.master')

@section('title','Deneme Sınavı Tanımlama')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Deneme Sınavı Tanımla</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                        {{Form::open(['route'=>'trialexam.store' , 'method'=>'POST' , 'class' => 'form-horizontal'])}}
                        @csrf

                                <div class="form-group">
                                    <label>Deneme Sınavı Türü:</label>
                                    <select name="type" required class="form-control" >
                                        <option value="">Sınav Türünü Seçiniz </option>
                                        <option value="1">Online Deneme Sınavı </option>
                                        <option value="2">Deneme Sınavı </option>
                                    </select>
                                </div>
                                    <div class="form-group">
                                        <label>Sınıf Seçiniz:</label>
                                        <select name="classNumber"  class="form-control" >
                                        @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}">{{$i}}.Sınıf </option>
                                        @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Deneme Sınavı İsmi:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Lütfen Deneme Sınavı Giriniz" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Deneme Sınavı Baz Puan:</label>
                                        <input type="text" class="form-control" name="startpoint" placeholder="Lütfen Baz Puan Giriniz (Örn:182.500)" value="{{ old('startpoint') }}">
                                    </div>
                                <div class="form-group">
                                    <label>Doğru Yanlış Türü:</label>
                                    <select name="dyType" class="form-control" required >
                                        <option value="">Doğru Yanlış Türünü Seçiniz </option>
                                        <option value="1">4 Yanlış 1 Doğruyu Götürsün</option>
                                        <option value="2">3 Yanlış 1 Doğruyu Götürsün</option>
                                        <option value="3">Yanlışlar Doğruları Götürmesin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Öğrenciler Sonuçları Görsün mü?</label>
                                    <select name="resulttype" class="form-control" required >
                                        <option value="">Lütfen Seçiniz </option>
                                        <option value="1">Görmesin</option>
                                        <option value="2">Görsün</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sınav Başlangıç Zamanı</label>
                                    <input type="datetime-local" class="form-control" name="start_date" value="{{ old('startpoint') }}">
                                </div>

                                <div class="form-group">
                                    <label>Sınav Bitiş Zamanı</label>
                                    <input type="datetime-local" class="form-control" name="finish_date" value="{{ old('startpoint') }}">
                                </div>


                                    <div class="d-flex justify-content-start align-items-center" style="float: right">
                                        <button type="submit" class="btn bg-blue ml-3">Kaydet <i class="icon-paperplane ml-2"></i></button>
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
