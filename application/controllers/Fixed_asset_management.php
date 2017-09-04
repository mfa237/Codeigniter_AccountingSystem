<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fixed_asset_management extends CORE_Controller
	{		
		function __construct()
		{
			parent::__construct('');
			$this->validate_session();
			$this->load->model(
				array(
					'Locations_model',
					'Categories_model',
					'Asset_property_status_model',
					'Fixed_asset_management_model',
					'Users_model',
					'Departments_model'
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
	        $data['title'] = 'Fixed Asset Management';

	        $data['locations']=$this->Locations_model->get_list('is_active=TRUE AND is_deleted=FALSE');
	        $data['categories']=$this->Categories_model->get_category_list();
	        $data['asset_properties']=$this->Asset_property_status_model->get_list('is_deleted=FALSE');
	        $data['departments']=$this->Departments_model->get_list('is_deleted=FALSE AND is_active=TRUE');
	        (in_array('10-1',$this->session->user_rights)? 
	        $this->load->view('fixed_asset_management_view',$data)
	        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null) {
			switch($txn) {
				case 'list':
					$m_fixed_asset=$this->Fixed_asset_management_model;

					$response['data']=$m_fixed_asset->get_list(
						'fixed_assets.is_deleted=FALSE AND fixed_assets.is_active=TRUE',
						array(
							'fixed_assets.fixed_asset_id',
							'fixed_assets.asset_code',
							'fixed_assets.asset_description',
							'fixed_assets.serial_no',
							'fixed_assets.location_id',
							'fixed_assets.department_id',
							'fixed_assets.category_id',
							'fixed_assets.life_years',
							'fixed_assets.asset_status_id',
							'DATE_FORMAT(fixed_assets.date_acquired,"%m/%d/%Y")as date_acquired',
							'fixed_assets.remarks',
							'FORMAT(fixed_assets.acquisition_cost, 2) AS acquisition_cost',
							'FORMAT(fixed_assets.salvage_value, 2) AS salvage_value',
							'locations.*',
							'departments.*',
							'categories.*',
							'asset_property_status.*'
						),
						array(
							array('locations','locations.location_id=fixed_assets.location_id','left'),
							array('departments','departments.department_id=fixed_assets.department_id','left'),
							array('categories','categories.category_id=fixed_assets.category_id','left'),
							array('asset_property_status','asset_property_status.asset_status_id=fixed_assets.asset_status_id','left')
						),
						'fixed_assets.fixed_asset_id DESC'
					);

					echo json_encode($response);
				break;

				case 'create':
					$m_fixed_asset=$this->Fixed_asset_management_model;

					if(count($m_fixed_asset->get_list(array('asset_code'=>$this->input->post('asset_code',TRUE))))>0){
	                    $response['title'] = 'Invalid!';
	                    $response['stat'] = 'error';
	                    $response['msg'] = 'Asset Code already exists.';

	                    echo json_encode($response);
	                    exit;
	                }

					$m_fixed_asset->begin();

					$m_fixed_asset->set('date_posted','NOW()');
					$m_fixed_asset->asset_code=$this->input->post('asset_code',TRUE);
					$m_fixed_asset->asset_description=$this->input->post('asset_description',TRUE);
					$m_fixed_asset->serial_no=$this->input->post('serial_no',TRUE);
					$m_fixed_asset->location_id=$this->input->post('location_id',TRUE);
					$m_fixed_asset->department_id=$this->input->post('department_id',TRUE);
					$m_fixed_asset->category_id=$this->input->post('category_id',TRUE);
					$m_fixed_asset->acquisition_cost=$this->get_numeric_value($this->input->post('acquisition_cost',TRUE));
					$m_fixed_asset->salvage_value=$this->get_numeric_value($this->input->post('salvage_value',TRUE));
					$m_fixed_asset->life_years=$this->input->post('life_years',TRUE);
					$m_fixed_asset->asset_status_id=$this->input->post('asset_status_id',TRUE);
					$m_fixed_asset->date_acquired=date('Y-m-d', strtotime($this->input->post('date_acquired',TRUE)));
					$m_fixed_asset->remarks=$this->input->post('remarks',TRUE);
					$m_fixed_asset->posted_by_user=$this->session->user_id;

					$m_fixed_asset->save();

					$fixed_asset_id=$m_fixed_asset->last_insert_id();

					$m_fixed_asset->commit();

					$response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Asset successfully created.';
                    $response['row_added']=$this->response_rows($fixed_asset_id);

                    echo json_encode($response);

				break;

				case 'update':
					$m_fixed_asset=$this->Fixed_asset_management_model;
	                
					$fixed_asset_id=$this->input->post('fixed_asset_id',TRUE);

					$m_fixed_asset->set('date_modified','NOW()');
					$m_fixed_asset->asset_code=$this->input->post('asset_code',TRUE);
					$m_fixed_asset->asset_description=$this->input->post('asset_description',TRUE);
					$m_fixed_asset->serial_no=$this->input->post('serial_no',TRUE);
					$m_fixed_asset->location_id=$this->input->post('location_id',TRUE);
					$m_fixed_asset->department_id=$this->input->post('department_id',TRUE);
					$m_fixed_asset->category_id=$this->input->post('category_id',TRUE);
					$m_fixed_asset->acquisition_cost=$this->get_numeric_value($this->input->post('acquisition_cost',TRUE));
					$m_fixed_asset->salvage_value=$this->get_numeric_value($this->input->post('salvage_value',TRUE));
					$m_fixed_asset->life_years=$this->input->post('life_years',TRUE);
					$m_fixed_asset->asset_status_id=$this->input->post('asset_status_id',TRUE);
					$m_fixed_asset->date_acquired=date('Y-m-d', strtotime($this->input->post('date_acquired',TRUE)));
					$m_fixed_asset->remarks=$this->input->post('remarks',TRUE);
					$m_fixed_asset->modified_by_user=$this->session->user_id;

					$m_fixed_asset->modify($fixed_asset_id);

					$response['title'] = 'Success!';
                    $response['stat'] = 'success';
                    $response['msg'] = 'Asset successfully updated.';
                    $response['row_updated']=$this->response_rows($fixed_asset_id);

                    echo json_encode($response);
				break;

				case 'delete':
					$m_fixed_asset=$this->Fixed_asset_management_model;

	                $fixed_asset_id=$this->input->post('fixed_asset_id',TRUE);

	                $m_fixed_asset->set('date_deleted','NOW()');
	                $m_fixed_asset->deleted_by_user = $this->session->user_id;
	                $m_fixed_asset->is_deleted=1;
	                if($m_fixed_asset->modify($fixed_asset_id)){
	                    $response['title']='Success!';
	                    $response['stat']='success';
	                    $response['msg']='Asset successfully deleted.';

	                    echo json_encode($response);
	                }
				break;
			}
		}

		function response_rows($filter=null){

			return $this->Fixed_asset_management_model->get_list(
				array('fixed_asset_id'=>$filter,'fixed_assets.is_deleted=FALSE AND fixed_assets.is_active=TRUE'),
				array(
					'fixed_assets.fixed_asset_id',
					'fixed_assets.asset_code',
					'fixed_assets.asset_description',
					'fixed_assets.serial_no',
					'fixed_assets.location_id',
					'fixed_assets.department_id',
					'fixed_assets.category_id',
					'fixed_assets.life_years',
					'fixed_assets.asset_status_id',
					'fixed_assets.date_acquired',
					'fixed_assets.remarks',
					'FORMAT(fixed_assets.acquisition_cost, 2) AS acquisition_cost',
					'FORMAT(fixed_assets.salvage_value, 2) AS salvage_value',
					'locations.*',
					'departments.*',
					'categories.*',
					'asset_property_status.*'
				),
				array(
					array('locations','locations.location_id=fixed_assets.location_id','left'),
					array('departments','departments.department_id=fixed_assets.department_id','left'),
					array('categories','categories.category_id=fixed_assets.category_id','left'),
					array('asset_property_status','asset_property_status.asset_status_id=fixed_assets.asset_status_id','left')
				)
			);
		}
	}
?>