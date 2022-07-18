<?php if(isset($error)): ?>
        <p class="error">
            <?= $error ?>
        </p>
<?php endif; ?>    
<?php if(isset($success)): ?>
        <p class="success">
            <?= $success ?>
        </p>
<?php endif; ?>  
<div class="container-form">
    <h1>Ingresar un Agente Municipal</h1>
    <form action="" method="post">
        <label for="">Ingrese el numero de cedula</label>
        <input type="text" name="cedula">
        <label for="">Ingrese el nombre del Agente</label>
        <input type="text" name="nombre">
        <label for="">Ingrese una clave para el agente</label>
        <div class="ojo raya">
        <input type="password" name="password" id="">
        <span class="material-icons visible" id="eye">&#xe8f4;</span>
        </div>
        <button type="submit" class="button-submit">Registrar</button>
    </form>
</div>