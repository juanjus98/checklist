<?php
//echo '<pre>';
//print_r($post);
//echo '</pre>';
?>
<form name="frm-agregar" id="frm-agregar" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/carousel/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label for="imagen1" class="col-sm-2 control-label">Imágen:</label>
                <div class="col-sm-5">
                    <input type="file" name="imagen1" id="imagen1" class="form-control" />
                    <i>705px * 360px</i>
                </div>
                <?php echo form_error('imagen1'); ?>
            </div>
            <?php
            if (!empty($post['imagen1'])) {
                ?>
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <a href="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen1']; ?>" target="_blank">
                            <img src="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen1']; ?>" alt="" class="preview-image" />
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="form-group">
                <label for="titulo1" class="col-sm-2 control-label">Título 1:</label>
                <div class="col-sm-5">
                    <input type="text" name="titulo1" id="titulo1" class="form-control"  placeholder="Título 1" value="<?php echo $post['titulo1']; ?>">
                </div>
                <?php echo form_error('titulo1'); ?>
            </div>

            <div class="form-group">
                <label for="titulo2" class="col-sm-2 control-label">Título 2:</label>
                <div class="col-sm-5">
                    <input type="text" name="titulo2" id="titulo2" class="form-control"  placeholder="Título 2" value="<?php echo $post['titulo2']; ?>">
                </div>
                <?php echo form_error('titulo2'); ?>
            </div>

            <div class="form-group">
                <label for="url" class="col-sm-2 control-label">Url:</label>
                <div class="col-sm-5">
                    <input type="text" name="url" id="url" class="form-control"  placeholder="Url" value="<?php echo $post['url']; ?>">
                </div>
                <?php echo form_error('url'); ?>
            </div>

            <div class="form-group">
                <label for="target" class="col-sm-2 control-label">Target:</label>
                <div class="col-sm-5">
                    <select name="target" class="form-control">
                        <?php
                        $targets = array(
                            "_parent" => "_parent",
                            "_blank" => "_blank"
                        );
                        foreach ($targets as $indice => $target) {
                            $selected_ = '';
                            if ($indice == $post['target']) {
                                $selected_ = 'selected="selected"';
                            }
                            ?>
                            <option value="<?php echo $indice; ?>" <?php echo $selected_; ?>><?php echo $target; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <?php echo form_error('url'); ?>
            </div>

            <div class="form-group">
                <label for="orden" class="col-sm-2 control-label">Orden:</label>
                <div class="col-sm-5">
                    <input type="text" name="orden" id="orden" class="form-control"  placeholder="Orden" value="<?php echo $post['orden']; ?>">
                </div>
                <?php echo form_error('orden'); ?>
            </div>

        </div>
    </div><!--//panel-->
</form>