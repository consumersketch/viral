<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// default function
	public function index()
	{
		// loading prerequisites
		$this->load->database();
		$this->load->model('common_model');
		$this->load->helper('url');

		// packaging data to access in view
		$data = array();
		$data['clients'] = $this->common_model->get_cliients();
		

		// loading view
		$this->load->view('default',$data);
	}

	function get_products_ajax($client_id=0)
	{
		// loading prerequisites
		$this->load->database();
		$this->load->model('common_model');
		
		$data = array();

		// get products
		$data['products'] = $this->common_model->get_products_by_client($client_id);

		// loading view
		$this->load->view('products_ajax',$data);
	}

	function get_table_data($type=0)
	{
		// loading prerequisites
		$this->load->database();
		$this->load->model('common_model');

		$cl_id = 0;

		// check is search is basd on client
		// if so, assign $cl_id the client_id
		if(isset($_POST['client']) and $_POST['client']!='')
		{
			$cl_id = $_POST['client'];
		}

		$data = array();

		// check which dropdown is selected
		// passing appropriate data to view from model
		switch ($type)
		{
		    case 1:
		        $data['data1'] = $this->common_model->search1($cl_id);
		        break;
		    case 2:
		        $data['data1'] = $this->common_model->search2($cl_id);
		        break;
		    case 3:
		        $data['data1'] = $this->common_model->search3($cl_id);
		        break;
	        case 4:
	        	$data['data1'] = $this->common_model->search4($cl_id);
	        break;
		    default:
		    	echo 'Select appropriate option';
		        die;
		}


		// loading view
		$this->load->view('table',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */