<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cards extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        $this->load->model('Cards_model');
    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', true);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', true);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', true);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', true);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', true);
        $data['title'] = 'Card Management';

        $this->load->view('cards_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $m_cards = $this->Cards_model;
                $response['data'] = $m_cards->get_card_list();
                echo json_encode($response);
                break;

            case 'create':
                $m_cards = $this->Cards_model;

                $m_cards->card_name = $this->input->post('card_name', TRUE);
                $m_cards->save();

                $card_id = $m_cards->last_insert_id();

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'card information successfully created.';
                $response['row_added'] = $m_cards->get_card_list($card_id);
                echo json_encode($response);

                break;

            case 'delete':
                $m_cards=$this->Cards_model;

                $card_id=$this->input->post('card_id',TRUE);

                $m_cards->is_deleted=1;
                if($m_cards->modify($card_id)){
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='card information successfully deleted.';

                    echo json_encode($response);
                }

                break;

            case 'update':
                $m_cards=$this->Cards_model;

                $card_id=$this->input->post('card_id',TRUE);
                $m_cards->card_name=$this->input->post('card_name',TRUE);

                $m_cards->modify($card_id);

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='card information successfully updated.';
                $response['row_updated']=$m_cards->get_card_list($card_id);
                echo json_encode($response);

                break;
        }
    }
}
