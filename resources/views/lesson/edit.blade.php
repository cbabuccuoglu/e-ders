@extends('layout.master')

@section('title','Ders Düzenleme')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Ders Düzenleme İşlemleri</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                            {{ Form::model($lesson, array('route' => array('lesson.update', $lesson->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                        @csrf
                                    <div class="form-group">
                                        <label>Ders İsmi:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Lütfen Ders İsmini Giriniz" value="{{$lesson->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders TYT Ve Klasik Deneme Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="point" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{$lesson->point}}">
                                    </div>
                                    <div class="form-group">
                                        <label>AYT - TYT - YDT Ders Eşleştirme:</label>
                                        <select name="lesson_type"  class="form-control select2">
                                            <option value="İngilizce" @if($lesson->lesson_type=="İngilizce") selected @endif>İngilizce</option>
                                            <option value="Türk Dili ve Edebiyatı" @if($lesson->lesson_type=="Türk Dili ve Edebiyatı") selected @endif>Türk Dili ve Edebiyatı</option>
                                            <option value="Tarih-1" @if($lesson->lesson_type=="Tarih-1") selected @endif>Tarih-1</option>
                                            <option value="Coğrafya" @if($lesson->lesson_type=="Coğrafya") selected @endif>Coğrafya</option>
                                            <option value="Tarih-2" @if($lesson->lesson_type=="Tarih-2") selected @endif>Tarih-2</option>
                                            <option value="Coğrafya-2" @if($lesson->lesson_type=="Coğrafya-2") selected @endif>Coğrafya-2</option>
                                            <option value="Felsefe Grubu" @if($lesson->lesson_type=="Felsefe Grubu") selected @endif>Felsefe Grubu</option>
                                            <option value="Din Kültürü ve Ahlak B." @if($lesson->lesson_type=="Din Kültürü ve Ahlak B.") selected @endif>Din Kültürü ve Ahlak B.</option>
                                            <option value="Matematik" @if($lesson->lesson_type=="Matematik") selected @endif>AYT - Matematik</option>
                                            <option value="Fizik" @if($lesson->lesson_type=="Fizik") selected @endif>Fizik</option>
                                            <option value="Kimya" @if($lesson->lesson_type=="Kimya") selected @endif>Kimya</option>
                                            <option value="Biyoloji" @if($lesson->lesson_type=="Biyoloji") selected @endif>Biyoloji</option>
                                            <option value="Türkçe" @if($lesson->lesson_type=="Türkçe") selected @endif>Türkçe</option>
                                            <option value="Sosyal Bilimler" @if($lesson->lesson_type=="Sosyal Bilimler") selected @endif>Sosyal Bilimler</option>
                                            <option value="Matematik" @if($lesson->lesson_type=="Matematik") selected @endif>TYT - Matematik</option>
                                            <option value="Fen Bilimleri" @if($lesson->lesson_type=="Fen Bilimleri") selected @endif>Fen Bilimleri</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Sayısal Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="sayisal" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{$lesson->sayisal}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Eşit Ağırlık Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="esitagirlik" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{$lesson->esitagirlik}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Sözel Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="sozel" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{$lesson->sozel}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Yabancı Dil Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="yabancidil" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{$lesson->yabancidil}}">
                                    </div>
                                     <div class="form-group">
                                        <label>Ders Sırası</label>
                                        <input type="text"  required  class="form-control" name="order" placeholder="Lütfen Sınavda Olması Gereken Sıralamayı Giriniz" value="{{$lesson->order}}">
                                    </div>

                                <div class="d-flex justify-content-start align-items-center" style="float: right">
                                        <button type="submit" class="btn bg-blue ml-3">Kaydet <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                        {{Form::close()}}
                        {{ Form::open(['route' => ['lesson.destroy', $lesson->id], 'method' => 'delete']) }}
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
