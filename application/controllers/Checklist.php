<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller{
  private $ctr_name;
	private $base_ctr; //Url base del controlodor
	private $primary_table = "web_checklist"; //Tabla principal
	public $base_title = "Checklist";

	public  $user_info;

	function __construct(){
		parent::__construct();
		$this->template->set_layout('intranet.php');

		/**
		 * Verficamos si existe una session activa
		 */
		/*$this->auth->logged_in();*/

		$this->load->model("crud_model","Crud");
		$this->load->model("checklist_model","Checklist");
    $this->load->model('categorias_model', 'Categorias');
    $this->load->model('preguntas_model', 'Preguntas');

    $this->ctr_name = $this->router->fetch_class();
    //Base del controlador
    $this->base_ctr = $this->ctr_name;

		//Información del usuario que ha iniciado session
    /*$this->user_info = $this->auth->user_profile();*/
  }

  function index(){
    $data['wa_modulo'] = 'Listado';
    $data['wa_menu'] = $this->base_title;

		//URLS
    $controlador = $this->base_ctr;
    $data['agregar_url'] = base_url($controlador . '/editar/C');
		$data['ver_url'] = base_url($controlador . '/editar/V/'); //Adicionar ID
		$data['editar_url'] = base_url($controlador . '/editar/E/'); //Adicionar ID

    $data['responder_url'] = base_url($controlador . '/responder/'); //Adicionar ID

    $data['eliminar_url'] = base_url($controlador . '/eliminar');
    $data['refresh_url'] = base_url($controlador . '/index?refresh');

		//BUSQUEDA
    $data['campos_busqueda'] = array(
     't1.nombre_unidad' => 'Nombre únidad',
     't3.nombre_grupo' => 'Tipo únidad'
     );

		$sessionName = 's_' . $this->primary_table; //Session name

		//Paginacion
		$base_url = base_url($this->base_ctr . '/index');
        $per_page = 30; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        if (isset($_GET['refresh'])) {
        	$this->session->unset_userdata($sessionName);
        }

        //Setear post
        $post = $this->Crud->set_post($this->input->post(),$sessionName);
        $post['publicado'] = 1;
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Checklist->total_registros($post);

        //Listado
        $data['listado'] = $this->Checklist->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];

        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();


        if ($this->session->userdata("mensaje")) {
        	$data["mensaje"] = $this->session->userdata("mensaje");
        	$this->session->unset_userdata("mensaje");
        }

        $this->template->title('Listado ' . $this->base_title);
        $this->template->build($this->base_ctr . '/index', $data);
      }

      function responder($id){
        $data['current_url'] = base_url(uri_string());
        $data['back_url'] = base_url($this->base_ctr . '/index');

        $data['tipo'] = 'Responder';
        $data['wa_tipo'] = 'E';
        $data['wa_modulo'] = $data['tipo'];
        $data['wa_menu'] = 'Checklist';

      //Consultar Checklist
        $data_row = array('id' => $id);
        $checklist = $this->Checklist->get_row($data_row);
        $data['checklist'] = $checklist;

      //Categorías
        $dataAll = array('checklist_id' => $id);
        $data['categorias'] = $this->Categorias->listadoAll($dataAll);

      //Agregar Preguntas
        foreach ($data['categorias'] as $key => $categoria) {
        //Consultar Preguntas
          $dataPreg = array('checklist_id' => $id, 'checklist_categoria_id' => $categoria['id']);
          $data['categorias'][$key]['preguntas'] = $this->Preguntas->listadoAll($dataPreg);
        }

        if ($this->input->post()) {
          $post= $this->input->post();
          $data['post'] = $post;

          $config = array(
            array(
              'field' => 'placa_tracto',
              'label' => 'placa_tracto',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'conductor',
              'label' => 'conductor',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'kilometraje',
              'label' => 'kilometraje',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'placa_plat_cama',
              'label' => 'placa_plat_cama',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'origen',
              'label' => 'origen',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'destino',
              'label' => 'destino',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'tipo_carga',
              'label' => 'tipo_carga',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              )
            );

          $this->form_validation->set_rules($config);
          $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

          if ($this->form_validation->run() == FALSE){
            /*Error*/
            $data['post'] = $post;
          }else{

            $numeracion = $checklist['ultima_numeracion'] + 1;
            $numeracionStr = str_pad($numeracion, 6, "0", STR_PAD_LEFT);

            $fecha = date("Y-m-d H:i:s");
            $usuario_id = 1;

            $data_form = array(
              "checklist_id" => $post['checklist_id'],
              "numeracion" => $numeracionStr,
              "placa_tracto" => $post['placa_tracto'],
              "conductor" => $post['conductor'],
              "kilometraje" => $post['kilometraje'],
              "fecha" => $fecha,
              "placa_plat_cama" => $post['placa_plat_cama'],
              "origen" => $post['origen'],
              "destino" => $post['destino'],
              "tipo_carga" => $post['tipo_carga'],
              "usuario_id" => $usuario_id
              );

            $this->db->insert('web_checklist_data', $data_form);
            $checklist_data_id = $this->db->insert_id();
            /*$checklist_data_id = 1;*/

            $preguntas = $post['preguntas'];
            $respuestas = $post['respuestas'];
            $observaciones = $post['observaciones'];

            if(!empty($preguntas)){
              foreach ($preguntas as $key => $pregunta) {

                $checklist_pregunta_id = $pregunta;
                $respuesta = $respuestas[$key];
                $observacion = $observaciones[$key];

                $respuestaData = array(
                  'checklist_data_id' => $checklist_data_id,
                  'checklist_pregunta_id' => $checklist_pregunta_id,
                  'respuesta' => $respuesta,
                  'observacion' => $observacion,
                  );

                $this->db->insert('web_checklist_pregunta_data', $respuestaData);
                
              }
            }

            //Actualizar numeración
            $dataUp = array('ultima_numeracion' => $numeracion);
            $this->db->where('id', $post['checklist_id']);
            $this->db->update('web_checklist', $dataUp);

            $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
            redirect('checklist/index');

          }

        }

        $this->template->title($data['tipo'] . ' Checklist');
        $this->template->build($this->base_ctr.'/responder', $data);
      }


      /**
       * Resueltos
       */
      
      function resultados(){
        $data['wa_modulo'] = 'Listado';
        $data['wa_menu'] = "Resultados";

        $controlador = $this->base_ctr;
        /*$data['agregar_url'] = base_url($controlador . '/editar/C');*/
        $data['ver_url'] = base_url('resultado/V/');
        $data['editar_url'] = base_url('resultado/E/');

        $data['pdf_url'] = base_url($controlador . '/pdf/');

        $data['eliminar_url'] = base_url($controlador . '/eliminar');
        $data['refresh_url'] = base_url($controlador . '/resueltos?refresh');
        
        $data['campos_busqueda'] = array(
         't1.nombre_unidad' => 'Nombre únidad',
         't3.nombre_grupo' => 'Tipo únidad'
         );

        $sessionName = 's_resultados' ;

        //Paginacion
        $base_url = base_url('resultados');
        $per_page = 30; 
        $uri_segment = 2;
        $num_links = 4;

        //echo $this->uri->segment(2); 
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        if (isset($_GET['refresh'])) {
          $this->session->unset_userdata($sessionName);
        }

        //Setear post
        $post = $this->Crud->set_post($this->input->post(),$sessionName);
        /*$post['publicado'] = 1;*/ 
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Checklist->totalResultados($post);

        //Listado
        $data['listado'] = $this->Checklist->listadoResultados($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];

        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();


        if ($this->session->userdata("mensaje")) {
          $data["mensaje"] = $this->session->userdata("mensaje");
          $this->session->unset_userdata("mensaje");
        }

        $this->template->title('Listado ' . $this->base_title);
        $this->template->build($this->base_ctr . '/resultados', $data);
      }

      /**
       * Resultado
       */

      function resultado($tipo='C',$id=NULL){
        $data['current_url'] = base_url(uri_string());
        $data['back_url'] = base_url('resultados');
        $data['editar_url'] = base_url('resultado/E/' . $id);

        switch ($tipo) {
          case 'C':
          $data['tipo'] = 'Agregar';
          break;
          case 'E':
          $data['tipo'] = 'Editar';
          break;
          case 'V':
          $data['tipo'] = 'Visualizar';
          break;
        }

        $data['wa_tipo'] = $tipo;
        $data['wa_modulo'] = $data['tipo'];
        $data['wa_menu'] = 'Checklist';

      //Consultar web_checklist_data
        $dataRes = array(
          'id' => $id, 
          );
        $post = $this->Checklist->getRowResultado($dataRes);
        $data['post'] = $post;

      //Consultar web_checklist_pregunta_data (RESPUESTAS)
        $dataListRespuestas = array(
          'checklist_data_id' => $id, 
          );
        $listadoRespuestas = $this->Checklist->listadoRespuestas($dataListRespuestas);
        $data['listadoRespuestas'] = $listadoRespuestas;

      //Consultar Checklist
        $data_row = array('id' => $post['checklist_id']);
        $checklist = $this->Checklist->get_row($data_row);
        $data['checklist'] = $checklist;

      //Categorías
        $dataAll = array('checklist_id' => $checklist['id']);
        $data['categorias'] = $this->Categorias->listadoAll($dataAll);

      //Agregar Preguntas
        foreach ($data['categorias'] as $key => $categoria) {
        //Consultar Preguntas
          $dataPreg = array('checklist_id' => $checklist['id'], 'checklist_categoria_id' => $categoria['id']);
          $data['categorias'][$key]['preguntas'] = $this->Preguntas->listadoAll($dataPreg);
        }

        if ($this->input->post()) {
          $post= $this->input->post();
          $data['post'] = $post;

          $config = array(
            array(
              'field' => 'placa_tracto',
              'label' => 'placa_tracto',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'conductor',
              'label' => 'conductor',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'kilometraje',
              'label' => 'kilometraje',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'placa_plat_cama',
              'label' => 'placa_plat_cama',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'origen',
              'label' => 'origen',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'destino',
              'label' => 'destino',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              ),
            array(
              'field' => 'tipo_carga',
              'label' => 'tipo_carga',
              'rules' => 'required',
              'errors' => array(
                'required' => 'Campo requerido.',
                )
              )
            );

          $this->form_validation->set_rules($config);
          $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

          if ($this->form_validation->run() == FALSE){
            /*Error*/
            $data['post'] = $post;
          }else{

            $fecha = date("Y-m-d H:i:s");
            $usuario_id = 1;

            $data_form = array(
              /*"checklist_id" => $post['checklist_id'],*/
              /*"numeracion" => $numeracionStr,*/
              "placa_tracto" => $post['placa_tracto'],
              "conductor" => $post['conductor'],
              "kilometraje" => $post['kilometraje'],
              "placa_plat_cama" => $post['placa_plat_cama'],
              "origen" => $post['origen'],
              "destino" => $post['destino'],
              "tipo_carga" => $post['tipo_carga'],
              "usuario_id" => $usuario_id,
              "editar" => $fecha,
              );

            $this->db->where('id', $post['id']);
            $this->db->update('web_checklist_data', $data_form);
            $checklist_data_id = $post['id'];

            //Eliminar  web_checklist_pregunta_data
            $this->db->where('checklist_data_id', $checklist_data_id);
            $this->db->delete('web_checklist_pregunta_data');

            $preguntas = $post['preguntas'];
            $respuestas = $post['respuestas'];
            $observaciones = $post['observaciones'];

            if(!empty($preguntas)){
              foreach ($preguntas as $key => $pregunta) {

                $checklist_pregunta_id = $pregunta;
                $respuesta = $respuestas[$key];
                $observacion = $observaciones[$key];

                $respuestaData = array(
                  'checklist_data_id' => $checklist_data_id,
                  'checklist_pregunta_id' => $checklist_pregunta_id,
                  'respuesta' => $respuesta,
                  'observacion' => $observacion,
                  );

                $this->db->insert('web_checklist_pregunta_data', $respuestaData);
                
              }
            }

            $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
            redirect('checklist/resultados');
          }

        }

        $this->template->title($data['tipo'] . ' Checklist');
        $this->template->build($this->base_ctr.'/resultado', $data);
      }

