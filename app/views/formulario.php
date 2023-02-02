
<hr>
<form   method="POST">
    <table>
        <tr>
            <td>ID</td> 
            <td><input type="number" name="id" value="<?=$cli->id ?>"  readonly  ></td>
        </tr>
        <tr>
            <td>Nombre</td> 
            <td><input type="text" name="first_name" value="<?=$cli->first_name ?>" autofocus  ></td>
        </tr>
        <tr>
            <td>Apellido</td> 
            <td><input type="text" name="last_name" value="<?=$cli->last_name ?>"  ></td>
        </tr>
        <tr>
            <td>Email</td> 
            <td><input type="email" name="email" value="<?=$cli->email ?>"  ></td>
        </tr>
        <tr>
            <td>Género</td> 
            <td><input type="text" name="gender" value="<?=$cli->gender ?>"  ></td>
        </tr>
        <tr>
            <td>Dirección IP</td> 
            <td><input type="text" name="ip_address" value="<?=$cli->ip_address ?>"  ></td>
        </tr>
        <tr>
            <td>Teléfono</td> 
            <td><input type="tel" name="telefono" value="<?=$cli->telefono ?>"  ></td>
        </tr>
        <tr>
            <td>Nueva foto</td>
            <td><input type="file" name="cambio" value="cambio"></td>
        </tr>
    </table>
    <input type="submit"	 name="orden" 	value="<?=$orden?>">
    <input type="submit"	 name="orden" 	value="Volver">
</form> 

