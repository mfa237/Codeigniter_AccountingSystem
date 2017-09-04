<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->library('excel');
        $this->load->model('Units_model');
        $this->load->model('Account_title_model');
        $this->load->model('Services_model');
        $this->load->model('Service_unit_model');
        $this->load->model('Users_model');
    }

    public function index() {
        $this->Users_model->validate();
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['title'] = 'Service Management';




        $data['units'] = $this->Service_unit_model->get_list(array('service_unit.is_deleted'=>FALSE));

        $data['accounts'] = $this->Account_title_model->get_list(null,'account_id,account_title');


        $this->load->view('Services_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_services = $this->Services_model;
                $response['data']=$this->Services_model->get_list(
                    array('services.is_deleted'=>FALSE),
                   "
                    services.*,
                    account_titles.account_title
                    ",

                    array(
                        array('account_titles', 'account_titles.account_id=services.income_account_id','left')

                        )


                    );
                echo json_encode($response);
                break;

            case 'create';
                $m_services = $this->Services_model;
                $m_services->service_code = $this->input->post('service_code',TRUE);
                $m_services->service_desc = $this->input->post('service_desc',TRUE);
                $m_services->service_unit = $this->input->post('service_unit',TRUE);
                $m_services->income_account_id = $this->input->post('income_account_id',TRUE);
                $m_services->expense_account_id = $this->input->post('expense_account_id',TRUE);
                $m_services->service_amount = $this->get_numeric_value($this->input->post('service_amount',TRUE));
                $m_services->save();
                $service_id = $m_services->last_insert_id();
                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Service information successfully updated.';
                $response['row_added']=$this->response_rows($service_id);
                echo json_encode($response);

                break;

            case 'update';
                $m_services = $this->Services_model;
                $service_id = $this->input->post('service_id',TRUE);
                $m_services->service_code = $this->input->post('service_code',TRUE);
                $m_services->service_desc = $this->input->post('service_desc',TRUE);
                $m_services->service_unit = $this->input->post('service_unit',TRUE);
                $m_services->income_account_id = $this->input->post('income_account_id',TRUE);
                $m_services->expense_account_id = $this->input->post('expense_account_id',TRUE);
                $m_services->service_amount = $this->get_numeric_value($this->input->post('service_amount',TRUE));
                $m_services->modify($service_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Service information successfully updated.';
                $response['row_updated']=$this->response_rows($service_id);
                echo json_encode($response);



                break;


            case 'delete';
                $m_services = $this->Services_model;
                $service_id = $this->input->post('service_id',TRUE);
                $m_services->deleted_by_user = $this->session->user_id;
                $m_services->is_deleted=1;
                    if($m_services->modify($service_id)){
                        $response['title']='Success!';
                        $response['stat']='success';
                        $response['msg']='Service information successfully deleted.';

                        echo json_encode($response); 

                    }


                    break;

        }
    }

        function response_rows($filter){
        return $this->Services_model->get_list(
            $filter,

            'services.*'
          

            );
        }











}