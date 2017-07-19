<?php

class Preguntas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Total de categorías
     *
     * Muestra el total de categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		02-03-2017
     * @version		Version 1.0
     */
    function total_registros($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.pregunta"] = "";
        }

        $resultado = $this->db->select("t1.*, t2.checklist_nombre, t3.nombre_categoria")
        ->join("web_checklist as t2", "t2.id = t1.checklist_id")
        ->join("web_checklist_categoria as t3", "t3.id = t1.checklist_categoria_id")
        ->where($where)
        ->like($like)
        ->get("web_checklist_pregunta as t1")
        ->num_rows();
        return $resultado;
    }

    /**
     * Listado de categorías
     *
     * Muestra un listado de todas las categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		02-03-2017
     * @version		Version 1.0
     */
    function listado($limit, $start, $data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.pregunta"] = "";
        }

        //ORDENAR POR
        if (!empty($data['ordenar_por'])) {
            $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
        } else {
            $order_by = 't1.orden ASC';
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("t1.*, t2.checklist_nombre, t3.nombre_categoria")
        ->join("web_checklist as t2", "t2.id = t1.checklist_id")
        ->join("web_checklist_categoria as t3", "t3.id = t1.checklist_categoria_id")
        ->where($where)
        ->like($like)
        ->order_by($order_by)
        ->limit($limit, $start)
        ->get("web_checklist_pregunta as t1")
        ->result_array();
        return $resultado;
    }

    /**
     * Cosultar categoría
     *
     * Trae la información de una categoria
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		02-03-2017
     * @version		Version 1.0
     */
    function get_row($data) {
        $where = array('t1.estado != ' => 0);

        if(!empty($data['id'])){
            $where['t1.id'] = $data['id'];
        }

        $resultado = $this->db->select("t1.*, t2.checklist_nombre, t3.nombre_categoria")
        ->join("web_checklist as t2", "t2.id = t1.checklist_id")
        ->join("web_checklist_categoria as t3", "t3.id = t1.checklist_categoria_id")
        ->where($where)
        ->get("web_checklist_pregunta as t1")
        ->row_array();

        return $resultado;
    }

}