/**
 * Resultados
 */
public function topdf($id=null){
  $dataRes = array('id' => $id,);
  $post = $this->Checklist->getRowResultado($dataRes);
  $data['post'] = $post;

  //Consultar web_checklist_pregunta_data (RESPUESTAS)
  $dataListRespuestas = array('checklist_data_id' => $id,);
  $listadoRespuestas = $this->Checklist->listadoRespuestas($dataListRespuestas);
  $data['listadoRespuestas'] = $listadoRespuestas;

  //Consultar Checklist
  $data_row = array('id' => $post['checklist_id']);
  $checklist = $this->Checklist->get_row($data_row);
  $data['checklist'] = $checklist;

  //Categorías
  $dataAll = array('checklist_id' => $checklist['id']);
  $data['categorias'] = $this->Categorias->listadoAll($dataAll);

  //Agregar Preguntas
  foreach ($data['categorias'] as $key => $categoria) {
        //Consultar Preguntas
    $dataPreg = array('checklist_id' => $checklist['id'], 'checklist_categoria_id' => $categoria['id']);
    $data['categorias'][$key]['preguntas'] = $this->Preguntas->listadoAll($dataPreg);
  }

  echo "<pre>";
  print_r($post);
  echo "</pre><hr>";

  echo "<pre>";
  print_r($checklist);
  echo "</pre><hr>";

  echo "<pre>";
  print_r($data['categorias']);
  echo "</pre><hr>";

  echo "<pre>";
  print_r($listadoRespuestas);
  echo "</pre><hr>";

  die();

  $filename = time()."_order.pdf";

  $html = $this->load->view('checklist/mpdf_test',$data,true);

  $this->load->library('M_pdf');

  $this->m_pdf->pdf->WriteHTML($html);

  //download it D save F.

  /*$this->mpdf->pdf->Output("./uploads/".$filename, "F");*/
  $this->m_pdf->pdf->Output($filename, "D");

}


      /**
       * Editar
       */

      function editar($tipo='C',$id=NULL){
       $data['current_url'] = base_url(uri_string());
       $data['back_url'] = base_url($this->base_ctr . '/index');

       if(isset($id)){
        $data['editar_url'] = base_url($this->base_ctr . '/editar/E/' . $id);
      }

      switch ($tipo) {
        case 'C':
        $data['tipo'] = 'Agregar';
        break;
        case 'E':
        $data['tipo'] = 'Editar';
        break;
        case 'V':
        $data['tipo'] = 'Visualizar';
        break;
      }

      $data['wa_tipo'] = $tipo;
      $data['wa_modulo'] = $data['tipo'];
      $data['wa_menu'] = 'Checklist';


      if($tipo == 'E' || $tipo == 'V'){
        $data_row = array('id' => $id);
        $checklist = $this->Checklist->get_row($data_row);
        $data['post'] = $checklist;
      }    

      if ($this->input->post()) {
        $post= $this->input->post();
        $data['post'] = $post;

        $config = array(
         array(
          'field' => 'checklist_nombre',
          'label' => 'Nombre checklist',
          'rules' => 'required',
          'errors' => array(
           'required' => 'Campo requerido.',
           )
          ),
         array(
          'field' => 'ultima_numeracion',
          'label' => 'Última numeración',
          'rules' => 'required|is_natural',
          'errors' => array(
            'required' => 'Campo requerido.',
            'is_natural' => 'Ingresar solo números enteros.',
            )
          )
         );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

        if ($this->form_validation->run() == FALSE){
         /*Error*/
         $data['post'] = $post;
       }else{

        $publicado = (isset($post['publicado'])) ? $post['publicado'] : 0 ;

        $data_form = array(
          "checklist_nombre" => $post['checklist_nombre'],
          "descripcion" => $post['descripcion'],
          "ultima_numeracion" => $post['ultima_numeracion'],
          "publicado" => $publicado
          );

          //Agregar
        if($tipo == 'C'){
          $this->db->insert($this->primary_table, $data_form);
          $checklist_id = $this->db->insert_id();
          $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
        }

          //Editar
        if ($tipo == 'E') {
          $this->db->where('id', $post['id']);
          $this->db->update($this->primary_table, $data_form);
          $checklist_id = $post['id'];
          $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
        }

        redirect($this->base_ctr . '/index');
      }

    }

    $this->template->title($data['tipo'] . ' Checklist');
    $this->template->build($this->base_ctr.'/editar', $data);
  }

