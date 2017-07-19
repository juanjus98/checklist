<option value="">Seleccionar</option>
<?php
/*echo select_ubigeo($ubigeo['tipo'], NULL, $ubigeo['codigo'], 'clientes');*/
if(!empty($categorias)){
	foreach ($categorias as $key => $value) {
		echo '<option value="'.$value['id'].'">'.$value['nombre_categoria'].'</option>';
	}
}
?>