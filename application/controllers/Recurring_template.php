<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Recurring_template extends CORE_Controller
	{
		
		function __construct()
		{
			parent::__construct('');		
			$this->validate_session();
			$this->load->model(
				array(
					'Customers_model',
					'Users_model',
					'Users_model',
					'Suppliers_model',
					'Account_title_model',
					'Journal_template_info_model',
					'Journal_template_entry_model'
				)
			);
		}

		public function index()
		{	
			$this->Users_model->validate();
			$data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
	        $data['title']="Recurring Templates";

	        $data['customers']=$this->Customers_model->get_list('is_active=TRUE AND is_deleted=FALSE');
	        $data['suppliers']=$this->Suppliers_model->get_list('is_active=TRUE AND is_deleted=FALSE');
	        $data['accounts']=$this->Account_title_model->get_list('is_active=TRUE AND is_deleted=FALSE');
        (in_array('6-8',$this->session->user_rights)? 
        $this->load->view('recurring_template_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null)
		{
			switch($txn) 
			{	
				case 'list-template':
					$m_journal_temp_info=$this->Journal_template_info_model;

					$type=$this->input->get('type',TRUE);

					$response['data']=$m_journal_temp_info->get_list(
					"journal_templates_info.is_active=TRUE AND journal_templates_info.is_deleted=FALSE AND journal_templates_info.book_type='".$type."'",
						array(
							'journal_templates_info.template_id',
							'journal_templates_info.template_code',
							'journal_templates_info.payee',
							'journal_templates_info.template_description',
							'journal_templates_info.supplier_id',
							'journal_templates_info.customer_id',
							'journal_templates_info.method_id',
							'journal_templates_info.amount',
							'journal_templates_info.remarks',
							'journal_templates_info.book_type',
							'CONCAT_WS(" ",ua.user_fname,ua.user_lname) AS posted_by',
							'CONCAT(IF(NOT ISNULL(c.customer_id),CONCAT("C-",c.customer_id),""),IF(NOT ISNULL(s.supplier_id),CONCAT("S-",s.supplier_id),"")) as particular_id',
			                'CONCAT_WS(" ",IFNULL(c.customer_name,""),IFNULL(s.supplier_name,"")) as particular',
			                'CONCAT_WS(" ",ua.user_fname,ua.user_lname)as posted_by'
						),

						array(
							array('customers as c','c.customer_id=journal_templates_info.customer_id','left'),
							array('suppliers as s','s.supplier_id=journal_templates_info.supplier_id','left'),
							array('user_accounts as ua','ua.user_id=journal_templates_info.posted_by','left')
						),
						'journal_templates_info.template_id DESC'
					);

					echo json_encode($response);
				break;

				case 'list' :
					$response['data']=$this->get_response_rows();

					echo json_encode($response);
				break;
				
				case 'create':
					$m_journal_temp_info=$this->Journal_template_info_model;
					$m_journal_temp_entry=$this->Journal_template_entry_model;

					$particular=explode('-',$this->input->post('particular_id',TRUE));
					if($particular[0]=='C'){
	                    $m_journal_temp_info->customer_id=$particular[1];
	                    $m_journal_temp_info->supplier_id=0;
	                }else{
	                    $m_journal_temp_info->customer_id=0;
	                    $m_journal_temp_info->supplier_id=$particular[1];
	                }

	                $m_journal_temp_info->template_code=$this->input->post('template_code',TRUE);
	                $m_journal_temp_info->template_description=$this->input->post('template_description',TRUE);
	                $m_journal_temp_info->remarks=$this->input->post('remarks',TRUE);                
	                $m_journal_temp_info->book_type=$this->input->post('book_type',TRUE);
	                $m_journal_temp_info->posted_by=$this->session->user_id;
	                $m_journal_temp_info->save();

	                $journal_template_id=$m_journal_temp_info->last_insert_id();
	                $accounts=$this->input->post('accounts',TRUE);
	                $memos=$this->input->post('memo',TRUE);
	                $dr_amounts=$this->input->post('dr_amount',TRUE);
	                $cr_amounts=$this->input->post('cr_amount',TRUE);

	                for($i=0;$i<=count($accounts)-1;$i++) {
	                	$m_journal_temp_entry->template_id=$journal_template_id;
	                	$m_journal_temp_entry->account_id=$accounts[$i];
	                	$m_journal_temp_entry->memo=$memos[$i];
	                	$m_journal_temp_entry->dr_amount=$this->get_numeric_value($dr_amounts[$i]);
	                	$m_journal_temp_entry->cr_amount=$this->get_numeric_value($cr_amounts[$i]);
	                	$m_journal_temp_entry->save();
	                }

	                $response['stat']='success';
	                $response['title']='Success!';
	                $response['msg']='Template successfully saved';
	                $response['row_added']=$this->get_response_rows($journal_template_id);
	                echo json_encode($response);
				break;

				case 'update':
					$template_id=$this->input->get('id');
					$m_journal_temp_info=$this->Journal_template_info_model;
					$m_journal_temp_entry=$this->Journal_template_entry_model;

					$particular=explode('-',$this->input->post('particular_id',TRUE));
					if($particular[0]=='C'){
	                    $m_journal_temp_info->customer_id=$particular[1];
	                    $m_journal_temp_info->supplier_id=0;
	                }else{
	                    $m_journal_temp_info->customer_id=0;
	                    $m_journal_temp_info->supplier_id=$particular[1];
	                }

	                $m_journal_temp_info->template_code=$this->input->post('template_code',TRUE);
	                $m_journal_temp_info->template_description=$this->input->post('template_description',TRUE);
	                $m_journal_temp_info->remarks=$this->input->post('remarks',TRUE);                
	                $m_journal_temp_info->book_type=$this->input->post('book_type',TRUE);
	                $m_journal_temp_info->posted_by=$this->session->user_id;
	                $m_journal_temp_info->modify($template_id);

	                $accounts=$this->input->post('accounts',TRUE);
	                $memos=$this->input->post('memo',TRUE);
	                $dr_amounts=$this->input->post('dr_amount',TRUE);
	                $cr_amounts=$this->input->post('cr_amount',TRUE);

	                $m_journal_temp_entry->delete_via_fk($template_id);

	                for($i=0;$i<=count($accounts)-1;$i++) {
	                	$m_journal_temp_entry->template_id=$template_id;
	                	$m_journal_temp_entry->account_id=$accounts[$i];
	                	$m_journal_temp_entry->memo=$memos[$i];
	                	$m_journal_temp_entry->dr_amount=$this->get_numeric_value($dr_amounts[$i]);
	                	$m_journal_temp_entry->cr_amount=$this->get_numeric_value($cr_amounts[$i]);
	                	$m_journal_temp_entry->save();
	                }

	                $response['stat']='success';
	                $response['title']='Success!';
	                $response['msg']='Template successfully updated';
	                $response['row_updated']=$this->get_response_rows($template_id);
	                echo json_encode($response);
				break;

				case 'delete':
					$m_journal_temp_info=$this->Journal_template_info_model;
	                $template_id=$this->input->post('template_id',TRUE);

	                $m_journal_temp_info->is_deleted=1;
	                if($m_journal_temp_info->modify($template_id)){
	                    $response['title']='Success!';
	                    $response['stat']='success';
	                    $response['msg']='Template successfully deleted.';

	                    echo json_encode($response);
	                }
				break;

				case 'get-entries':
	                $journal_template_id=$this->input->get('id');
	                $m_accounts=$this->Account_title_model;
	                $m_journal_temp_entry=$this->Journal_template_entry_model;

	                $data['accounts']=$m_accounts->get_list();
	                $data['entries']=$m_journal_temp_entry->get_list('journal_entry_templates.template_id='.$journal_template_id);

	                $this->load->view('template/journal_template_entries', $data);
                break;
			}
		}

		function get_response_rows($criteria=null) {
			$m_journal_temp_info=$this->Journal_template_info_model;

			return $m_journal_temp_info->get_list(
				'journal_templates_info.is_active=TRUE AND journal_templates_info.is_deleted=FALSE '.($criteria == null ? '' : 'AND journal_templates_info.template_id='.$criteria),

				array(
					'journal_templates_info.template_id',
					'journal_templates_info.template_code',
					'journal_templates_info.payee',
					'journal_templates_info.template_description',
					'journal_templates_info.supplier_id',
					'journal_templates_info.customer_id',
					'journal_templates_info.method_id',
					'journal_templates_info.amount',
					'journal_templates_info.remarks',
					'journal_templates_info.book_type',
					'CONCAT_WS(" ",ua.user_fname,ua.user_lname) AS posted_by',
					'CONCAT(IF(NOT ISNULL(c.customer_id),CONCAT("C-",c.customer_id),""),IF(NOT ISNULL(s.supplier_id),CONCAT("S-",s.supplier_id),"")) as particular_id',
	                'CONCAT_WS(" ",IFNULL(c.customer_name,""),IFNULL(s.supplier_name,"")) as particular',
	                'CONCAT_WS(" ",ua.user_fname,ua.user_lname)as posted_by'
				),

				array(
					array('customers as c','c.customer_id=journal_templates_info.customer_id','left'),
					array('suppliers as s','s.supplier_id=journal_templates_info.supplier_id','left'),
					array('user_accounts as ua','ua.user_id=journal_templates_info.posted_by','left')
				),
				'journal_templates_info.template_id DESC'
			);
		}
	}
?>