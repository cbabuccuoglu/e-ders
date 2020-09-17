@extends('layout.master')

@section('title','Duyuru Tanımlama')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Yeni Duyuru Tanımla</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                        {{Form::open(['route'=>'noice.store' , 'method'=>'POST' , 'class' => 'form-horizontal'])}}
                        @csrf
                                    <div class="form-group">
                                        <label>Duyuru Tipi:</label>
                                        <select name="type"  required  class="form-control" >
                                            <option value="">Lütfen Duyuru Tipini Seçiniz</option>
                                            <option value="1">Sadece Öğretmenlere</option>
                                            <option value="2">Sadece Öğrencilere</option>
                                            <option value="3">Sadece Velilere</option>
                                            <option value="4">Bütün Herkese</option>
                                            <option value="5">Kişiye Özel</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Eğer Kişiye Özelse</label>
                                        <select name="user_id"  class="form-control select2"  >
                                            <option value="">Eğer Bildiriminiz Kişiye Özel İse Lütfen Seçim Yapınız</option>
                                            @foreach($lessons AS $lesson)
                                                <option value="{{$lesson->id}}">{{$lesson->name}} - @if($lesson->type==0) Yönetici @elseif($lesson->type==1) Öğretmen  @elseif($lesson->type==3) Veli @else Öğrenci @endif</option>
                                            @endforeach
                                        </select>                                    </div>
                                    <div class="form-group">
                                        <label>Duyuru Başlık:</label>
                                        <input type="text"  required  class="form-control" name="name" placeholder="Lütfen Duyuru Başlığını Giriniz" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Duyuru Açıklama:</label>
                                        <input type="text"  required  class="form-control" name="description" placeholder="Lütfen Duyuru Açıklamasını Giriniz" value="{{ old('name') }}">
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
