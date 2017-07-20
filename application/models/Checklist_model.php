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


}