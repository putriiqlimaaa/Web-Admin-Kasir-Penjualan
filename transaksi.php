<?php
require 'ceklogin.php';

// hitung jumlah transaksi
$h1 = mysqli_query($c, "select * from transaksi");
$h2 = mysqli_num_rows($h1); //jumlah transaksi
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
                        <h1 class="mt-4">Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Transaksi : <?=$h2;?></div>
                                </div>
                            </div>

                        </div>

                        <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                  Tambah Data Transaksi
                                </button>
                                <a href="exporttransaksi.php" class="btn btn-info mb-4">Export Data</a>



                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Transaksi
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Total Belanja</th>
                                            <th>Uang Bayar</th>
                                            <th>Uang Kembalian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $get = mysqli_query($c, "select * from transaksi");
                                    $i = 1220000001; //penomoran

                                    while($p=mysqli_fetch_array($get)){
                                    $namapelanggan = $p['namapelanggan'];
                                    $totalbelanja = $p['totalbelanja'];
                                    $uangbayar = $p['uangbayar'];
                                    $kembalian = $uangbayar-$totalbelanja;
                                    $idtransaksi = $p['idtransaksi'];

                                    ?>



                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namapelanggan;?></td>
                                            <td>Rp<?=number_format($totalbelanja);?></td>
                                            <td>Rp<?=number_format($uangbayar);?></td>
                                            <td>Rp<?=number_format($kembalian);?></td>
                                            <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idtransaksi;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idtransaksi;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>


                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?=$idtransaksi;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah <?=$namapelanggan;?></h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="post">

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <input type="text" name="namapelanggan" class="form-control" placeholder="<?=$namapelanggan;?>" values="<?=$namapelanggan;?>" disabled>
                                                <input type="num" name="totalbelanja" class="form-control mt-2" placeholder="Total Belanja" values="<?=$totalbelanja;?>">
                                                <input type="num" name="uangbayar" class="form-control mt-2" placeholder="Uang Bayar" values="<?=$uangbayar;?>">
                                                <input type="hidden" name="idtransaksi" value="<?=$idtransaksi;?>">
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="edittransaksi">Submit</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>

                                            </form>

                                            </div>
                                        </div>
                                        </div>


                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete<?=$idtransaksi;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data Transaksi</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="post">

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus transaksi ini?
                                                <input type="hidden" name="idtransaksi" value="<?=$idtransaksi;?>">
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="hapustransaksi">Submit</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>

                                            </form>

                                            </div>
                                        </div>
                                        </div>

                                    <?php
                                    }; //end of while

                                    ?>
                                        


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


    <!-- The Modal -->
    <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Transaksi</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="post">

      <!-- Modal body -->
      <div class="modal-body">
        Pilih Pelanggan
        <select name="namapelanggan" class="form-control">

        <?php
        $getpelanggan = mysqli_query($c, "select * from pelanggan");

        while($pl=mysqli_fetch_array($getpelanggan)){
           $namapelanggan = $pl['namapelanggan'];
           $alamat = $pl['alamat'];
        ?>

        <option value="<?=$namapelanggan;?>"><?=$namapelanggan;?> - <?=$alamat;?></option>

        <?php
        }
        ?>

        </select>
          <input type="num" name="totalbelanja" class="form-control mt-2" placeholder="Total Belanja">
          <input type="num" name="uangbayar" class="form-control mt-2" placeholder="Uang Bayar">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="tambahtransaksi">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

      </form>

    </div>
  </div>
</div>


</html>
