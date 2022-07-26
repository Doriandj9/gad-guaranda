<div class="content-documentacion">
    <div class="list">
        <form action="" method="post">

            <table class="list">
                <thead> 
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Estado Actual</th>
                    <th>Activar/Dar de baja</th>
                </thead>
                <tbody>
                    <?php $count = 0;
                    foreach($personales as $personal): ?>
                            <tr class="<?php
                                          if(isset($personal->estado) && $personal->estado === 'inactivo'){
                                             echo 'remove-agentente';
                                          }              
                                    ?>">
                                <td><?= $personal->id ?? 'desconocido'; ?></td>
                                <td><?= $personal->nombre ?? 'desconocido'; ?></td>
                                <td><?= $personal->estado ?? 'desconocido'; ?></td>
                                <td>
                                    <input type="checkbox" name="usuario<?= $count;?>[cargo]" id="">
                                    <input type="hidden" name="usuario<?= $count;?>[id]" value="<?= $personal->id;?>">
                                </td>
                            </tr>
                    <?php $count ++; endforeach; ?>
                </tbody>
            </table>
            <button style="display:block; margin: 0.5rem auto;" class="button-submit" type="submit">Guardar Cambios</button>                          
        </form>
    </div>
</div>