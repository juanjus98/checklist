<?php
/*echo '<pre>';
print_r($listado);
echo '</pre>';*/
?>
<?php echo msj(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Checklist disponibles</h3>
            </div><!-- /.box-header -->
            <form name="index_form" id="index_form" action="<?php echo $eliminar_url; ?>" method="post">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <!-- <th><input type="checkbox" id="chkTodo" /></th> -->
                                <th class="text-center">#</th>
                                <th>Nombre de checklist</th>
                                <!-- <th>Fecha de ingreso</th> -->
                                <th></th>
                            </tr>
                            <?php
                            if(!empty($listado)){
                                $i=0;
                                foreach ($listado as $key => $item) {
                                    ?>
                                    <tr>
                                        <!-- <td>
                                            <input type="checkbox" name="items[]" id="eliminarchk-<?php echo $item['id'] ?>" value="<?php echo $item['id'] ?>" class="chk">
                                        </td> -->
                                        <td class="text-center"><?php echo $i++;?></td>
                                        <td><?php echo $item['checklist_nombre']; ?></td>
                                        <!-- <td><?php echo $item['ultima_numeracion']; ?></td> -->

                                        <!-- <td class="text-center">
                                        <?php 
                                        echo $publicado = ($item['publicado'] == 1) ? '<small class="badge bg-green">SI</small>' : '<small class="badge bg-orange">NO</small>' ;
                                        ?>
                                            
                                        </td> -->
                                        <!-- <td><?php echo $item['agregar']; ?></td> -->

                                        <td>
                                            <a href="<?php echo $responder_url . $item['id']; ?>" class="btn btn-primary btn-xs" title="Responder">
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i> Responder
                                            </a>
                                            <!-- <a href="<?php echo $editar_url . $item['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No se encontro ningún registro.</td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="pull-right">
                    <?php
                    echo $links;
                    ?>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>