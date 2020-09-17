@extends('layout.master')

@section('title','Soru Düzenleme')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Soru Düzenleme</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                            {{ Form::model($examquestion, array('route' => array('examquestion.update', $examquestion->id), 'method' => 'PUT' , 'files'=> 'true' , 'class' => 'form-horizontal')) }}
                        @csrf

                                <div class="form-group">
                                    <label>Soru Türü:</label>
                                    <select  name="questionstype" id="questiontype"   required  class="form-control select2" >
                                        <option value="">Soru Türü Seçiniz </option>
                                        <option value="1" @if($examquestion->questionstype==1) selected @endif>Görsel Soru </option>
                                        <option value="2" @if($examquestion->questionstype==2) selected @endif>Yazılı Soru </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ders Seçiniz:</label>
                                    {!! Form::select('lesson_id', $lesson, $examquestion->lesson_id ?? null, ['placeholder' => 'Ders Seçiniz', 'class' => 'form-control select2' , 'id' => 'lessonid']) !!}
                                </div>
                                <div class="form-group" id="gainsid">
                                    <label>Kazanım Seçiniz:</label>
                                    <select name="gains_id"  required  class="form-control select2">
                                        <option value="">Kazanım Seçmek İçin Lütfen Önce Ders Seçiniz</option>
                                        @foreach($gains AS $gain)
                                            <option value="{{$gain->id}}" @if($examquestion->gains_id==$gain->id) selected @endif>{{$gain->classNumber}}.Sınıf -> {{$gain->lesson->name ?? ''}} > {{$gain->units}} > {{$gain->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Soru Sırası:</label>
                                    <input type="text"  required  class="form-control" name="order" placeholder="Lütfen Soru Sırasını Giriniz (Örn:1)" value="{{$examquestion->order}}">
                                </div>

                                <div class="imagequestion" @if($examquestion->questionstype==2) style="display: none" @endif>
                                    <div class="form-group">
                                        <label>Soru:</label>
                                        <input type="file"   name="image" class="form-input-styled">
                                        <span class="form-text text-muted">İzinli Formatlar: gif, png, jpg. En Yüksek Dosya Boyutu: 2Mb</span>
                                    </div>
                                </div>
                                <div class="writequestion"  @if($examquestion->questionstype==1) style="display: none"  @endif>
                                    <div class="form-group">
                                        <label>Soru :</label>
                                        <input type="text"   class="form-control" name="Wquestion" placeholder="Lütfen Soruyu Giriniz" value="{{$examquestion->Wquestion}}">
                                    </div>
                                    <div class="form-group">
                                        <label>A Şıkkı :</label>
                                        <input type="text"   class="form-control" name="WoptionA" placeholder="Lütfen A Şıkkını Giriniz" value="{{$examquestion->WoptionA}}">
                                    </div>
                                    <div class="form-group">
                                        <label>B Şıkkı :</label>
                                        <input type="text"   class="form-control" name="WoptionB" placeholder="Lütfen B Şıkkını Giriniz" value="{{$examquestion->WoptionB}}">
                                    </div>
                                    <div class="form-group">
                                        <label>C Şıkkı :</label>
                                        <input type="text"   class="form-control" name="WoptionC" placeholder="Lütfen C Şıkkını Giriniz" value="{{$examquestion->WoptionC}}">
                                    </div>
                                    <div class="form-group">
                                        <label>D Şıkkı :</label>
                                        <input type="text"   class="form-control" name="WoptionD" placeholder="Lütfen D Şıkkını Giriniz" value="{{$examquestion->WoptionD}}">
                                    </div>
                                    <div class="form-group">
                                        <label>E Şıkkı :</label>
                                        <input type="text"   class="form-control" name="WoptionE" placeholder="Lütfen E Şıkkını Giriniz" value="{{$examquestion->WoptionE}}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Soru Kat Sayı Puanı:</label>
                                    <input type="text"  required  class="form-control" id="point" name="point" placeholder="Lütfen Kat Sayı Puan Giriniz (Örn:3.3)" value="{{$examquestion->point}}">
                                </div>

                                <div class="form-group">
                                    <label>Doğru Cevap:</label>
                                    <select name="trueresult"  required  class="form-control" required >
                                        <option value="">Lütfen Doğru Şıkkı Seçiniz </option>
                                        <option value="A"  @if($examquestion->trueresult=="A") selected @endif>A</option>
                                        <option value="B"  @if($examquestion->trueresult=="B") selected @endif>B</option>
                                        <option value="C"  @if($examquestion->trueresult=="C") selected @endif>C</option>
                                        <option value="D"  @if($examquestion->trueresult=="D") selected @endif>D</option>
                                        <option value="E"  @if($examquestion->trueresult=="E") selected @endif>E</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-start align-items-center" style="float: right">
                                    <button type="submit" class="btn bg-blue ml-3">Kaydet <i class="icon-paperplane ml-2"></i></button>
                                </div>
                        {{Form::close()}}
                        {{ Form::open(['route' => ['examquestion.destroy', $examquestion->id], 'method' => 'delete']) }}
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


        <!-- /dashboard content -->
        {{ Html::script('js/demo_pages/form_layouts.js') }}
        {{ Html::script('js/plugins/forms/styling/uniform.min.js') }}

        <script type="text/javascript">

            $(document).ready(function() {
                $('#questiontype').on('select2:select', function (e) {
                    var data = e.params.data;
                    if(data.id==""){
                        $(".imagequestion").hide();
                        $(".writequestion").hide();
                    }else if(data.id==1){
                        $(".imagequestion").show();
                        $(".writequestion").hide();
                    }else if(data.id==2){
                        $(".imagequestion").hide();
                        $(".writequestion").show();
                    }
                });
                $('#lessonid').on('select2:select', function (e) {
                    var data = e.params.data;
                    $.ajax({
                        type: 'GET',
                        url: "{{route('get.gains')}}?id="+data.id,
                        success:
                            function (response) {
                                $("#gainsid").html(response);
                                $('.select2').select2();

                            }
                    });
                    $.ajax({
                        type: 'GET',
                        url: "{{route('get.points')}}?id="+data.id,
                        success:
                            function (response) {
                                $("#point").val(response);
                            }
                    });
                });
            });
        </script>
@endsection
