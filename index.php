<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body class="container">
    <form method="POST">
        <fieldset>
            <legend>
                Fechar o arquivo
            </legend>
            <label>
                Chave
            </label>
            <input  class="form-control" name="chave">
            <label>
                texto
            </label>
            <textarea class="form-control" name="texto"></textarea>
            <button class="btn" name="acao" value="f" type="submit">
                Fechar
            </button>
        </fieldset>
    </form>
<hr>
    <form method="POST">
        <fieldset>
            <legend>
                Abrir o arquivo
            </legend>
            <label>
                chave
            </label>
            <input  class="form-control" name="chave">
            <button class="btn" name="acao" value="a" type="submit">
                Abrir
            </button>
        </fieldset>
    </form>
<body>
</html>
<?php

$acao = $_POST['acao'];
$plaintext = $_POST['texto'];
$key = $_POST['chave'];
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));

if ($acao == 'f')
{
    unlink("bloco1.txt");

    $ciphertext = $plaintext ? openssl_encrypt($plaintext,  'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv) : null;


    echo  hash_hmac ('sha512', $ciphertext , $key);

    $fp = fopen("bloco1.txt", "a");
    $escreve = fwrite($fp, $ciphertext);
    fclose($fp);
}

if ($acao == 'a')
{
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
    $file = file ('bloco1.txt');
    $plaintext  = openssl_decrypt($file[0], 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);

    echo  hash_hmac ('sha512', $file[0] , $key).'<br>';

    echo $plaintext;
}
?>
