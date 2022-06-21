<?php
function encrypt($data){
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
	$encryption_key = "guvi";
	$encryption = openssl_encrypt($data, $ciphering,
	$encryption_key, $options, $encryption_iv);
    return $encryption;
}

function decrypt($data){
    $ciphering = "AES-128-CTR";
    $decryption_iv = '1234567891011121';
    $options = 0;
   $decryption_key = "guvi";
   $decryption=openssl_decrypt ($data, $ciphering,
   $decryption_key, $options, $decryption_iv);
    return $decryption;
}
?>