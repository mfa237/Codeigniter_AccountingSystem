<?php
	class Journal_template_entry_model extends CORE_Model
	{
		protected $pk_id="entry_template_id";
		protected $table="journal_entry_templates";
		protected $fk_id="template_id";

		function __construct()
		{
			parent::__construct();
		}
	}
?>