<?php
class Checklist_model extends CI_Model {

  function __construct() {
   parent::__construct();
}

function listado($limit, $start, $data = NULL) {

    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['publicado'])) {
        $where_array["t1.publicado"] = $data['publicado'];
    }

    if (!empty($data['campo'])) {
       $like[$data['campo']] = $data['busqueda'];
   } else {
       $like['t1.checklist_nombre'] = "";
   }

    //ORDENAR POR
   if (!empty($data['ordenar_por'])) {
    $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
} else {
    $order_by = 't1.agregar DESC';
}

if ($start > 0) {
    $start = ($start - 1) * $limit;
}

$resultado = $this->db->select("t1.*")
/*    ->join("wa_condominio as t2", "t2.id = t1.condominio_id")
->join("wa_grupo as t3", "t3.id = t1.grupo_id")*/
->where($where_array)
->like($like)
->order_by($order_by)
->limit($limit, $start)
->get("web_checklist as t1")
->result_array();

//       echo $this->db->last_query();

return $resultado;
}


function total_registros($data = NULL) {
    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['publicado'])) {
        $where_array["t1.publicado"] = $data['publicado'];
    }

    if (!empty($data['campo'])) {
        $like[$data['campo']] = $data['busqueda'];
    } else {
        $like['t1.checklist_nombre'] = "";
    }

    $resultado = $this->db->select("t1.*")
    /*->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_grupo as t3", "t3.id = t1.grupo_id")*/
    ->where($where_array)
    ->like($like)
    ->get("web_checklist as t1")
    ->num_rows();

    return $resultado;
}


function get_row($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id'])){
        $where['t1.id'] = $data['id'];
    }

    $resultado = $this->db->select("t1.*")
    /*->join("wa_condominio as t2", "t2.id = t1.condominio_id")
    ->join("wa_grupo as t3", "t3.id = t1.grupo_id")*/
    ->where($where)
    ->get("web_checklist as t1")
    ->row_array();

    return $resultado;
}

/**
 * Checklist resultados
 */
function listadoResultados($limit, $start, $data = NULL) {

    $where_array = array('t1.estado != ' => 0);

   /*if (!empty($data['publicado'])) {
    $where_array["t1.publicado"] = $data['publicado'];
}*/

if (!empty($data['campo'])) {
   $like[$data['campo']] = $data['busqueda'];
} else {
   $like['t1.numeracion'] = "";
}

    //ORDENAR POR
if (!empty($data['ordenar_por'])) {
    $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
} else {
    $order_by = 't1.agregar DESC';
}

if ($start > 0) {
    $start = ($start - 1) * $limit;
}

$resultado = $this->db->select("t1.*, t2.id As checklist_id, t2.checklist_nombre")
->join("web_checklist as t2", "t2.id = t1.checklist_id")
/* ->join("wa_grupo as t3", "t3.id = t1.grupo_id")*/
->where($where_array)
->like($like)
->order_by($order_by)
->limit($limit, $start)
->get("web_checklist_data as t1")
->result_array();

//       echo $this->db->last_query();

return $resultado;
}

function totalResultados($data = NULL) {
    $where_array = array('t1.estado != ' => 0);

   /*if (!empty($data['publicado'])) {
    $where_array["t1.publicado"] = $data['publicado'];
}*/

if (!empty($data['campo'])) {
   $like[$data['campo']] = $data['busqueda'];
} else {
   $like['t1.numeracion'] = "";
}

    //ORDENAR POR
if (!empty($data['ordenar_por'])) {
    $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
} else {
    $order_by = 't1.agregar DESC';
}


$resultado = $this->db->select("t1.*, t2.id As checklist_id, t2.checklist_nombre")
->join("web_checklist as t2", "t2.id = t1.checklist_id")
/* ->join("wa_grupo as t3", "t3.id = t1.grupo_id")*/
->where($where_array)
->like($like)
->get("web_checklist_data as t1")
->num_rows();

return $resultado;
}

function getRowResultado($data) {
    $where = array('t1.estado != ' => 0);

    if(!empty($data['id'])){
        $where['t1.id'] = $data['id'];
    }

    $resultado = $this->db->select("t1.*, t2.id As checklist_id, t2.checklist_nombre")
    ->join("web_checklist as t2", "t2.id = t1.checklist_id")
    ->where($where)
    ->get("web_checklist_data as t1")
    ->row_array();

    return $resultado;
}

/**
 * Checklist resultados
 */
function listadoRespuestas($data) {

    $where_array = array('t1.estado != ' => 0);

    if (!empty($data['checklist_data_id'])) {
        $where_array["t1.checklist_data_id"] = $data['checklist_data_id'];
    }

    $order_by = 't1.id ASC';
    

    $result = $this->db->select("t1.*")
    ->where($where_array)
    ->order_by($order_by)
    ->get("web_checklist_pregunta_data as t1")
    ->result_array();

    $resultado = array();
    foreach ($result as $key => $value) {
        $resultado[$value['checklist_pregunta_id']] = $value;
    }

    return $resultado;
}



}