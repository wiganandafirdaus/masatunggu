<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Prediksi Masa Tunggu - Stacking </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('assets/images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('assets/images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('assets/images/logo-text.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                   <!-- <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                         <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div> 
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="./page-login.html" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul> 
                    </div>-->
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <!-- <li class="nav-label first">Main Menu</li> -->
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./index.html">Dashboard 1</a></li>
                            <li><a href="./index2.html">Dashboard 2</a></li></ul>
                    </li> -->
                    
                    <li class="nav-label">Apps</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Apps</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.html">Profile</a></li>
                        </ul>
                    </li>

                   
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                 <!-- <div class="row page-titles mx-0">
                     <div class="col-sm-6 p-md-0">
                         <div class="welcome-text">
                             <h4>Prediksi Masa Tunggu Lulusan</h4>
                             <span class="ml-1">Manage Your Data</span>
                         </div>
                     </div>
                     <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                             <li class="breadcrumb-item active"><a href="javascript:void(0)">Prediktor</a></li>
                         </ol>
                     </div>
                 </div> -->
                 <!-- row -->
                  <div class="row">
                        <div class="col-xl-6 col-lg-6 col-xxl-6">
                          <div class="card">
                              <div class="card-header">
                                  <h4 class="card-title">Prediktor Form</h4>
                              </div>
                              <div class="card-body">
                                  <div class="basic-form">
                                      <form action="{{ route('prediktors.store') }}" method="POST">
                                         @csrf
                                         <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label>Masa Studi (bulan)</label>
                                                 <input type="number" name="masa_studi" class="form-control" value="7" required>
                                             </div>
                                              <div class="form-group col-md-6">
                                                  <label>Provinsi</label>
                                                  <select name="provinsi" class="form-control" required>
                                                      <option value="">Pilih...</option>
                                                      <option value="Jawa Timur">Jawa Timur</option>
                                                      <option value="Jawa Tengah">Jawa Tengah</option>
                                                      <option value="Jawa Barat">Jawa Barat</option>
                                                      <option value="Bali">Bali</option>
                                                      <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                                      <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                                      <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                                      <option value="lain-lain">lain-lain</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label>Prodi</label>
                                                  <select name="prodi" class="form-control" required>
                                                      <option value="">Pilih...</option>
                                                      <option value="Sistem Informasi">Sistem Informasi</option>
                                                      <option value="Teknik Komputer">Teknik Komputer</option>
                                                      <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                                                      <option value="Produksi Film dan Televisi">Produksi Film dan Televisi</option>
                                                      <option value="Akuntansi">Akuntansi</option>
                                                      <option value="Manajemen">Manajemen</option>
                                                  </select>
                                              </div>
                                             <div class="form-group col-md-6">
                                                 <label>IPK</label>
                                                 <input type="number" name="ipk" step="0.10" min="0" max="4.00" class="form-control" value="3.50" required>
                                             </div>
                                              <div class="form-group col-md-6">
                                                  <label>TOEFL</label>
                                                  <input type="number" name="toefl" max="677" class="form-control" value="500" required>
                                              </div>
                                             <div class="form-group col-md-6">
                                                 <label>Jenis Kelamin</label>
                                                 <select name="jenis_kelamin" class="form-control" required>
                                                     <option value="">Pilih...</option>
                                                     <option value="0">Laki-laki</option>
                                                     <option value="1">Perempuan</option>
                                                 </select>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label>SSKM</label>
                                                 <input type="number" name="sskm" min="144" class="form-control" value="144" required>
                                             </div>
                                              <div class="form-group col-md-6">
                                                  <label>Nilai KP</label>
                                                  <select name="nilai_kp" class="form-control" required>
                                                      <option value="">Pilih...</option>
                                                      <option value="A">A</option>
                                                      <option value="B+">B+</option>
                                                      <option value="B">B</option>
                                                      <option value="C+">C+</option>
                                                      <option value="C">C</option>
                                                      <option value="D">D</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label>Nilai TA</label>
                                                  <select name="nilai_ta" class="form-control" required>
                                                      <option value="">Pilih...</option>
                                                      <option value="A">A</option>
                                                      <option value="B+">B+</option>
                                                      <option value="B">B</option>
                                                      <option value="C+">C+</option>
                                                      <option value="C">C</option>
                                                      <option value="D">D</option>
                                                  </select>
                                              </div>
                                             <div class="form-group col-md-6">
                                                 <label>Mempunyai Pengalaman Kerja / Magang</label>
                                                 <select name="magang" class="form-control" required>
                                                     <option value="">Pilih...</option>
                                                     <option value="0">Ya</option>
                                                     <option value="1">Tidak</option>
                                                 </select>
                                             </div>
                                           <div class="form-group col-md-6">
                                                 <label>Masa Cari Kerja</label>
                                                 <select name="masa_carikerja" class="form-control" required>
                                                     <option value="">Pilih...</option>
                                                     <option value="1">Sebelum Lulus</option>
                                                     <option value="2">Sesudah Lulus</option>
                                                 </select>
                                             </div>
                                               <div class="form-group col-md-6">
                                                 <label>Jumlah Lamaran yang disebar</label>
                                                 <input type="number" name="jml_lamaran" class="form-control" value="10" required>
                                             </div>
                                         </div>

                                         <button type="submit" class="btn btn-primary">Simpan</button>
                                         @if(session('success'))
                                             <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                         @endif
                                         @if($errors->any())
                                             <div class="alert alert-danger mt-3">
                                                 <ul>
                                                     @foreach($errors->all() as $error)
                                                         <li>{{ $error }}</li>
                                                     @endforeach
                                                 </ul>
                                             </div>
                                          @endif
                                      </form>
                                  </div>
                              </div>
                          </div>
                      
                       <div class="col-xl-9 col-lg-9 col-xxl-9">
                           <div class="card">
                               <div class="card-header">
                                   <h4 class="card-title">Hasil Prediksi Terbaru</h4>
                               </div>
                               <div class="card-body">
                                   @if($latestPrediktor)
                                       <p><strong>Prodi:</strong> {{ $latestPrediktor->prodi }}</p>
                                       <p><strong>IPK:</strong> {{ $latestPrediktor->ipk }}</p>
                                       <p><strong>TOEFL:</strong> {{ $latestPrediktor->toefl }}</p>
                                       <p><strong>Jenis Kelamin:</strong> {{ $latestPrediktor->jenis_kelamin ? 'Perempuan' : 'Laki-laki' }}</p>
                                       <p><strong>Masa Cari Kerja:</strong> {{ $latestPrediktor->masa_carikerja }}</p>
                                       <p><strong>Prediksi Masa Tunggu:</strong> {{ $latestPrediktor->masa_carikerja }} Bulan</p>
                                   @else
                                       <p>Belum ada data prediktor yang diinput.</p>
                                   @endif
                               </div>
                           </div>
                       </div>
                  </div>
                  
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    
</body>

</html>