<?php
	class Asset_property_status_model extends CORE_Model
	{
		protected $table="asset_property_status";
		protected $pk_id="asset_status_id";

		function __construct()
		{
			parent::__construct();
		}

		function create_default_asset_property(){
	        $sql="INSERT INTO
	                  asset_property_status(asset_status_id,asset_property_status)
	              VALUES
	                  (1,'Active'),
	                  (2,'Inactive'),
	                  (3,'Obsolete'),
	                  (4,'Lost'),
	                  (5,'Damage')
	              ON DUPLICATE KEY UPDATE
	                  asset_property_status.asset_status_id=VALUES(asset_property_status.asset_status_id),
	                  asset_property_status.asset_property_status=VALUES(asset_property_status.asset_property_status),
	                  asset_property_status.is_deleted=FALSE";

	        $this->db->query($sql);
	    }
	}
?>