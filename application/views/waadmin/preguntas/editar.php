<?php
//Categorias
$categorias_disabled='disabled';
if(!empty($post['checklist_id'])){
  $categorias_disabled='';
  $data = array('checklist_id' => $post['checklist_id']);
  $categorias = $this->Categorias->listadoAll($data);
}
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
                         <select name="checklist_id" id="checklist_id" class="form-control checklist_select">
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

                        <label for="checklist_categoria_id" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Categoría:</label>
                         <div class="col-sm-4">
                         <select name="checklist_categoria_id" id="checklist_categoria_id" class="form-control checklist_categoria_select" <?php echo $categorias_disabled;?>>
                            <option value="">Seleccionar</option>
                            <?php
                            if (!empty($categorias)) {
                              foreach ($categorias as $categoria) {
                                $selected = "";
                                if ($post['checklist_categoria_id'] == $categoria['id']) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $categoria['id'] . '" ' . $selected . '>' . $categoria['nombre_categoria'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('checklist_categoria_id', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </td>
                  </tr>

                <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="pregunta" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Pregunta:</label>
                     <div class="col-sm-10">
                       <input name="pregunta" id="pregunta" type="text" value="<?php echo $retVal = (!empty($post['pregunta'])) ? $post['pregunta'] : '';?>" class="form-control input-sm">
                       <?php echo form_error('pregunta', '<div class="error">', '</div>'); ?>
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