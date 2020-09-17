<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - Online Deneme Sınav Sistemi</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
     {{Html::style('css/icons/icomoon/styles.min.css')}}
     {{Html::style('assets/css/bootstrap.min.css')}}
     {{Html::style('assets/css/bootstrap_limitless.min.css')}}
     {{Html::style('assets/css/layout.min.css')}}
     {{Html::style('assets/css/components.min.css')}}
     {{Html::style('assets/css/colors.min.css')}}
     {{Html::script('js/main/jquery.min.js')}}
     {{Html::script('js/main/bootstrap.bundle.min.js')}}
     {{Html::script('js/plugins/loaders/blockui.min.js')}}
     {{Html::script('js/plugins/visualization/d3/d3.min.js')}}
     {{Html::script('js/plugins/visualization/d3/d3_tooltip.js')}}
     {{Html::script('js/plugins/forms/styling/switchery.min.js')}}
     {{Html::script('js/plugins/ui/moment/moment.min.js')}}
     {{Html::script('js/plugins/pickers/daterangepicker.js')}}
     {{Html::script('js/demo_pages/dashboard.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/streamgraph.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/sparklines.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/lines.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/areas.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/donuts.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/bars.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/progress.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/heatmaps.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/pies.js')}}
     {{Html::script('js/demo_charts/pages/dashboard/light/bullets.js')}}
     {{Html::script('assets/js/app.js')}}
     {{Html::style('select2/select2.min.css')}}
     {{ Html::script('select2/select2.min.js') }}


      @notifyCss
</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-dark" style="background: #a4070b">
        <div class="navbar-brand">
            <a href="/" class="d-inline-block">
                <img src="/images/logo_light.png" alt="">
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>

            <span class="badge bg-success ml-md-3 mr-md-auto">V 1.0</span>

            <ul class="navbar-nav">


                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                        <img src="/images/placeholders/placeholder.jpg" class="rounded-circle mr-2" height="34" alt="">
                        <span>@if(isset(Auth::user()->name)){{Auth::user()->name}}@endif</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/logout" class="dropdown-item"><i class="icon-switch2"></i>Çıkış Yap</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
