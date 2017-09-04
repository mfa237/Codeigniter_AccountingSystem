<?php
	class Customer_subsidiary_model extends CORE_Model 
	{
		protected $table = "journal_info";
		protected $pk_id = "journal_id";

		function __construct()
		{
			parent::__construct();
		}

		function get_customer_subsidiary($customer_id, $account_id, $startDate, $endDate){
			$this->db->query("SET @balance:=0.00;");
			$sql="SELECT m.*,
			(CASE
		        WHEN m.account_type_id=1 OR m.account_type_id=5 THEN 
		        	CONVERT((@balance:=@balance +(m.debit-m.credit)), DECIMAL(20,2))
		        ELSE 
		        	CONVERT((@balance:=@balance +(m.credit-m.debit)), DECIMAL(20,2))
		    END) AS balance
			FROM
			(SELECT 
			    date_txn,
			    DATE_FORMAT(ji.date_created, '%Y-%m-%d') AS date_created,
			    txn_no,
			    account_title,
			    account_type,
			    memo,
    			remarks,
			    ac.account_type_id,
			    ji.customer_id,
			    customer_name,
			    CONCAT(user_fname,' ',user_mname,' ',user_lname) AS posted_by,
			    ja.dr_amount AS debit,
			    ja.cr_amount AS credit
			FROM
			    journal_accounts AS ja
			        LEFT JOIN
			    journal_info AS ji ON ji.journal_id = ja.journal_id
			        LEFT JOIN
			    account_titles AS at ON at.account_id = ja.account_id
			        LEFT JOIN
			    account_classes AS ac ON ac.account_class_id = at.account_class_id
			        LEFT JOIN
			    account_types AS atypes ON atypes.account_type_id = ac.account_type_id
			        LEFT JOIN
			    user_accounts AS ua ON ua.user_id = ji.created_by_user
			        LEFT JOIN
			    customers AS c ON c.customer_id = ji.customer_id 
			    WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE AND ji.customer_id=$customer_id AND ja.account_id=$account_id
			    AND date_txn BETWEEN '$startDate' AND '$endDate'
			    ORDER BY date_txn) as m";

			    return $this->db->query($sql)->result();
		}
	}
?>