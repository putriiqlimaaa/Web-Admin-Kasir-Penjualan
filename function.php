<?php

session_start();

//Bikin koneksi
$c = mysqli_connect('localhost','root','','rakab');

//Login
if(isset($_POST['login'])){
    //Initiate variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($c,"SELECT * FROM user WHERE username='$username' and password='$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung>0){
        //Jika datanya ditemukan
        //berhasil login

        $_SESSION['login'] = 'True';
        header('location:index.php');
    } else {
        //Data tidak ditemukan
        //gagal login
        echo '
        <script>alert("Username atau Password salah");
        window.location.href="login.php"
        </script>
        ';
    }
}


//edit user
if(isset($_POST['edituser'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $iduser = $_POST['iduser']; 

    $query = mysqli_query($c, "update user set username='$username', password='$password' where iduser='$iduser' ");

    if($query){
        header('location:index.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="index.php"
        </script>
        ';
    }

}


//hapus user
if(isset($_POST['hapususer'])){
    $iduser = $_POST['iduser'];

    $query = mysqli_query($c, "delete from user where iduser='$iduser'");

    if($query){
        header('location:index.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="index.php"
        </script>
        ';
    }
}


//tambahuser
if(isset($_POST['tambahuser'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $insert = mysqli_query($c, "insert into user(username,password) values ('$username', '$password')");

    if($insert){
        header('location:index.php');
    } else {
        echo '
        <script>alert("Gagal menambah user baru");
        window.location.href="index.php"
        </script>
        ';
    }

}


//edit makanan
if(isset($_POST['editmakanan'])){
    $namamakanan = $_POST['namamakanan'];
    $harga = $_POST['harga'];
    $idp = $_POST['idp']; //idproduk

    $query = mysqli_query($c, "update datamakanan set namamakanan='$namamakanan', harga='$harga' where idmakanan='$idp' ");

    if($query){
        header('location:datamakanan.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="datamakanan.php"
        </script>
        ';
    }

}

//hapus makanan
if(isset($_POST['hapusmakanan'])){
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "delete from datamakanan where idmakanan='$idp'");

    if($query){
        header('location:datamakanan.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="datamakanan.php"
        </script>
        ';
    }
}


//tambah data makanan
if(isset($_POST['tambahdatamakanan'])){
    $namamakanan = $_POST['namamakanan'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $insert = mysqli_query($c, "insert into datamakanan(namamakanan,harga,stok) values ('$namamakanan', '$harga', '$stok')");

    if($insert){
        header('location:datamakanan.php');
    } else {
        echo '
        <script>alert("Gagal menambah data makanan baru");
        window.location.href="datamakanan.php"
        </script>
        ';
    }

}

//hapus pesanan
if(isset($_POST['hapuspesanan'])){
    $idpesanan = $_POST['idpesanan'];

    $cekdata = mysqli_query($c, "select * from detailpesanan dp where idpesanan='$idpesanan' ");

    while($oke=mysqli_fetch_array($cekdata)){
        //balikin stok
        $qty = $oke['qty'];
        $idmakanan = $oke['idmakanan'];
        $iddp = $oke['iddetailpesanan'];

        //cari tahu stok sekarang berapa
        $caristok = mysqli_query($c, "select * from datamakanan where idmakanan='$idmakanan' ");
        $caristok2 = mysqli_fetch_array($caristok);
        $stoksekarang = $caristok2['stok'];
        
        $newstok = $stoksekarang+$qty;

        $queryupdate = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan'");

        //hapus data
        $querydelete = mysqli_query($c, "delete from detailpesanan where iddetailpesanan='$iddp'");

    }

    $query = mysqli_query($c, "delete from pesanan where idpesanan='$idpesanan'");

    if($queryupdate && $querydelete && $query){
        header('location:pesanan.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="pesanan.php"
        </script>
        ';
    }
}

//tambah pesanan
if(isset($_POST['tambahpesanan'])){
    $namapelanggan = $_POST['namapelanggan'];


    $insert = mysqli_query($c, "insert into pesanan(namapelanggan) values ('$namapelanggan')");
    if($insert){
        header('location:pesanan.php');
    } else {
        echo '
        <script>alert("Gagal menambah data pesanan baru");
        window.location.href="pesanan.php"
        </script>
        ';
    }

}

//edit detail pesanan
if(isset($_POST['editdatatambahmakanan'])){
    $qty = $_POST['qty'];
    $iddp = $_POST['iddetailpesanan'];
    $idmakanan= $_POST['idmakanan'];
    $idp = $_POST['idp']; //id pesanan

    //cari tahu qty sekarang berapa
    $caritahu = mysqli_query($c, "select * from detailpesanan where iddetailpesanan='$iddp' ");
    $caritahu2 = mysqli_fetch_array($caritahu);
    $qtysekarang = $caritahu2['qty'];

    //cari tahu berapa stok yang ada sekarang
    $caristok = mysqli_query($c, "select * from datamakanan where idmakanan='$idmakanan' ");
    $caristok2 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok2['stok'];

    if($qty >= $qtysekarang){
        //kalau inputan user lebih besar daripada qty yang tercatat
        //hitung selisih
        $selisih = $qty-$qtysekarang;
        $newstok = $stoksekarang-$selisih;

        $query1 = mysqli_query($c, "update detailpesanan set qty='$qty' where iddetailpesanan='$iddp' ");
        $query2 = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan' ");

        if($query1&&$query2){
            header('location:view.php?idp='.$idp);
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="view.php?idp='.$idp.'"
            </script>
            ';
        }

    } else {
        //kalau lebih kecil
        $selisih = $qtysekarang-$qty;
        $newstok = $stoksekarang+$selisih;

        $query1 = mysqli_query($c, "update detailpesanan set qty='$qty' where iddetailpesanan='$iddp' ");
        $query2 = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan' ");

        if($query1&&$query2){
            header('location:view.php?idp='.$idp);
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="view.php?idp='.$idp.'"
            </script>
            ';
        }
    }
}

//hapus laporan pesanan
if(isset($_POST['hapustambahpesanan'])){
    $idp = $_POST['idp'];
    $idmakanan = $_POST['idmakanan'];
    $idpesanan = $_POST['idpesanan'];

    $cek1 = mysqli_query($c, "select * from detailpesanan where iddetailpesanan='$idp'");
    $cek2 = mysqli_fetch_array($cek1);
    $qtysekarang = $cek2['qty'];

    $cek3 = mysqli_query($c, "select * from datamakanan where idmakanan='$idmakanan'");
    $cek4 = mysqli_fetch_array($cek3);
    $stoksekarang = $cek4['stok'];

    $hitung = $stoksekarang+$qtysekarang;

    $update = mysqli_query($c, "update datamakanan set stok='$hitung' where idmakanan='$idmakanan'");
    $hapus = mysqli_query($c, "delete from detailpesanan where idmakanan='$idmakanan' and iddetailpesanan='$idp'");

    if($update&&$hapus){
            header('location:view.php?idp='.$idpesanan);
        } else {
            echo '
            <script>alert("Gagal menghapus makanan");
            window.location.href="view.php?idp='.$idpesanan.'"
            </script>
            ';
        }
    }

//add makanan
if(isset($_POST['addmakanan'])){
    $idmakanan = $_POST['idmakanan'];
    $idp = $_POST['idp'];
    $qty = $_POST['qty'];

    //hitung stok sekarang ada berapa
    $hitung1 = mysqli_query($c, "select * from datamakanan where idmakanan='$idmakanan'");
    $hitung2 = mysqli_fetch_array($hitung1);
    $stoksekarang = $hitung2['stok']; //stok barang saat ini

    if($stoksekarang>=$qty){
        
        //kurangi stok dengan jumlah yang akan dikeluarkan
        $selisih = $stoksekarang-$qty;

        //stok cukup
        $insert = mysqli_query($c, "insert into detailpesanan(idpesanan,idmakanan,qty) values ('$idp', '$idmakanan', '$qty')");
        $update = mysqli_query($c, "update datamakanan set stok='$selisih' where idmakanan='$idmakanan'");

        if($insert&&$update){
            header('location:view.php?idp='.$idp);
        } else {
            echo '
            <script>alert("Gagal menambah pelanggan baru");
            window.location.href="view.php?idp='.$idp.'"
            </script>
            ';
        }

    } else {
        //stok tidak cukup
        echo '
        <script>alert("Gagal menambah makanan");
        window.location.href="view.php?idp='.$idp.'"
        </script>
        ';
    }

}

//edit pelanggan
if(isset($_POST['editpelanggan'])){
    $namapelanggan = $_POST['namapelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    $idpelanggan = $_POST['idpelanggan']; //idproduk

    $query = mysqli_query($c, "update pelanggan set namapelanggan='$namapelanggan', notelp='$notelp', alamat='$alamat' where idpelanggan='$idpelanggan' ");

    if($query){
        header('location:pelanggan.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="pelanggan.php"
        </script>
        ';
    }

}

//hapus pelanggan
if(isset($_POST['hapuspelanggan'])){
    $idpelanggan = $_POST['idpelanggan'];

    $query = mysqli_query($c, "delete from pelanggan where idpelanggan='$idpelanggan'");

    if($query){
        header('location:pelanggan.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="pelanggan.php"
        </script>
        ';
    }
}

//tambah pelanggan
if(isset($_POST['tambahpelanggan'])){
    $namapelanggan = $_POST['namapelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($c, "insert into pelanggan(namapelanggan,notelp,alamat) values ('$namapelanggan', '$notelp', '$alamat')");

    if($insert){
        header('location:pelanggan.php');
    } else {
        echo '
        <script>alert("Gagal menambah pelanggan baru");
        window.location.href="pelanggan.php"
        </script>
        ';
    }

}

//mengubah data barang masuk
if(isset($_POST['editdatapenambahanmakanan'])){
    $qty = $_POST['qty'];
    $idmasuk = $_POST['idmasuk'];
    $idmakanan= $_POST['idmakanan'];

    //cari tahu qty sekarang berapa
    $caritahu = mysqli_query($c, "select * from masuk where idmasuk='$idmasuk' ");
    $caritahu2 = mysqli_fetch_array($caritahu);
    $qtysekarang = $caritahu2['qty'];

    //cari tahu berapa stok yang ada sekarang
    $caristok = mysqli_query($c, "select * from datamakanan where idmakanan='$idmakanan' ");
    $caristok2 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok2['stok'];

    if($qty >= $qtysekarang){
        //kalau inputan user lebih besar daripada qty yang tercatat
        //hitung selisih
        $selisih = $qty-$qtysekarang;
        $newstok = $stoksekarang+$selisih;

        $query1 = mysqli_query($c, "update masuk set qty='$qty' where idmasuk='$idmasuk' ");
        $query2 = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan' ");

        if($query1&&$query2){
            header('location:masuk.php');
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="masuk.php"
            </script>
            ';
        }

    } else {
        //kalau lebih kecil
        $selisih = $qtysekarang-$qty;
        $newstok = $stoksekarang-$selisih;

        $query1 = mysqli_query($c, "update masuk set qty='$qty' where idmasuk='$idmasuk' ");
        $query2 = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan' ");

        if($query1&&$query2){
            header('location:masuk.php');
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="masuk.php"
            </script>
            ';
        }
    }
}

//hapus penambahan makanan
if(isset($_POST['hapustambahmakanan'])){
    $idmasuk = $_POST['idmasuk'];
    $idmakanan = $_POST['idmakanan'];

    //cari tahu qty sekarang berapa
    $caritahu = mysqli_query($c, "select * from masuk where idmasuk='$idmasuk' ");
    $caritahu2 = mysqli_fetch_array($caritahu);
    $qtysekarang = $caritahu2['qty'];

    //cari tahu berapa stok yang ada sekarang
    $caristok = mysqli_query($c, "select * from datamakanan where idmakanan='$idmakanan' ");
    $caristok2 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok2['stok'];

    //kalau selisih
    $newstok = $stoksekarang-$qtysekarang;

    $query1 = mysqli_query($c, "delete from masuk where idmasuk='$idmasuk' ");
    $query2 = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan' ");

    if($query1&&$query2){
        header('location:masuk.php'
    );
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="masuk.php"
        </script>
        ';
    }

}

//Menambah stok makanan
if(isset($_POST['penambahanmakanan'])){
    $idmakanan = $_POST['idmakanan'];
    $qty = $_POST['qty'];
    

    //cari tahu berapa stok yang ada sekarang
    $caristok = mysqli_query($c, "select * from datamakanan where idmakanan='$idmakanan' ");
    $caristok2 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok2['stok'];

    //hitung
    $newstok = $stoksekarang+$qty;

    $insertpenambahanmakanan = mysqli_query($c, "insert into masuk(idmakanan,qty) values('$idmakanan', '$qty')");
    $updatepenambahanmakanan = mysqli_query($c, "update datamakanan set stok=$newstok where idmakanan='$idmakanan' ");

    if($insertpenambahanmakanan&&$updatepenambahanmakanan){
        header('location:masuk.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="masuk.php"
        </script>
        ';

    }

}

//edit tambah pesanan
if(isset($_POST['edittambahpesanan'])){
    $qty = $_POST['qty'];
    $iddetailpesanan = $_POST['iddetailpesanan'];
    $idmakanan= $_POST['idmakanan'];
    $namamakanan= $_POST['namamakanan'];
    $qty= $_POST['qty'];
    $harga= $_POST['harga'];

    $idpesanan= $_POST['idpesanan'];

    //cari tahu qty sekarang berapa
    $caritahu = mysqli_query($c, "select * from detailpesanan where iddetailpesanan='$iddetailpesanan' ");
    $caritahu2 = mysqli_fetch_array($caritahu);
    $qtysekarang = $caritahu2['qty'];

    //cari tahu berapa stok yang ada sekarang
    $caristok = mysqli_query($c, " * from datamakanan where idmakanan='$idmakanan' ");
    $caristok2 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok2['stok'];

    if($qty >= $qtysekarang){
        //kalau inputan user lebih besar daripada qty yang tercatat
        //hitung selisih
        $selisih = $qty-$qtysekarang;
        $newstok = $stoksekarang-$selisih;

        $query1 = mysqli_query($c, "update detailpesanan set qty='$qty' where iddetailpesanan='$iddetailpesanan' ");
        $query2 = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan' ");

        if($query1&&$query2){
            header('location:view.php?idp='.$idp);
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="view.php?idp=.$idp"
            </script>
            ';
        }

    } else {
        //kalau lebih kecil
        $selisih = $qtysekarang-$qty;
        $newstok = $stoksekarang+$selisih;

        $query1 = mysqli_query($c, "update detailpesanan set qty='$qty' where iddetailpesanan='$iddetailpesanan' ");
        $query2 = mysqli_query($c, "update datamakanan set stok='$newstok' where idmakanan='$idmakanan' ");

        if($query1&&$query2){
            header('location:view.php?idp='.$idp);
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="view.php?idp=.$idp"
            </script>
            ';
        }
    }
}

//tambah transaksi
if(isset($_POST['tambahtransaksi'])){
    $namapelanggan = $_POST['namapelanggan'];
    $totalbelanja = $_POST['totalbelanja'];
    $uangbayar = $_POST['uangbayar'];

    $insert = mysqli_query($c, "insert into transaksi(namapelanggan,totalbelanja,uangbayar) values ('$namapelanggan','$totalbelanja', '$uangbayar')");

    if($insert){
        header('location:transaksi.php');
    } else {
        echo '
        <script>alert("Gagal menambah transaksi baru");
        window.location.href="transaksi.php"
        </script>
        ';
    }

}

//edit transaksi
if(isset($_POST['edittransaksi'])){
    $totalbelanja = $_POST['totalbelanja'];
    $uangbayar = $_POST['uangbayar']; 
    $idtransaksi = $_POST['idtransaksi'];


    $query = mysqli_query($c, "update transaksi set totalbelanja='$totalbelanja', uangbayar='$uangbayar' where idtransaksi='$idtransaksi' ");

    if($query){
        header('location:transaksi.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="transaksi.php"
        </script>
        ';
    }

}

//hapus transaksi
if(isset($_POST['hapustransaksi'])){
    $idtransaksi = $_POST['idtransaksi'];

    $query = mysqli_query($c, "delete from transaksi where idtransaksi='$idtransaksi'");

    if($query){
        header('location:transaksi.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="transaksi.php"
        </script>
        ';
    }
}

?>