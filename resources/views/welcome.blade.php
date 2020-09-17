@extends('layout.master')

@section('title','Genel İstatistikler')

@section('content')

			<div class="row" style="margin: 10px">
			<div class="col-lg-3">
            @if(Auth::user()->type==0 || Auth::user()->type==1)
								<!-- Members online -->
								<div class="card bg-teal-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{$total['totaltrial']}}</h3>
					                	</div>

					                	<div>
										Toplam Sınav Sayısı
										</div>
									</div>

								</div>
								<!-- /members online -->

							</div>

				<div class="col-lg-3">

								<!-- Members online -->
								<div class="card bg-pink-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{$total['totalstudent']}}</h3>
					                	</div>

					                	<div>
										Toplam Öğrenci Sayısı
										</div>
									</div>

								</div>
								<!-- /members online -->

							</div>


							<div class="col-lg-3">

								<!-- Members online -->
								<div class="card bg-orange-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{$total['totalteacher']}}</h3>
					                	</div>

					                	<div>
										Toplam Öğretmen Sayısı
										</div>
									</div>
								</div>
								<!-- /members online -->

							</div>

							<div class="col-lg-3">

								<!-- Members online -->
								<div class="card bg-blue-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0">{{$total['totalquestion']}}</h3>
					                	</div>

					                	<div>
										Toplam Soru Sayısı
										</div>
									</div>


								</div>
								<!-- /members online -->

							</div>
@endif
                @if(Auth::user()->type==2)

                    <!-- Members online -->
                        <div class="card bg-teal-400">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h3 class="font-weight-semibold mb-0">{{$total['totalanswer']}}</h3>
                                </div>

                                <div>
                                 Çözdüğüm Soru Sayısı
                                </div>
                            </div>

                        </div>
                        <!-- /members online -->

            </div>

            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-pink-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">{{$total['totalanswertrue']}}</h3>
                        </div>

                        <div>
                         Çözdüğüm Doğru Sayısı
                        </div>
                    </div>

                </div>
                <!-- /members online -->

            </div>


            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-orange-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">{{$total['totalanswerany']}}</h3>
                        </div>

                        <div>
                            Çözdüğüm Boş Soru Sayısı
                        </div>
                    </div>
                </div>
                <!-- /members online -->

            </div>

            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-blue-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">{{$total['totalanswerfalse']}}</h3>
                        </div>

                        <div>
                            Çözdüğüm Yanlış Soru Sayısı
                        </div>
                    </div>


                </div>
                <!-- /members online -->

            </div>
                @endif
            @if(Auth::user()->type==3)

                <!-- Members online -->
                <div class="card bg-teal-400">
                    <div class="card-body">
                        <div class="d-flex">
                            <h3 class="font-weight-semibold mb-0">{{$total['totalanswer']}}</h3>
                        </div>

                        <div>
                           Öğrencinin Çözdüğü Soru Sayısı
                        </div>
                    </div>

                </div>
                <!-- /members online -->

                </div>

                <div class="col-lg-3">

                    <!-- Members online -->
                    <div class="card bg-pink-400">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{$total['totalanswertrue']}}</h3>
                            </div>

                            <div>
                                Öğrencinin Çözdüğü Doğru Sayısı
                            </div>
                        </div>

                    </div>
                    <!-- /members online -->

                </div>


                <div class="col-lg-3">

                    <!-- Members online -->
                    <div class="card bg-orange-400">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{$total['totalanswerany']}}</h3>
                            </div>

                            <div>
                                Öğrencinin Çözdüğü Boş Soru Sayısı
                            </div>
                        </div>
                    </div>
                    <!-- /members online -->

                </div>

                <div class="col-lg-3">

                    <!-- Members online -->
                    <div class="card bg-blue-400">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{$total['totalanswerfalse']}}</h3>
                            </div>

                            <div>
                                Öğrencinin Çözdüğü Yanlış Soru Sayısı
                            </div>
                        </div>


                    </div>
                    <!-- /members online -->

                </div>
                @endif
			</div>

<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />



@endsection
