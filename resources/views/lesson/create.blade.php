@extends('layout.master')

@section('title','Ders Tanımlama')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Yeni Ders Tanımla</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                        {{Form::open(['route'=>'lesson.store' , 'method'=>'POST' , 'class' => 'form-horizontal'])}}
                        @csrf
                                    <div class="form-group">
                                        <label>Ders İsmi:</label>
                                        <input type="text"  required  class="form-control" name="name" placeholder="Lütfen Ders İsmini Giriniz" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders TYT Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="point" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>AYT - TYT - YDT Ders Eşleştirme:</label>
                                       <select name="lesson_type"  class="form-control select2">
                                           <option value="İngilizce">İngilizce</option>
                                           <option value="Türk Dili ve Edebiyatı">Türk Dili ve Edebiyatı</option>
                                           <option value="Tarih-1">Tarih-1</option>
                                           <option value="Coğrafya">Coğrafya</option>
                                           <option value="Tarih-2">Tarih-2</option>
                                           <option value="Coğrafya-2">Coğrafya-2</option>
                                           <option value="Felsefe Grubu">Felsefe Grubu</option>
                                           <option value="Din Kültürü ve Ahlak B.">Din Kültürü ve Ahlak B.</option>
                                           <option value="AYT - Matematik">AYT - Matematik</option>
                                           <option value="Fizik">Fizik</option>
                                           <option value="Kimya">Kimya</option>
                                           <option value="Biyoloji">Biyoloji</option>
                                           <option value="Türkçe">Türkçe</option>
                                           <option value="Sosyal Bilimler">Sosyal Bilimler</option>
                                           <option value="TYT - Matematik">TYT - Matematik</option>
                                           <option value="Fen Bilimleri">Fen Bilimleri</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Sayısal Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="sayisal" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Eşit Ağırlık Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="esitagirlik" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Sözel Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="sozel" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Ders Yabancı Dil Katsayı Puanı:</label>
                                        <input type="text"  required  class="form-control" name="yabancidil" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{ old('name') }}">
                                    </div>
                                     <div class="form-group">
                                        <label>Ders Sırası</label>
                                        <input type="text"  required  class="form-control" name="order" placeholder="Lütfen Sınavda Olması Gereken Sıralamayı Giriniz" value="{{ old('placeholder') }}">
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
