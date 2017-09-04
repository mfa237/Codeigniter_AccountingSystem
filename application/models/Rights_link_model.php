<?php
class Rights_link_model extends CORE_Model{
    protected  $table="rights_links"; //table name
    protected  $pk_id="link_id"; //primary key id
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function create_default_link_list(){
        $sql="INSERT INTO `rights_links` (`link_id`, `parent_code`, `link_code`, `link_name`) VALUES
                                          (1,'1','1-1','General Journal'),
                                          (2,'1','1-2','Cash Disbursement'),
                                          (3,'1','1-3','Purchase Journal'),
                                          (4,'1','1-4','Sales Journal'),
                                          (5,'1','1-5','Cash Receipt'),
                                          (6,'2','2-1','Purchase Order'),
                                          (7,'2','2-2','Purchase Invoice'),
                                          (8,'2','2-3','Record Payment'),
                                          (9,'2','2-4','Item Issuance'),
                                          (10,'2','2-5','Item Adjustment (In)'),
                                          (11,'3','3-1','Sales Order'),
                                          (12,'3','3-2','Sales Invoice'),
                                          (13,'3','3-3','Record Payment'),
                                          (14,'4','4-2','Category Management'),
                                          (15,'4','4-3','Department Management'),
                                          (16,'4','4-4','Unit Management'),
                                          (17,'5','5-1','Product Management'),
                                          (18,'5','5-2','Supplier Management'),
                                          (19,'5','5-3','Customer Management'),
                                          (20,'6','6-1','Setup Tax'),
                                          (21,'6','6-2','Setup Chart of Accounts'),
                                          (22,'6','6-3','Account Integration'),
                                          (23,'6','6-4','Setup User Group'),
                                          (24,'6','6-5','Create User Account'),
                                          (25,'6','6-6','Setup Company Info'),
                                          (26,'7','7-1','Purchase Order for Approval'),
                                          (27,'9','9-1','Balance Sheet Report'),
                                          (28,'9','9-2','Income Statement'),
                                          (29,'4','4-1','Account Classification'),
                                          (30,'8','8-1','Sales Report'),
                                          (31,'8','8-2','Batch Inventory Report'),
                                          (32,'5','5-4','Salesperson Management'),
                                          (33,'2','2-6','Item Adjustment (Out)'),
                                          (34,'8','8-3','Export Sales Summary'),
                                          (35,'9','9-3','Export Trial Balance'),
                                          (36,'6','6-7','Setup Check Layout'),
                                          (37,'9','9-4','AR Schedule'),
                                          (38,'9','9-6','Customer Subsidiary'),
                                          (39,'9','9-8','Account Subsidiary'),
                                          (40,'9','9-7','Supplier Subsidiary'),
                                          (41,'9','9-5','AP Schedule'),
                                          (42,'8','8-4','Purchase Invoice Report'),
                                          (43,'4','4-5','Locations Management'),
                                          (44,'10','10-1','Fixed Asset Management'),
                                          (45,'9','9-9','Annual Income Statement'),
                                          (46,'6','6-8','Recurring Template'),
                                          (47,'9','9-10','VAT Relief Report'),
                                          (48,'1','1-6','Petty Cash Journal'),
                                          (49,'9','9-13','Replenishment Report'),
                                          (50,'6','6-9','Backup Database'),
                                          (51,'9','9-14','Book of Accounts'),
                                          (52,'9','9-16','Comparative Income'),
                                          (53,'4','4-6','Bank Reference Management'),
                                          (54,'10','10-2','Depreciation Expense Report'),
                                          (55,'11','11-1','Bank Reconciliation'),
                                          (57,'12','12-1','Voucher Registry Report'),
                                          (58,'12','12-2','Check Registry Report'),
                                          (59,'12','12-3','Collection List Report'),
                                          (60,'12','12-4','Open Purchase Report'),
                                          (61,'12','12-5','Open Sales Report'),
                                          (62,'9','9-11','Schedule of Expense'),
                                          (63,'9','9-15','AR Reports'),
                                          (64,'9','9-12','Cost of Goods'),
                                          (65,'13','13-1','Service Invoice'),
                                          (66,'13','13-2','Service Journal'),
                                          (67,'13','13-3','Service Unit Management'),
                                          (68,'13','13-4','Service Management'),
                                          (69,'9','9-17','Aging of Receivables'),
                                          (70,'9','9-18','Aging of Payables'),
                                          (71,'9','9-19','Statement of Account'),
                                          (72,'6','6-10','Email Settings')

                                          ON DUPLICATE KEY UPDATE
                                          rights_links.parent_code=VALUES(rights_links.parent_code),
                                          rights_links.link_code=VALUES(rights_links.link_code),
                                          rights_links.link_name=VALUES(rights_links.link_name)
            ";
        $this->db->query($sql);
    }
}
?>