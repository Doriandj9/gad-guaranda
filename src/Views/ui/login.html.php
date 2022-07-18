<?php if(isset($error)): ?>
        <p class="error">
            <?= $error ?>
        </p>
<?php endif; ?>    

<div class="container-form">
    <h1>Inicio de session</h1>
    <form action="" method="post">
        <label for="">Ingrese su numero de cedula</label>
        <input type="text" name="cedula">
        <label for="">Ingrese su clave</label>
        <div class="ojo raya">
        <input type="password" name="password" id="">
        <span class="material-icons visible" id="eye">&#xe8f4;</span>
        </div>
        <button type="submit" class="button-submit">Ingresar</button>
    </form>
</div>