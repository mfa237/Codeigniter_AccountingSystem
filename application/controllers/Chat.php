<?php
	defined('BASEPATH') OR die('direct script access is not allowed');

	class Chat extends CORE_Controller
	{
		function __construct()
		{
			parent::__construct('');
			$this->validate_session();
			$this->load->model(
				array('Users_model',
				'Chat_model')
			);
		}

		function transaction($txn=null) {
			switch ($txn) {
				case 'send':
					$m_chat=$this->Chat_model;

					$chat_code=$this->input->post('chat_code');
					$rev_chat_code=$this->input->post('rev_chat_code');

					$m_chat->set('date_created','NOW()');
					$m_chat->chat_code=$chat_code;
					$m_chat->message=$this->input->post('message');
					$m_chat->from_user_id=$this->session->user_id;
					$m_chat->save();

					$response['retrieve_messages']=$m_chat->get_message_list($chat_code,$rev_chat_code);

					echo json_encode($response);
				break;

				case 'retrieve':
					$m_users=$this->Users_model;
					$m_chat=$this->Chat_model;

					$session_id=$this->session->user_id;

					$chat_code=$this->input->post('chat_code');
					$rev_chat_code=$this->input->post('rev_chat_code');

			        $response['messages']=$m_chat->get_message_list($chat_code,$rev_chat_code);
			        $response['status_info']=$m_chat->get_online_offline_count($session_id);
			        $response['users_status']=$m_users->get_list('user_id != '.$session_id);

			        echo json_encode($response);
				break;
			}
		}
	}
?>