<?php
	class Batch_info_model extends CORE_Model
	{
		protected $table="batch_info";
		protected $pk_id="batch_id";
		
		function __construct()
		{
			parent::__construct('');
		}
	}

?>