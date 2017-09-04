<?php
	
	class Bank_reconciliation_model extends CORE_Model
	{
		protected $table="bank_reconciliation";
		protected $pk_id="bank_recon_id";

		function __construct()
		{
			parent::__construct();
		}
	}

?>