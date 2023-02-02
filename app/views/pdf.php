<?php

require_once "vendor/autoload.php";
require_once "app/controllers/crudclientes.php";

$html = "<!DOCTYPE html>
<html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Datos de $cli->first_name</title>
        <link href="web/css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>Datos de $cli->first_name $cli->last_name</h1>
        <table>
            <tr>
                <td>ID:</td>
                <td>$cli->id</td>

            </tr>
            <tr>
                <th>Nombre:</th>
                <td>$cli->first_name</td>
            </tr>
            <tr>
                <th>Apellido:</th>
                <td>$cli->last_name</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>$cli->email</td>
            </tr>
            <tr>
                <th>Género:</th>
                <td>$cli->gender</td>
            </tr>
            <tr>
                <th>IP:</th>
                <td>$cli->ip_address</td>
            </tr>
            <tr>
                <th>Teléfono:</th>
                <td>$cli->telefono</td>
            </tr>
            </table>
    </body>
</html>";

$mpdf = new \Mpdf\Mpdf;
$mpdf->WriteHTML($html);
$mpdf->Output();