<?php
	class Chat_model extends CORE_Model
	{
		protected $table="chat";
		protected $pk_id="chat_id";
		function __construct()
		{
			parent::__construct();
		}

		function get_message_list($chat_code,$rev_chat_code) {
			$sql="SELECT 
			* 
			FROM
			(SELECT * FROM chat WHERE chat_code='$chat_code' OR chat_code='$rev_chat_code' ORDER BY chat_id DESC LIMIT 30) AS chat
			LEFT JOIN user_accounts ON user_accounts.user_id=chat.from_user_id
			WHERE chat.chat_code='$chat_code' OR chat_code='$rev_chat_code'
			ORDER BY chat_id ASC";

			return $this->db->query($sql)->result();
		}

		function get_online_offline_count($user_id) {
			$sql="SELECT
				(SELECT 
				COUNT(is_online)
				FROM user_accounts 
				WHERE is_online=TRUE AND user_id != $user_id) AS online_count,
				(SELECT
				COUNT(is_online)
				FROM user_accounts
				WHERE is_online=FALSE AND user_id != $user_id) AS offline_count
				FROM
				user_accounts
				LIMIT 1";

			return $this->db->query($sql)->result();
		}
	}
?>