<?php
	class Module_layout_model extends CORE_Model
	{
		protected $table="module_layout";
		protected $pk_id="module_layout_id";
		protected $fk_id="layout_id";
		function __construct()
		{
			parent::__construct();
		}
	}
?>