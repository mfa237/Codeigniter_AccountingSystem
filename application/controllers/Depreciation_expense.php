<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Depreciation_expense extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct('');
			$this->validate_session();

			$this->load->model(
				array(
					'Users_model',
					'Fixed_asset_management_model'
				)
			);
		}

		public function index()
		{
			$this->Users_model->validate();
			$data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
	        $data['title'] = 'Depreciation Expense Report';

	        $data['starting_year']=date('Y', strtotime('-100 year'));
	        $data['ending_year']=date('Y', strtotime('+10 year'));
	        $data['current_year']=date('Y');
	        (in_array('10-2',$this->session->user_rights)? 
	        $this->load->view('depreciation_expense_view',$data)
	        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null){
			switch($txn){
				case 'gdr-list':
					$m_fixed_asset=$this->Fixed_asset_management_model;

					$month=$this->input->get('m',TRUE);
					$year=$this->input->get('y',TRUE);

					$response['data']=$m_fixed_asset->get_depreciation_expense($month, $year);

					echo json_encode($response);
				break;

				case 'gdr-print':
					$m_fixed_asset=$this->Fixed_asset_management_model;

					$month=$this->input->get('m',TRUE);
					$year=$this->input->get('y',TRUE);

					$data['depreciation_expenses']=$m_fixed_asset->get_depreciation_expense($month, $year);

					$this->load->view('template/depreciation_expense_report',$data);
				break;
			}
		}
	}
?>