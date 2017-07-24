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
                <h3 class="box-title">Checklist Resueltos</h3>
            </div><!-- /.box-header -->
            <form name="index_form" id="index_form" action="<?php echo $eliminar_url; ?>" method="post">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Número</th>
                                <th>Fecha</th>
                                <th>placa_tracto</th>
                                <th>conductor</th>
                                <!-- <th>origen</th> -->
                                <!-- <th>destino</th> -->
                                <!-- <th>tipo_carga</th> -->
                                <th>Nombre de checklist</th>
                                <th></th>
                            </tr>
                            <?php
                            if(!empty($listado)){
                                $i=0;
                                foreach ($listado as $key => $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['numeracion']; ?></td>
                                        <td><?php echo $item['fecha']; ?></td>
                                        <td><?php echo $item['placa_tracto']; ?></td>
                                        <td><?php echo $item['conductor']; ?></td>
                                        <!-- <td><?php echo $item['origen']; ?></td>
                                        <td><?php echo $item['destino']; ?></td> -->
                                        <!-- <td><?php echo $item['tipo_carga']; ?></td> -->
                                        <td><?php echo $item['checklist_nombre']; ?></td>

                                        <td class="text-center">
                                            <a href="<?php echo $ver_url . $item['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Visualizar">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="<?php echo $editar_url . $item['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                            <a href="<?php echo $pdf_url . $item['id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Exportar a PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="9">No se encontro ningún registro.</td>
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