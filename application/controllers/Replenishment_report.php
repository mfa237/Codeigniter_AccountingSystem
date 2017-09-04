<?php
	defined('BASEPATH') OR die('direct script access is not allowed');

	class Replenishment_report extends CORE_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->validate_session();
			$this->load->model(
				array(
					'Journal_info_model',
					'Users_model',
					'Company_model'
				)
			);
		}

		public function index() {
			$this->Users_model->validate();
			$data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
	        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
	        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
	        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
	        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
	        $data['title'] = 'Replenishment Report';
        (in_array('9-13',$this->session->user_rights)? 
        $this->load->view('replenishment_report_view',$data)
        :redirect(base_url('dashboard')));
	        
		}

		function transaction($txn=null){
			switch ($txn) {
				case 'list':
					$m_journal=$this->Journal_info_model;

					$aod=date('Y-m-d',strtotime($this->input->get('aod',TRUE)));

					$response['data']=$m_journal->get_list(
						'journal_info.is_active=TRUE AND
						journal_info.is_deleted=FALSE AND
						journal_info.book_type="PCV" AND
						account_classes.account_type_id=5 AND
						journal_info.is_replenished=TRUE AND
						journal_info.date_txn <= "'.$aod.'"',
						'journal_info.txn_no,
						journal_info.supplier_id,
						journal_info.remarks,
						journal_info.amount,
						journal_info.ref_no,
						journal_info.journal_id,
						journal_info.department_id,
						departments.*,
						DATE_FORMAT(journal_info.date_txn,"%m/%d/%Y") AS date_txn,
						suppliers.*,
						batch_info.*,
						journal_accounts.account_id',
						array(
							array('suppliers','suppliers.supplier_id=journal_info.supplier_id','left'),
							array('journal_accounts','journal_accounts.journal_id=journal_info.journal_id','inner'),
							array('batch_info','batch_info.batch_id=journal_info.batch_id','inner'),
							array('account_titles','account_titles.account_id=journal_accounts.account_id','left'),
							array('account_classes','account_classes.account_class_id=account_titles.account_class_id','left'),
							array('departments','departments.department_id=journal_info.department_id','left')
						)
					);

					echo json_encode($response);
				break;

				case 'report':
					$m_journal=$this->Journal_info_model;
					$m_company=$this->Company_model;

					$aod=date('Y-m-d',strtotime($this->input->get('aod',TRUE)));

					$company_info=$m_company->get_list();

					$data['company_info']=$company_info[0];

					$data['batches']=$m_journal->get_list(
						'journal_info.is_active=TRUE AND
						journal_info.is_deleted=FALSE AND
						journal_info.book_type="PCV" AND
						journal_info.is_replenished=TRUE AND
						journal_info.date_txn <= "'.$aod.'"',
						'DISTINCT(batch_info.batch_no),
						batch_info.*',
						array(
							array('batch_info','batch_info.batch_id=journal_info.batch_id','inner')
						)
					);

					$data['replenishments']=$m_journal->get_list(
						'journal_info.is_active=TRUE AND
						journal_info.is_deleted=FALSE AND
						journal_info.book_type="PCV" AND
						account_classes.account_type_id=5 AND
						journal_info.is_replenished=TRUE AND
						journal_info.date_txn <= "'.$aod.'"',
						'journal_info.txn_no,
						journal_info.supplier_id,
						journal_info.remarks,
						journal_info.amount,
						journal_info.ref_no,
						journal_info.journal_id,
						journal_info.department_id,
						departments.*,
						DATE_FORMAT(journal_info.date_txn,"%m/%d/%Y") AS date_txn,
						suppliers.*,
						batch_info.*,
						journal_accounts.account_id',
						array(
							array('suppliers','suppliers.supplier_id=journal_info.supplier_id','left'),
							array('journal_accounts','journal_accounts.journal_id=journal_info.journal_id','inner'),
							array('batch_info','batch_info.batch_id=journal_info.batch_id','inner'),
							array('account_titles','account_titles.account_id=journal_accounts.account_id','left'),
							array('account_classes','account_classes.account_class_id=account_titles.account_class_id','left'),
							array('departments','departments.department_id=journal_info.department_id','left')
						)
					);

					$this->load->view('template/replenishment_report_html',$data);
				break;
			}
		}
	}
?>