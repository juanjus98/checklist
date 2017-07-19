<?php
/*echo '<pre>';
print_r(array_reverse($propietarios));
echo '</pre>';*/
?>
<div class="row">
 <div class="col-xs-12">
   <div class="box box-danger">

     <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo $current_url;?>" method="post" role="form">

       <?php if($wa_tipo == 'E'){ ?> <input type="hidden" name="id" value="<?php echo $post['id'];?>"><?php }?>
       <div class="box-header" style="padding-bottom: 0;">
         <h3 class="box-title"><?php echo $tipo; ?></h3>
         <div class="box-tools">
           <div class="pull-right">
             <?php
             if($wa_tipo == 'C' || $wa_tipo == 'E'){
               ?>
               <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
               <?php
             }
             if($wa_tipo == 'V'){
               ?>
               <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>
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
                       <th colspan="4"><i class="fa fa-list"></i> Información</th>
                     </tr>
                   </thead>
                   <tbody>

                <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="checklist_id" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Checklist:</label>
                         <div class="col-sm-4">
                         <select name="checklist_id" id="checklist_id" class="form-control">
                            <option value="">Seleccionar</option>
                            <?php
                            if (!empty($checklists)) {
                              foreach ($checklists as $checklist) {
                                $selected = "";
                                if ($post['checklist_id'] == $checklist['id']) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $checklist['id'] . '" ' . $selected . '>' . $checklist['checklist_nombre'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('checklist_id', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </td>
                  </tr>

                <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="nombre_categoria" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Nombre categoría:</label>
                     <div class="col-sm-4">
                       <input name="nombre_categoria" id="nombre_categoria" type="text" value="<?php echo $retVal = (!empty($post['nombre_categoria'])) ? $post['nombre_categoria'] : '';?>" class="form-control input-sm">
                       <?php echo form_error('nombre_categoria', '<div class="error">', '</div>'); ?>
                     </div>

                     <label for="titulo_obs" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Título OBS:</label>
                     <div class="col-sm-4">
                       <input name="titulo_obs" id="titulo_obs" type="text" value="<?php echo $retVal = (!empty($post['titulo_obs'])) ? $post['titulo_obs'] : 'OBS';?>" class="form-control input-sm">
                       <?php echo form_error('titulo_obs', '<div class="error">', '</div>'); ?>
                     </div>

                   </div>
                 </td>
               </tr>

               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="descripcion" class="col-sm-2 control-label" style="text-align: right;"> Descripción:</label>
                     <div class="col-sm-10">
                       <textarea name="descripcion" id="descripcion" class="form-control" rows="3" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>><?php echo $retVal = (!empty($post['descripcion'])) ? $post['descripcion'] : '' ; ;?></textarea>
                       <?php echo form_error('descripcion', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>

               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="orden" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Orden:</label>
                     <div class="col-sm-2">
                       <input name="orden" id="orden" type="text" value="<?php echo $retVal = (!empty($post['orden'])) ? $post['orden'] : 99;?>" class="form-control input-sm">
                       <?php echo form_error('orden', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>

              <!-- <tr>
                 <td colspan="4" style="vertical-align: middle;">
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="publicado" class="col-sm-2 control-label" style="text-align: right;">Publicar:</label>
                     <div class="col-sm-4">
                       <?php
                       $checked = "";
                       if(!empty($post['publicado']) && $post['publicado'] == 1){
                        $checked = "checked";
                      }
                      ?>
                      <input class="form-control input-sm" id="publicado" name="publicado" type="checkbox" value="1" <?php echo $checked;?> <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>> 
                    </div>
                  </div>
                </td>
              </tr> -->

             </tbody>
           </table><br>

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
         <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

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