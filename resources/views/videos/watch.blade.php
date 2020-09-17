@extends('layout.master')

@section('title',$videos->name)

@section('content')
    {{Html::style('dist/demo.css')}}

    <div class="content">
                <!-- Basic responsive configuration -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{$videos->name}}</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>
                    @php
                    $videolink=$videos->videoslink;
                    $videolink=str_replace('https://www.youtube.com/watch?v=','https://www.youtube.com/embed/',$videolink);
                    @endphp
                    <div class="plyr__video-embed" id="player">
                        <iframe
                            src="{{$videolink}}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                            allowfullscreen
                            allowtransparency
                            width="100%"
                            height="800px"
                            allow="autoplay"
                        ></iframe>
                    </div>
                </div>

        <script type="text/javascript">
            var ilkRakam =0;
            $(document).ready(function(){
                $.saymayaBasla = function(){
                    ilkRakam++;
                    console.log(ilkRakam);
                }
                setInterval("$.saymayaBasla()",1000);
            });

        </script>

        <script type="text/javascript">
           window.onbeforeunload = function () {
                $.ajax({
                    type: 'GET',
                    url: "{{route('set.videoswatch')}}?id={{$videos->id}}&saniye="+ilkRakam,
                    success:
                        function (response) {

                        }
                });
            }

        </script>
    {{ Html::script('dist/demo.js') }}

@endsection
