<?php 
include 'top.php';
if (isset($_GET['id']) && isset($_GET['idn'])){
    $id = $_GET['id'];
    $id = addslashes($id);
    $idn = $_GET['idn'];
    $idn = addslashes($idn);
    $dt->select("SELECT * FROM nhomtin WHERE idNhom ='$idn'");
    $rn = $dt->fetch();
    echo "<div class='noidung col col-xl-6 card card-body container'>";
        echo "<h4 class='card-header'>".$rn['tenNhom']."</h4>";
        echo "<div class='col col-md-3 right align-self-end' style='float:right;'>";
        if(isset($role) && $role == 2){
            echo "<ul class='navbar' align='right'>";
                echo "<li><a class='nav-link' href='newsupdate.php?id=$id&idn=$idn'>Sửa<i style='color:#000000' class='fa-solid fa-pen fa-lg'></i> </a></li>";
                echo "<li><a class='nav-link' href='newsdelete.php?id=$id'>Xóa <i style='color:#000000' class='fa-solid fa-trash fa-lg'></i></a></li>";
               
                }
            echo "</ul>";
        echo "</div>";
    $dt->select("SELECT * FROM bangtin WHERE idTin='$id'");
    $r = $dt->fetch();

    echo "<h4>".$r['tieude']."</h4>";
    echo "<h5>".$r['trichdan']."</h5>";
    $anh = $r['anhtrichdan'];
    
    if ($r['anhtrichdan'] != null) {
        echo "<img src ='imgs/$anh' style='width:100px;height:70px;'> ";
    }
    
    echo "<p align='justify'>".$r['noidung']."</p>";
    echo "<h4>Xem thêm:</h4>";

    $dt->select("SELECT * FROM bangtin WHERE idTin !='$id' AND idNhom='$idn' ORDER BY idTin DESC LIMIT 10");
    while($row = $dt->fetch()){
        $idTin= $row['idTin'];
        $tieude = $row['tieude'];
        echo "<a href ='newsdetail.php?idn=$idn&id=$idTin'>$tieude</a><br></br>";
    }
}else{
    header('location:index.php');
}
?></div>

<?php 
include 'right.php';
?>