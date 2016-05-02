<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<form method="POST">
    <fieldset>
        <legend>
            Fechar o arquivo
        </legend>
        <label>
            chave
        </label>
        <input name="chave">
        <label>
            texto
        </label>
        <input name="texto">
        <button name="acao" value="f" type="submit">
            Fechar
        </button>
    </fieldset>
</form>

<form method="POST">
    <fieldset>
        <legend>
            Abrir o arquivo
        </legend>
        <label>
            chave
        </label>
        <input name="chave">
        <button name="acao" value="a" type="submit">
            Abrir
        </button>
    </fieldset>
</form>
<?php

$acao = $_POST['acao'];
$plaintext = $_POST['texto'];
$key = $_POST['chave'];
$iv = 1;

if ($acao == 'f')
{
    unlink("bloco1.txt");

    $ciphertext = $plaintext ? openssl_encrypt($plaintext,  'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv) : null;
    $fp = fopen("bloco1.txt", "a");
    $escreve = fwrite($fp, $ciphertext);
    fclose($fp);
}

if ($acao == 'a')
{
    $file = file ('bloco1.txt');
    $plaintext  = openssl_decrypt($file[0], 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
    echo $plaintext;
}
?>
