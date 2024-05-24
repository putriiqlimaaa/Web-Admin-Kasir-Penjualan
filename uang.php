<?php
require 'ceklogin.php';


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Rakab Mercon</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                User
                            </a>
                            <a class="nav-link" href="datamakanan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                                Laporan Data Makanan
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Laporan Pelanggan
                            </a>
                            <a class="nav-link" href="pesanan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                                Laporan Data Pesanan
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                                Penambahan Makanan
                            </a>
                            </a>
                            <a class="nav-link" href="transaksi.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bills"></i></div>
                                Laporan Transaksi
                            </a>
                            <a class="nav-link" href="uang.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-money-check"></i></div>
                                Laporan Uang
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <ol class="breadcrumb mb-4">
                        </ol>

                        <a href="exportuang.php" class="btn btn-info mb-4">Export Data</a>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pesanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Makanan</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $get = mysqli_query($c, "select * from detailpesanan p, datamakanan pr where p.idmakanan=pr.idmakanan");
                                    $i = 1; //penomoran
                                    $total=0;

                                    while($p=mysqli_fetch_array($get)){
                                        $idmakanan = $p['idmakanan'];
                                        $iddetailpesanan = $p['iddetailpesanan'];
                                        $idp= $p['idpesanan'];
                                        $tanggal = $p['tanggal'];
                                        $qty = $p['qty'];;
                                        $harga = $p['harga'];
                                        $namamakanan = $p['namamakanan'];
                                        $subtotal = $qty*$harga;
                                        $total+=$subtotal;


                                    ?>



                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$namamakanan;?></td>
                                            <td>Rp<?=number_format($harga);?></td>
                                            <td><?=number_format($qty);?></td>
                                            <td>Rp<?=number_format($subtotal);?></td>
                                    <?php
                                    }; //end of while

                                    ?>

                                    <tr>
                                        <td colspan='5'><center>Total</center></td>
                                        <td>Rp<?=number_format($total);?></td>
                                    </tr>
                                        


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

   
</html>