/**
 * Eliminar
 *
 *
 * @package     Checklist
 * @author      Juan Julio Sandoval Layza
 * @copyright   webApu.com 
 * @since       26-02-2015
 * @version     Version 1.0
 */
public function eliminar() {
 if ($this->input->post()) {
   $items = $this->input->post('items');
   if (!empty($items)) {
     foreach ($items as $item) {
       $eliminar = date("Y-m-d H:i:s");
       $data_eliminar = array(
         "eliminar" => $eliminar,
         "estado" => 0
         );
       $this->db->where('id', $item);
       $this->db->update($this->primary_table, $data_eliminar);
     }
     $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
     redirect($this->base_ctr . "/index");
   } else {
     $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
     redirect($this->base_ctr . "/index");
   }
 } else {
   $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
   redirect($this->base_ctr . "/index");
 }

 $this->template->title('Eliminar.');
 $this->template->build('inicio');
}


/**
 * Test mpdf
 */
public function mpdf_test(){
  $data['titulo'] = "Checklist";

  $filename = time()."_order.pdf";

  $html = $this->load->view('checklist/mpdf_test',$data,true);

  $this->load->library('M_pdf');

  $this->m_pdf->pdf->WriteHTML($html);

  //download it D save F.

  /*$this->mpdf->pdf->Output("./uploads/".$filename, "F");*/
  $this->m_pdf->pdf->Output($filename, "D");

}


}