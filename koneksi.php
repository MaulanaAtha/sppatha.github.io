<?php

$conn = mysqli_connect('localhost','root','','sppsekolah');
if(!$conn) {
    throw new Exception("Database gagal terkoneksi", 1);
    
}


?>