<?php
/*echo '<pre>';
print_r($post);
echo '</pre>';*/
?>
<div class="row">
 <div class="col-xs-12">
   <div class="box box-danger">

     <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo $current_url;?>" method="post" role="form">
       <input type="hidden" name="id" value="<?php echo $post['id'];?>"><!-- web_checklist_data_id-->
       <div class="box-header" style="padding-bottom: 0;">
         <h3 class="box-title">
           <?php echo $checklist['checklist_nombre'];?>
         </h3>
         <div class="box-tools">
           <!-- <div class="pull-right">
             <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
             <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
           </div> -->

           <div class="pull-right">
             <?php
             if($wa_tipo == 'C' || $wa_tipo == 'E'){
               ?>
               <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
               <?php
             }
             if($wa_tipo == 'V'){
               ?>
               <a class="btn btn-success btn-sm" title="Editar" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

               <?php }?>

               <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
             </div>

           </div> 
         </div>

         <div class="box-body">
           <div class="row pad" style="padding: 0px;">
             <fieldset <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
               <div class="col-sm-12">

                 <table class="table table-bordered">
                   <thead class="thead-default">
                     <tr>
                       <th colspan="4"><i class="fa fa-list"></i> Información 2</th>
                     </tr>
                   </thead>
                   <tbody>
                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="placa_tracto" class="col-sm-2 control-label" style="text-align: right;"> Placa de Tracto:</label>
                         <div class="col-sm-10">
                           <input name="placa_tracto" id="placa_tracto" type="text" value="<?php echo $retVal = (!empty($post['placa_tracto'])) ? $post['placa_tracto'] : '';?>" class="form-control input-sm">
                           <?php echo form_error('placa_tracto', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>

                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="conductor" class="col-sm-2 control-label" style="text-align: right;"> Conductor:</label>
                         <div class="col-sm-10">
                           <input name="conductor" id="conductor" type="text" value="<?php echo $retVal = (!empty($post['conductor'])) ? $post['conductor'] : '';?>" class="form-control input-sm">
                           <?php echo form_error('conductor', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>

                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="kilometraje" class="col-sm-2 control-label" style="text-align: right;"> Kilometraje:</label>
                         <div class="col-sm-10">
                           <input name="kilometraje" id="kilometraje" type="text" value="<?php echo $retVal = (!empty($post['kilometraje'])) ? $post['kilometraje'] : '';?>" class="form-control input-sm">
                           <?php echo form_error('kilometraje', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>

                 </tbody>
               </table><br>

               <table class="table table-bordered">
                 <thead class="thead-default">
                   <tr>
                     <th colspan="4"><i class="fa fa-list"></i> Información 2</th>
                   </tr>
                 </thead>
                 <tbody>
                  <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="placa_plat_cama" class="col-sm-2 control-label" style="text-align: right;"> Placa Plat./Cama:</label>
                       <div class="col-sm-10">
                         <input name="placa_plat_cama" id="placa_plat_cama" type="text" value="<?php echo $retVal = (!empty($post['placa_plat_cama'])) ? $post['placa_plat_cama'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('placa_plat_cama', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>

                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="origen" class="col-sm-2 control-label" style="text-align: right;"> Origen:</label>
                       <div class="col-sm-10">
                         <input name="origen" id="origen" type="text" value="<?php echo $retVal = (!empty($post['origen'])) ? $post['origen'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('origen', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>

                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="destino" class="col-sm-2 control-label" style="text-align: right;"> Destino:</label>
                       <div class="col-sm-10">
                         <input name="destino" id="destino" type="text" value="<?php echo $retVal = (!empty($post['destino'])) ? $post['destino'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('destino', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>

                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="tipo_carga" class="col-sm-2 control-label" style="text-align: right;"> Tipo de carga:</label>
                       <div class="col-sm-10">
                         <input name="tipo_carga" id="tipo_carga" type="text" value="<?php echo $retVal = (!empty($post['tipo_carga'])) ? $post['tipo_carga'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('tipo_carga', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>

               </tbody>
             </table><br>

             <?php
             if(!empty($categorias)){
              $i=0;
              foreach ($categorias as $key => $categoria) {
                $i++;
              /*echo "<pre>";
              print_r($categoria);
              echo "</pre>";*/
              ?>
              <table class="table table-bordered">
               <thead class="thead-default">
                 <tr>
                  <th class="text-center" style="width: 45px;"><?php echo romanic_number($i);?></th>
                  <th class="text-center"><?php echo $categoria['nombre_categoria'];?></th>
                  <th class="text-center" style="width: 100px;">SI / NO</th>
                  <th class="text-center"><?php echo $categoria['titulo_obs'];?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $preguntas = $categoria['preguntas'];
                if(!empty($preguntas)){
                  $ii=0;
                  foreach ($preguntas as $key => $pregunta) {
                    $ii++;
                    //Consultar respuesta
                    $respuesta = $listadoRespuestas[$pregunta['id']];

                    /*echo "<pre>";
                    print_r($respuesta);
                    echo "</pre>";*/
                    ?>
                    <tr>
                     <td class="text-center"><?php echo $ii;?></td>
                     <td><?php echo $pregunta['pregunta'];?></td>
                     <td class="text-center">
                       <div class="btn-group text-center" role="group" data-toggle="btn-toggle">
                         <button type="button" class="btn btn-sm btn-respuesta <?php echo $retVal = ($respuesta['respuesta'] == 'SI') ? 'btn-success' : 'btn-default' ;?>" data-toggle="on" data-respuesta="SI">SI</button>
                         <button type="button" class="btn btn-sm btn-respuesta <?php echo $retVal = ($respuesta['respuesta'] == 'NO') ? 'btn-danger' : 'btn-default' ;?>" data-toggle="off" data-respuesta="NO">NO</button>
                         <input type="hidden" name="preguntas[]" value="<?php echo $pregunta['id'];?>">
                         <input type="hidden" class="respuesta" name="respuestas[]" value="<?php echo $retVal = (!empty($respuesta['respuesta'])) ? $respuesta['respuesta'] : ''; ?>">
                       </div>
                     </td>
                     <td class="text-center" style="width: 100px;">
                       <input type="text" name="observaciones[]" class="form-control input-sm" value="<?php echo $retVal = (!empty($respuesta['observacion'])) ? $respuesta['observacion'] : ''; ?>">
                     </td>
                   </tr>
                   <?php
                 }
               }else{
                ?>
                <tr><td colspan="5" class="text-center"><small>SIN REGISTROS</small></td></tr>
                <?php
              }
              ?>
            </tbody>
          </table><br>
          <?php
        }
      }
      ?>

    </div>
  </fieldset >
</div><!--end pad-->
</div>

<div class="box-header">
 <div class="row pad" style="padding-top: 0px; padding-bottom: 0px;">
   <div class="col-sm-6">

     <p><span style="color: red; font-weight: bold;"><strong>(*)</strong> Campos obligatorios.</span></p>

   </div>
   <div class="col-sm-6">

     <div class="pull-right">
       <?php
       if($wa_tipo == 'C' || $wa_tipo == 'E'){
         ?>
         <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
         <?php
       }
       if($wa_tipo == 'V'){
         ?>
         <a class="btn btn-success btn-sm" title="Editar" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

         <?php }?>

         <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
       </div>

     </div>

   </div>
 </div>

</form>

</div>
</div>
</div>