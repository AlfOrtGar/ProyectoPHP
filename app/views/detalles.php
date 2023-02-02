<hr>
<button onclick="location.href='./'" > Volver </button>
<br><br>
<table>
    <tr>
        <td>ID</td> 
        <td><input type="number" name="id" value="<?=$cli->id ?>"  readonly > </td>
        <td rowspan="7"><img src="<?=fotoCliente($cli->id)?>"></img></td> 
    </tr>
    <tr>
        <td>Nombre</td> 
        <td><input type="text" name="first_name" value="<?=$cli->first_name ?>" readonly > </td>
    </tr>
    <tr>
        <td>Apellido</td> 
        <td><input type="text" name="last_name" value="<?=$cli->last_name ?>" readonly ></td>
    </tr>
    <tr>
        <td>Bandera de su país</td>
        <td rowspan="7"><?=banderaNacional($cli->ip_address)?></td>
    </tr>
    <tr>
        <td>Email</td> 
        <td><input type="email" name="email" value="<?=$cli->email ?>"   readonly  ></td>
    </tr>
    <tr>
        <td>Género</td> 
        <td><input type="text" name="gender" value="<?=$cli->gender ?>" readonly ></td>
    </tr>
    <tr>
        <td>Dirección IP</td> 
        <td><input type="text" name="ip_address" value="<?=$cli->ip_address ?>" readonly ></td>
    </tr>
    <tr>
        <td>Teléfono</td> 
        <td><input type="tel" name="telefono" value="<?=$cli->telefono ?>" readonly ></td>
    </tr>
 </table>
 
<form>
    <input type="hidden"  name="id" value="<?=$cli->id ?>">
    <button type="submit" name="nav-detalles" value="Anterior">⇦⇦ Anterior</button>
    <button type="submit" name="nav-detalles" value="Siguiente"> Siguiente ⇨⇨</button>
    <button type="submit" name="nav-detalles" value="Imprimir">⇩ Imprimir ⇩</button>
</form> 


