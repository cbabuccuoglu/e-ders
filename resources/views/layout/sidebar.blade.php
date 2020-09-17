<!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

            <!-- Sidebar mobile toggler -->
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                Menü
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <!-- /sidebar mobile toggler -->


            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#"><img src="/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">@if(isset(Auth::user()->name)){{Auth::user()->name}}@endif</div>
                                <div class="font-size-xs opacity-50">
                                    <i class="icon-pin font-size-sm"></i>@if(Auth::user()->type==0) Yönetici @elseif(Auth::user()->type==1) Öğretmen @ @elseif(Auth::user()->type==3) Veli @else Öğrenci @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">
                        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Menüler</div> <i class="icon-menu" title="Main"></i></li>
                        <li class="nav-item">
                            <a href="/" class="nav-link active">
                                <i class="icon-home4"></i>
                                <span>
                                    Anasayfa
                                </span>
                            </a>
                        </li>
                        @if(Auth::user()->type==0)
                         <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-grid"></i> <span>Sınıflar</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{route('class.create')}}" class="nav-link">Yeni Sınıf Kaydı Oluştur</a></li>
                                <li class="nav-item"><a href="{{route('class.index')}}" class="nav-link">Sınıf Kayıtlarını listele</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-bookmark"></i> <span>Dersler ve Kazanımlar</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{route('lesson.create')}}" class="nav-link">Yeni Ders Kaydı Oluştur</a></li>
                                <li class="nav-item"><a href="{{route('gains.create')}}" class="nav-link">Yeni Kazanım Oluştur</a></li>
                                <li class="nav-item"><a href="{{route('lesson.index')}}" class="nav-link">Ders Kayıtlarını listele</a></li>
                                <li class="nav-item"><a href="{{route('gains.index')}}" class="nav-link">Kazanımları listele</a></li>
                            </ul>
                        </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-play"></i> <span>Ders Videoları</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('videos.create')}}" class="nav-link">Video Kaydı Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('videos.index')}}" class="nav-link">Video Kayıtlarını listele</a></li>
                                </ul>
                            </li>
                         <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-graduation"></i> <span>Öğretmenler</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{route('teacher.create')}}" class="nav-link">Yeni Öğretmen Kaydı Oluştur</a></li>
                                <li class="nav-item"><a href="{{route('teacher.index')}}" class="nav-link">Öğretmen Kayıtlarını listele</a></li>
                            </ul>
                        </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-user-tie"></i> <span>Veliler</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('guardian.create')}}" class="nav-link">Yeni Veli Kaydı Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('guardian.index')}}" class="nav-link">Veli Kayıtlarını listele</a></li>
                                </ul>
                            </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-users4"></i> <span>Öğrenciler</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{route('student.create')}}" class="nav-link">Yeni Öğrenci Kaydı Oluştur</a></li>
                                <li class="nav-item"><a href="{{route('student.index')}}" class="nav-link">Öğrenci Kayıtlarını listele</a></li>
                            </ul>
                        </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-pencil6"></i> <span>Deneme Sınavları</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('trialexam.create')}}" class="nav-link">Yeni Deneme Sınavı Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('trialexam.index')}}" class="nav-link">Deneme Sınavlarını Listele</a></li>
                                </ul>
                            </li>
                           <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-bell2"></i> <span>Duyurular</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('noice.create')}}" class="nav-link">Yeni Duyuru Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('noice.index')}}" class="nav-link">Duyuruları Listele</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link disabled">Canlı Dersler <span class="badge bg-transparent align-self-center ml-auto">Geliştiriliyor</span>
                                </a>
                            </li>



                     @endif
                        @if(Auth::user()->type==1)
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-grid"></i> <span>Sınıflar</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('class.create')}}" class="nav-link">Yeni Sınıf Kaydı Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('class.index')}}" class="nav-link">Sınıf Kayıtlarını listele</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-user-tie"></i> <span>Veliler</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('guardian.create')}}" class="nav-link">Yeni Veli Kaydı Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('guardian.index')}}" class="nav-link">Veli Kayıtlarını listele</a></li>
                                </ul>
                            </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-users4"></i> <span>Öğrenciler</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{route('student.create')}}" class="nav-link">Yeni Öğrenci Kaydı Oluştur</a></li>
                                <li class="nav-item"><a href="{{route('student.index')}}" class="nav-link">Öğrenci Kayıtlarını listele</a></li>
                            </ul>
                        </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-bookmark"></i> <span>Kazanımlar</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('gains.create')}}" class="nav-link">Yeni Kazanım Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('gains.index')}}" class="nav-link">Kazanımları listele</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-play"></i> <span>Ders Videoları</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('videos.create')}}" class="nav-link">Video Kaydı Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('videos.index')}}" class="nav-link">Video Kayıtlarını listele</a></li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-pencil6"></i> <span>Deneme Sınavları</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('trialexam.create')}}" class="nav-link">Yeni Deneme Sınavı Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('trialexam.index')}}" class="nav-link">Deneme Sınavlarını Listele</a></li>
                                </ul>
                            </li>
                          <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-bell2"></i> <span>Duyurular</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('noice.create')}}" class="nav-link">Yeni Duyuru Oluştur</a></li>
                                    <li class="nav-item"><a href="{{route('noice.index')}}" class="nav-link">Duyuruları Listele</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link disabled">Canlı Dersler <span class="badge bg-transparent align-self-center ml-auto">Geliştiriliyor</span>
                                </a>
                            </li>


                     @endif
                        @if(Auth::user()->type==2)

                            <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-play"></i> <span>Ders Videoları</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                   
                                </ul>
                            </li>
                        <li class="nav-item">
                            <a href="{{route('answer.index')}}" class="nav-link"><i class="icon-pencil6"></i> <span>Deneme Sınavları</span></a>
                        </li>
                           <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-bell2"></i> <span>Duyurular</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('list.noice')}}" class="nav-link">Duyuruları Listele</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link disabled">Canlı Dersler <span class="badge bg-transparent align-self-center ml-auto">Geliştiriliyor</span>
                                </a>
                            </li>



                        @endif
                        @if(Auth::user()->type==3)

                            <li class="nav-item">
                                <a href="{{route('watch.videos.guardians')}}" class="nav-link"><i class="icon-play"></i> <span>Ders Video İzlenme Süreleri</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('list.student.answerresult',Auth::user()->user_id)}}" class="nav-link"><i class="icon-pencil6"></i> <span>Deneme Sınav Sonuçları</span></a>
                            </li>
                           <li class="nav-item nav-item-submenu">
                                <a href="#" class="nav-link"><i class="icon-bell2"></i> <span>Duyurular</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                    <li class="nav-item"><a href="{{route('list.noice')}}" class="nav-link">Duyuruları Listele</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link disabled">Canlı Dersler <span class="badge bg-transparent align-self-center ml-auto">Geliştiriliyor</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /main sidebar -->
