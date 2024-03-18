  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url('assets/import/img/logo/cake.png')?>" rel="icon">
  <title>Ohh Bakery</title>
  <link href="<?php echo base_url('assets/import/css/main.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/import/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/import/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/import/css/ruang-admin.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/import/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src='<?php echo base_url();?>assets/import/js/jquery-3.2.1.min.js' type='text/javascript'></script>
  <script src='<?php echo base_url();?>assets/import/select2/dist/js/select2.min.js' type='text/javascript'></script>
  <link href='<?php echo base_url();?>assets/import/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php echo base_url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo base_url();?>https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="<?php echo base_url();?>https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
  <script src='<?php echo base_url();?>assets/import/js/sorttable.js' type='text/javascript'></script>
  <style type="text/css">
    .login {
      min-height: 100vh;
    }
    .dvd-left {
      border-left: 2px solid white;
      height: 50px;
      left: 50%;
     
    }

    .btn-success:not(:disabled):not(.disabled):active{
      color: #fff;
      background-color: #10625e!important;
      border-color: #10625e!important;
    }

    .bg-color {
      background-color: #1BA39C;
      background-size: cover;
      background-position: center;
    }

    .login-heading {
      font-weight: 300;
    }

    .btn-login {
      font-size: 12px;
      padding-left: 40px;
      padding-right: 40px;
      border-radius: 0.5rem;
      letter-spacing: 1px;
    }
    .p-set{
        padding-right: 12px;
        padding-left: 12px;
    }
    .btn-login{
      background-color: #1BA39C;
      border-color: #1BA39C;
    }
    .btn-login:hover{
      background-color: #046151;
      border-color:  #046151;
    }

    .btn-db{
      background-color: #1BA39C;
      border-color: #1BA39C;
    }
    .btn-db:hover{
      background-color: #046151;
      border-color:  #046151;
    }
    @media only screen and (max-width: 991px) {
      .img-set{
        width: 80px;
      }
      .img-ct{
        width:  400px;
      }
      .wraptocenter{
        margin-top: 12px;
        margin-bottom: 12px;
      }
      .prg{
        max-width: 90px!important;
      }
      .fwd{
        width: 100%;
        padding:0px;
        margin:0px;
      }
    }
    @media only screen and (min-width: 992px) {
      .img-set{
        width: 80px;
      }
      .img-ct{
        width:  520px;
      }
      .prg{
        padding-right: 75px;
      }
    }
    @media only screen and (min-width: 1920px) {
      .img-set{
        width: 100px;
      }
      .img-ct{
        width:  800px;
      }
      .prg{
        padding-right: 100px;
      }
      h5{
        font-size: 1.50rem;
      }
      .dvd-left {
        border-left: 2px solid white;
        height: 70px;
        left: 50%;
       
      }
      h1{
        font-size: 2.75rem!important;
      }

      h1 .hd-sn{
        font-size: 2.75rem!important;
        margin-bottom: 10px!important;
      }

      h4{
        font-size: 1.75rem;
      }
      .font-small{
        font-size: 17px!important;
      }
      .hd-sn{
        font-size: 54px!important;
      }
      .lbl-lgn{
        font-size: 18px!important;
      }
      .form-floating label{
        font-size: 1.25rem!important;
      }
      .container{
        margin-top : 170px;
      }
      .gd{
        margin-top: 160px;
      }
      .form-control .fc-ip {
        height: calc(1.5em + .75rem + 7px)
       
        font-size: 1rem;
        line-height: 1.5;
      
      }
      .form-control .fc-sc {
        height: calc(1.5em + .75rem + 7px);
       
        font-size: 1rem;
        line-height: 1.5;
      
      }
      .btn-cbd{
        padding: 0.375rem 0.75rem!important;
        line-height: 1.5!important;
      }

      .btn-login {
        font-size: 1rem;
        padding-left: 40px;
        padding-right: 40px;
        border-radius: 0.35rem;
        letter-spacing: 1px;
      }
    }
    .btn-cbd {
        padding: 0.25rem 0.5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .form-control .fc-ip {
      height: calc(1.5em + 0.5rem + 2px);
     
      font-size: .875rem;
      line-height: 1.5;
    
    }
    .form-control .fc-sc {
      height: calc(1.5em + 0.5rem + 2px);
     
      font-size: .875rem;
      line-height: 1.5;
    
    }
    h1 .hd-sn{
        margin-bottom: 0px;
      }
    .img-gear{
      width: 50px;
    }
    .alert-success{
      color: #00371d!important;
      background-color: #b3d3c4!important;
    }
    .border-success{
      border-color: #1BA39C!important;
    }
    .btn-info{
      background-color: #004c6d;
      border-color: #004c6d;
    }
    .btn-info:hover{
      background-color: #004462;
      border-color: #004462;
    }
    .btn-warning{
      background-color: #b3731b;
      border-color: #b3731b;
    }
    .btn-warning:hover{
      background-color: #996217;
      border-color: #996217;
    }
    .btn-danger{
      background-color: #ca433c ;
      border-color: #ca433c ;
    }
    .btn-danger:hover{
      background-color: #b03b35;
      border-color: #b03b35;
    }
    .btn-success{
      background-color: #1BA39C ;
      border-color: #1BA39C ;
    }
    .btn-success:hover{
      background-color: #10625e;
      border-color: #10625e;
    }
    .btn-secondary{
      background-color: #4e4e4e ;
      border-color: #4e4e4e ;
    }
    .btn-secondary:hover{
      background-color: #444444;
      border-color: #444444;
    }
    .gr{
      max-width: 1%;
    }
    .font-small{
      font-size: 13px;
    }
    .text-green{
      color: #1BA39C;
    }
    .hd-sn{
      font-family: "Arial";
      font-size: 50px;
    }
    .hd-db{
      font-family: "Arial";
      font-size: 35px;
    }
    .lbl-lgn{
      font-size: 14px;
    }
    input[type="text"],
    input[type="password"]{
      background: transparent;
      border: none;
      border-bottom: 1px solid #000000;
      -webkit-box-shadow: none;
      box-shadow: none;
      border-radius: 0;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      -webkit-box-shadow: none;
      box-shadow: none;
    }
    .fc-ip:focus {
      border: none;
      border-bottom: 1px solid #1BA39C;
    }
    .fc-sc:focus {
      border: 1px solid #1BA39C;
    }
    .fc-sc{
      border-radius: 0.7rem;
    }
    .txt-arial{
      font-family: "Arial";  
    }
  </style>
</head>

<body id="page-top">
  <div class="container-fluid ps-md-0 p-set">
    <div class="row g-0">
      <div class="d-none d-flex col-md-4 col-lg-6 bg-color align-items-center row fwd">
        <div class="col-sm-12 row">
          <div class="col align-self-start col-sm-1 prg pb-1">
            <img class="img-set" src="<?php echo base_url('assets/import/img/logo/white.png')?>" alt="IMG">
          </div>
          <div class="col align-self-center col-sm-1 gr"><div class="dvd-left dvd-change"></div></div>
          <div class="col align-self-end col-sm-9 text-white ml-0 pl-0 pt-4 pb-1 txt-arial">
            <h5>Ohh Bakery</h5>
          </div>
        </div>
        <div class="col-sm-12 text-center">
          <img class="img-ct" src="<?php echo base_url('assets/import/img/logo/ohh.png')?>" alt="IMG">
        </div>
        <div class="col-sm-12 text-white mt-4">
          <h1 class="font-weight-bold m-0">Welcome</h1>
          <h4 class="mb-2">Ohh Bakery Back Office</h4>
          <label class="font-small">Proses pembuatan resep dan juga trial resep untuk menjadi produk yang baik. Anda bisa menambah resep dan mencoba resep.</label>
        </div>
        <div class="col-sm-12" style="margin-top:51px;"></div>
      </div>
      <div class="col-md-8 col-lg-6">
      <?php if($pg_st == 'login'){?>
        <div class="login d-flex align-items-center row">
          <div class="container col-lg-12 pt-1">
            <div class="row pt-1">
              <div class="col-md-12 col-lg-8 mx-auto"> 
                <h1 class="text-left font-weight-bold text-green hd-sn">Sign in</h1>
                <h6 class="lbl-lgn font-weight-bold mt-0 mb-3">Aplikasi ini digunakan untuk pembuatan resep oleh Ohh Bakery.</h6>
                <!-- Sign In Form -->
                <form action="<?php echo base_url('aksi');?>" method="post">
                  <div class="form-floating mb-3">
                    <label for="floatingInput" class="text-green font-weight-bold mb-0">User Name</label>
                    <input type="text" name="username" class="form-control form-control fc-ip mt-0 p-0" id="floatingInput" placeholder="User name">
                    
                  </div>
                  <div class="form-floating mb-3">
                    <label for="floatingPassword" class="text-green font-weight-bold mb-0">Password</label>
                    <input type="password" name="pass" class="form-control form-control fc-ip mt-0 p-0" id="floatingPassword" placeholder="Password">
                    
                  </div>
                   
                    <div class="col-sm-12 d-flex align-items-end justify-content-end">
                    <?php
                      $act = '';
                          if(!empty($json_arr) ) {
                            foreach($json_arr['select'] as $ky=>$val) {
                              $act = $val['active_db'];
                            }
                          }
                      ?>
                      <div class="d-grid text-center mt-3">
                        <!-- <button class="btn btn-success btn-login btn-cbd font-weight-bold" type="submit" <?php if($act == ''){echo "disabled";} ?>>Log in</button> -->
                        <button class="btn btn-success btn-login btn-cbd font-weight-bold" type="submit">Log in</button>
                      </div>
                    </div>
                 
                  

                </form>
              </div>
            </div>
          </div>
          
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
</body>