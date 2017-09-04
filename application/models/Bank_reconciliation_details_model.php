<?php
	
	class Bank_reconciliation_details_model extends CORE_Model
	{
		protected $table="bank_reconciliation_details";
		protected $pk_id="bank_recon_item_id";

		function __construct()
		{
			parent::__construct();
		}
	}

?>