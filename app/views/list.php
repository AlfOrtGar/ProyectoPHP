
<form>
    <button type="submit" name="orden" value="Nuevo"> Cliente Nuevo </button><br>
</form>
<br>

<table>
    <tr>
        <th><a href="?valor=id&orden=Filtrar">ID</button></th>
        <th><a href="?valor=first_name&orden=Filtrar">Nombre</button></th>
        <th><a href="?valor=email&orden=Filtrar">Email</button></th>
        <th><a href="?valor=gender&orden=Filtrar">Género</button></th>
        <th><a href="?valor=ip_address&orden=Filtrar">Dirección IP</button></th>
        <th><a href="?valor=telefono&orden=Filtrar">Teléfono</button></th>
    </tr>
    <?php foreach ($tvalores as $valor): ?>
    <tr>
        <td><?= $valor->id ?> </td>
        <td><?= $valor->first_name ?> </td>
        <td><?= $valor->email ?> </td>
        <td><?= $valor->gender ?> </td>
        <td><?= $valor->ip_address ?> </td>
        <td><?= $valor->telefono ?> </td>
        <td><a href="#" onclick="confirmarBorrar('<?=$valor->first_name?>',<?=$valor->id?>);" >Borrar</a></td>
        <td><a href="?orden=Modificar&id=<?=$valor->id?>">Modificar</a></td>
        <td><a href="?orden=Detalles&id=<?=$valor->id?>" >Detalles</a></td>
    </tr>
    <?php endforeach ?>
</table>

<form>
    <br>
    <button type="submit" name="nav" value="Primero"> ⇦⇦ </button>
    <button type="submit" name="nav" value="Anterior"> ⇦ </button>
    <button type="submit" name="nav" value="Siguiente"> ⇨ </button>
    <button type="submit" name="nav" value="Ultimo"> ⇨⇨ </button>
</form>
