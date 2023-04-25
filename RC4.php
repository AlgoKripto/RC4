<?php
function RC4($teks, $pass) {
   
   $panjangkunci=32;  // boleh diganti bebas menjadi dengan angka lain, misalnya 64, 128, 192, 256

   if ($panjangkunci > strlen($pass) {
       $dupkey = ceil($panjangkunci / strlen($pass));
       for($i=0; $i < $dupkey; $i++) $pass .= $pass;
   }
   $pass = substr($pass, 0, $panjangkunci);

   $hasil = "";
   $SBox = [];
   for ($i=0; $i<256; $i++) $SBox[$i] = $i;

   $j=0;
   for ($i=0; $i<256; $i++) {
      $j = ($j + $SBox[$i] + ord(substr($pass, $i % $panjangkunci, 1))) % 256;
      // swap $SBox[$i], $SBox[$j]
      $temp = $SBox[$i];
      $SBox[$i] = $SBox[$j];
      $SBox[$j] = $temp;
   }

   $i=0;
   $j=0;
   for ($idx=0; $idx < strlen($pt); $idx++) {
      $i = ($i + 1) % 256;
      $j = ($j + $SBox[$i]) % 256;
      $temp = $SBox[$i];
      $SBox[$i] = $SBox[$j];
      $SBox[$j] = $temp;
      $t= ($SBox[$i] + $SBox[$j]) % 256;
      $k = $SBox[$t];
      $hasil .= chr(ord(substr($pt, $idx, 1)) ^ $k);
   }
   return $hasil;
}
?>