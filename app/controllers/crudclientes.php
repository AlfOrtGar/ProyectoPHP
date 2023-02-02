<?php

function crudBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarCliente($id);
}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function crudAlta(){
    $cli = new Cliente();
    $orden= "Nuevo";
    //Añado una sentencia para que coja el ultimo id
    //Para que al llegar a formulario.php no haya que diferenciar entre nuevo y modificado
    $db=AccesoDatos::getModelo();
    $cli->id=$db->UltimoID();
    include_once "app/views/formulario.php";
}

function crudDetalles($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}

//Relleno las funciones para siguiente y anterior con las funciones ya definidas
//Añado un condicional para que si no existe se quede en el mismo, porque si no da error en el primer y último cliente
function crudDetallesSiguiente($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id);
    if(!$cli){
        crudDetalles($id);
    }
    else{
        include_once "app/views/detalles.php";
    }
}
function crudDetallesAnterior($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id);
    if(!$cli){
        crudDetalles($id);
    }
    else{
        include_once "app/views/detalles.php";
    }
}

//Añado la funcion para imprimir los datos, que me hace los mismo que crudDetalles, pero redirecciona a una nueva página
function crudDetallesImprimir($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/pdf.php";
}

//Creo las mismas funciones para modificar tanto el anterior como el siguiente
//Aunque añado la orden Modificar para que formulario.php lo reconozca como una modificación
function crudModificarSiguiente($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id);
    $orden="Modificar";
    if(!$cli){
        crudModificar($id);
    }
    else{
        include_once "app/views/formulario.php";
    }
}
function crudModificarAnterior($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id);
    $orden="Modificar";
    if(!$cli){
        crudModificar($id);
    }
    else{
        include_once "app/views/formulario.php";
    }
}


function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";
    include_once "app/views/formulario.php";
}


//Creo funciones para comprobar los datos telefono e IP (Ejercicio 4)
//El mail se tiene que hacer mediante una consulta
//La ip tiene una funcion ya definida en PHP
function comprobarIP($ip){
    $correcto=false;
    if(filter_var($ip,FILTER_VALIDATE_IP)){
        $correcto=true;
    }
    return $correcto;
}
//Y el telefono hay que comprobar el tipo y numero de digitos
function comprobarTel($tel){
    $correcto=false;
    if(preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3,4}$/',$tel)){
        $correcto=true;
    }
    return $correcto;
}


//Y añado las comprobaciones de los tres campos al alta y la modificación
//Para eso añado la variable correcto, si todo está bien, ejecuta, si no, te vuelve a mandar al formulario
function crudPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();
    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $correcto=true;
    if(comprobarTel($cli->telefono)==false){
        $correcto=false;
    }
    if(comprobarIP($cli->ip_address)==false){
        $correcto=false;
    }
    if($db->comprobarMail($cli->email)){
        $correcto=false;
    }
    if($correcto==true){
        nuevaFoto($cli->id);
        $db->addCliente($cli);
    }
    else{
        $orden="Nuevo";
        include_once "app/views/formulario.php";
    }
}

function crudPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $cli = new Cliente();

    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();
    $correcto=true;
    if(comprobarTel($cli->telefono)==false){
        $correcto=false;
    }
    if(comprobarIP($cli->ip_address)==false){
        $correcto=false;
    }
    if($db->comprobarMail($cli->email)){
        $correcto=false;
    }
    if($correcto==true){
        nuevaFoto($cli->id);
        $db->modCliente($cli);
    }
    else{
        $orden="Modificar";
        include_once "app/views/formulario.php";
    }
    
}

//Añado una función para encontrar la bandera del pais
function banderaNacional($ip) {
    $band=substr(file_get_contents('http://ip-api.com/json/'.$ip.'?fields=countryCode'),16,2);
    $extrac=@json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    if($extrac->geoplugin_countryCode==null){
        echo "<img src='app/uploads/NoFlag.jpg' width='20' alt='No hay bandera'>";
    }
    else{
        $fragmento=$extrac->geoplugin_countryCode;
        echo "<img src='https://flagcdn.com/".strtolower($fragmento).".svg' width='10' alt='Bandera del pais'>";
    }
}


//Añado una función para mostrar una imagen para cada usuario
//Si existe una guardada se usa esa, si no, se genera una de la url
function fotoCliente($id){
    $direccion="app/uploads/00000".$id."jpg"
    if(!file_exists($direccion)){
        $direccion="https://robohash.org/00000".$id;
    }
    return $direccion;
}

//Y añado una funcion para cambiarla
//Se ejecuta cuando se postea tanto en Nuevo como en Modificar, pero no cuando se añade, para solo hacerlo una vez por cambio
//Hay que comprobar que tenga nombre, que sea un formato válido y que pese menos de un mega. Ademas de si existe ya o no
function nuevaFoto($id){
    $ruta="app/uploads/00000".$id."jpg";
    $nombre=$_FILES['cambio']['name'];
    $tipo=$_FILES['cambio']['type'];
    $peso=$_FILES['cambio']['size'];

    if($nombre!=""){
        if($peso<=1000000){
            if($tipo=="jpg"){
                if(file_exists($ruta)){
                    unlink($ruta);
                    move_uploaded_file($_FILES['cambio']['tmp_name'],$ruta);
                }
                else{
                    move_uploaded_file($_FILES['cambio']['tmp_name'],$ruta);
                }
            }
            else{
                echo "<script>alert('El formato de la imagen no es valido');</script>"
            }
        }
        else{
            echo "<script>alert('La imagen supera el tamaño permitido');</script>"
        }
    }
    else{
        echo "<script>alert('No hay nueva imagen');</script>"
    }
}

