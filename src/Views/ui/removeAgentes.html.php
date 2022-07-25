<div class="content-documentacion">
    <div class="list">
        <form action="" method="post">

            <table class="list">
                <thead> 
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Dar de Baja</th>
                </thead>
                <tbody>
                    <?php foreach($agentes as $agente): ?>
                            <tr class="<?php
                                          if(isset($agente->remove) && $agente->remove){
                                             echo 'remove-agentente';
                                          }              
                                    ?>">
                                <td><?= $agente->id ?? 'desconocido'; ?></td>
                                <td><?= $agente->nombre ?? 'desconocido'; ?></td>
                                <td>
                                    <input type="checkbox" <?php
                                          if(isset($agente->remove) && $agente->remove){
                                             echo 'checked';
                                          }              
                                    ?> name="" id="">
                                    
                                </td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button style="display:block; margin: 0.5rem auto;" class="button-submit" type="submit">Guardar Cambios</button>                          
        </form>
    </div>
</div>