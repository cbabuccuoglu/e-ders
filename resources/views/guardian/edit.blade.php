@extends('layout.master')

@section('title','Velileri Düzenleme')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Veli Düzenleme İşlemleri</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                            {{ Form::model($teacher, array('route' => array('guardian.update', $teacher->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                        @csrf
                                   <div class="form-group">
                                        <label>Veli Ad Soyad:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Lütfen Adını Soyadını Giriniz" value="{{$teacher->name}}">
                                    </div>
                                <div class="form-group">
                                    <label>Veli Numarası:</label>
                                    <input type="text" class="form-control" name="tcno" placeholder="Lütfen Sisteme Giriş Yapacak Veli Numarasını Giriniz" value="{{$teacher->tcno}}">
                                </div>
                                      <div class="form-group">
                                        <label>Veli Mail Adresi:</label>
                                        <input type="text" class="form-control" name="email" placeholder="Lütfen Sisteme Giriş Yapacak Mail Adresini Giriniz" value="{{$teacher->email}}">
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-form-label col-lg-2">Veli Sistem Parolası:</label>
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <input type="text" id="password" name="password" class="form-control border-right-0" placeholder="Lütfen Sisteme Giriş Yapacak Parolayı Giriniz (Min:6 Karakter)  ">
                                                <span class="input-group-append">
                                                    <button class="btn bg-teal" type="button"   onClick="generate();" >Rastgele Şifre</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="type" value="3">
                                    <div class="form-group">
                                        <label>Hangi Öğrencinin Velisi:</label>
                                        {!! Form::select('user_id', $lesson, $teacher->user_id ?? null , ['placeholder' => 'Öğrenci Seçiniz', 'class' => 'form-control select2']) !!}
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center" style="float: right">
                                        <button type="submit" class="btn bg-blue ml-3">Kaydet <i class="icon-paperplane ml-2"></i></button>
                                    </div>





                        {{Form::close()}}
                        {{ Form::open(['route' => ['guardian.destroy', $teacher->id], 'method' => 'delete']) }}
                        <div class="pull-left">
                            <button type="submit" class="btn btn-danger"> <i class="icon-trash  mr-2"></i> Sil</button>
                        </div>
                            {{Form::close()}}
                             </div>
                        </div>
                <!-- /form horizontal -->

            </div>
        </div>



<script type="text/javascript">
    function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function generate() {
    $("#password").val(randomPassword(8));
}
</script>

        <!-- /dashboard content -->
@endsection
