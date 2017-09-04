<?php
	class Journal_template_info_model extends CORE_Model
	{
		protected $pk_id="template_id";
		protected $table="journal_templates_info";

		function __construct()
		{
			parent::__construct();
		}
	}
?>