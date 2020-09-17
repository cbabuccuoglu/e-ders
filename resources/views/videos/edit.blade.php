@extends('layout.master')

@section('title','Video Düzenleme')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Video Düzenleme İşlemleri</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                            {{ Form::model($videos, array('route' => array('videos.update', $videos->id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                        @csrf
                                     <div class="form-group">
                                        <label>Sınıf Seçiniz:</label>
                                        <select name="classNumber"  class="form-control" >
                                        @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}" @if($videos->classNumber==$i) selected @endif>{{$i}}.Sınıf </option>
                                        @endfor
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <label>Ders Seçiniz:</label>
                                    {!! Form::select('lesson_id', $lesson, $videos->lesson_id ?? null, ['placeholder' => 'Ders Seçiniz', 'class' => 'form-control select2']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Video İsmi:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Lütfen Video İsmini Giriniz" value="{{$videos->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Video Linki:</label>
                                    <input type="text" class="form-control" name="videoslink" placeholder="Lütfen Video Linkini Giriniz"  value="{{$videos->videoslink}}">
                                </div>
                                <div class="d-flex justify-content-start align-items-center" style="float: right">
                                    <button type="submit" class="btn bg-blue ml-3">Kaydet <i class="icon-paperplane ml-2"></i></button>
                                </div>
                        {{Form::close()}}
                        {{ Form::open(['route' => ['videos.destroy', $videos->id], 'method' => 'delete']) }}
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
