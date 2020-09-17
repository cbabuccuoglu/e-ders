


@include('layout.header')

<!-- Page container -->
<div class="page-content">

    <!-- Page content -->
@include('layout.sidebar')


        <!-- Main content -->
        <div class="content-wrapper">


                <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Anasayfa</span>  - @yield('title')</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="/" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Anasayfa</a>
                            <span class="breadcrumb-item active">@yield('title')</span>
                        </div>

                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                   
                </div>
            </div>

                        @yield('content')



              @include('layout.footer')

            </div>
            <!-- /content area -->


    <!-- /page content -->

<!-- /page container -->
    </div>
</div>

</body>
</html>
