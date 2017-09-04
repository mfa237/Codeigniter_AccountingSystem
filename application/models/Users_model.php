<?php

class Users_model extends CORE_Model{

    protected  $table="user_accounts"; //table name
    protected  $pk_id="user_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_newsfeed() {
        $sql = "SELECT
                m.*,
                (
                    CASE
                        WHEN m.DaysPosted>0 THEN CONCAT(m.DaysPosted,' day(s) ago')
                        WHEN m.DaysPosted=0 AND m.HoursPosted>0 THEN CONCAT(m.HoursPosted,' hour(s) ago')
                        WHEN m.DaysPosted=0 AND m.HoursPosted=0 AND m.MinutePosted>0 THEN CONCAT(m.MinutePosted,' min(s) ago')
                        WHEN m.DaysPosted=0 AND m.HoursPosted=0 AND m.MinutePosted=0 AND m.SecondPosted>0 THEN CONCAT(m.SecondPosted,' second(s) ago')
                    ELSE
                        '1 sec ago'
                    END
                ) AS time_description
                FROM
                (SELECT
                IFNULL(ua.photo_path,'assets/img/default-user-image.png') photo_path,
                IFNULL(CONCAT(ua.user_fname,' ', ua.user_lname),'Unidentified User') as username,
                t.*,
                TIME_FORMAT(t.date,'%r') as TimePosted,
                DATEDIFF(NOW(),t.date) AS DaysPosted,
                HOUR(TIMEDIFF(t.date,NOW())) AS HoursPosted,
                MINUTE(TIMEDIFF(t.date,NOW())) AS MinutePosted,
                SECOND(TIMEDIFF(t.date,NOW())) AS SecondPosted
                FROM
                (SELECT
                po.posted_by_user user_id,
                concat('posted PO # ',po.po_no) message,
                po.date_created date
                FROM
                purchase_order po
                WHERE po.is_deleted=FALSE AND po.is_active=TRUE

                UNION

                SELECT
                po.modified_by_user user_id,
                concat('modified PO # ',po.po_no) message,
                po.date_modified date
                FROM
                purchase_order po
                WHERE po.is_deleted=FALSE AND po.is_active=TRUE

                UNION

                SELECT
                po.deleted_by_user user_id,
                concat('deleted PO # ',po.po_no) message,
                po.date_deleted date
                FROM
                purchase_order po
                WHERE po.is_deleted = TRUE

                UNION

                SELECT
                po.approved_by_user user_id,
                concat('approved PO #',po.po_no) message,
                po.date_approved date
                FROM
                purchase_order po
                WHERE po.is_deleted=FALSE AND po.is_active=TRUE

                UNION

                SELECT
                di.posted_by_user user_id,
                concat('posted Delivery inv # ', di.dr_invoice_no) message,
                di.date_created date
                FROM
                delivery_invoice di
                WHERE di.is_deleted=FALSE AND di.is_active=TRUE

                UNION

                SELECT
                di.modified_by_user user_id,
                concat('modified Delivery inv # ', di.dr_invoice_no) message,
                di.date_modified date
                FROM
                delivery_invoice di
                WHERE di.is_deleted=FALSE AND di.is_active=TRUE

                UNION

                SELECT
                di.deleted_by_user user_id,
                concat('deleted Delivery inv # ', di.dr_invoice_no) message,
                di.date_deleted date
                FROM
                delivery_invoice di

                UNION

                SELECT
                so.posted_by_user user_id,
                concat('posted SO # ', so.so_no) message,
                so.date_created date
                FROM
                sales_order so
                WHERE so.is_deleted=FALSE AND so.is_active=TRUE

                UNION

                SELECT
                so.modified_by_user user_id,
                concat('modified SO # ', so.so_no) message,
                so.date_modified date
                FROM
                sales_order so
                WHERE so.is_deleted=FALSE AND so.is_active=TRUE

                UNION

                SELECT
                so.deleted_by_user user_id,
                concat('deleted SO # ', so.so_no) message,
                so.date_deleted date
                FROM
                sales_order so
                WHERE so.is_deleted = TRUE

                UNION

                SELECT
                si.posted_by_user user_id,
                concat('posted Sales inv # ', si.sales_inv_no) message,
                si.date_created date
                FROM
                sales_invoice si
                WHERE si.is_deleted=FALSE AND si.is_active=TRUE

                UNION

                SELECT
                si.modified_by_user user_id,
                concat('modified Sales inv # ', si.sales_inv_no) message,
                si.date_modified date
                FROM
                sales_invoice si
                WHERE si.is_deleted=FALSE AND si.is_active=TRUE

                UNION

                SELECT
                si.deleted_by_user user_id,
                concat('deleted Sales inv # ', si.sales_inv_no) message,
                si.date_deleted date
                FROM
                sales_invoice si
                WHERE si.is_deleted=TRUE

                UNION

                SELECT
                rp.created_by_user user_id,
                concat('posted receipt no. ', rp.receipt_no, ' paid by ', c.customer_name, ' paid on ', rp.date_paid) message,
                rp.date_created date
                FROM
                receivable_payments rp
                INNER JOIN customers c on c.customer_id = rp.customer_id
                WHERE rp.is_deleted=FALSE AND rp.is_active=TRUE

                UNION

                SELECT
                rp.cancelled_by_user user_id,
                concat('cancelled receipt no. ', rp.receipt_no, ' paid by ', c.customer_name, ' paid on ', rp.date_paid) message,
                rp.date_cancelled date
                FROM
                receivable_payments rp
                INNER JOIN customers c on c.customer_id = rp.customer_id
                WHERE rp.is_active=FALSE

                UNION

                SELECT
                pp.created_by_user user_id,
                concat('posted receipt no. ', pp.receipt_no, ' paid by ', s.supplier_name, ' paid on ', pp.date_paid) message,
                pp.date_created date
                FROM
                payable_payments pp
                INNER JOIN suppliers s on s.supplier_id = pp.supplier_id
                WHERE pp.is_deleted=FALSE AND pp.is_active=TRUE

                UNION

                SELECT
                pp.cancelled_by_user user_id,
                concat('cancelled receipt no. ', pp.receipt_no, ' paid by ', s.supplier_name, ' paid on ', pp.date_paid) message,
                pp.date_cancelled date
                FROM
                payable_payments pp
                INNER JOIN suppliers s on s.supplier_id = pp.supplier_id
                WHERE pp.is_active=FALSE

                UNION

                SELECT
                ji.created_by_user user_id,
                ( CASE WHEN book_type = 'CDJ' 
                    THEN CONCAT('posted Txn # ', ji.txn_no, ' on Cash Disbursement Journal')
                  WHEN book_type = 'PCV'
                    THEN CONCAT('posted Txn # ', ji.txn_no,' on Petty Cash Voucher')
                  WHEN book_type = 'GJE'
                    THEN CONCAT('posted Txn #', ji.txn_no,' on General Journal Entry')
                  WHEN book_type = 'PJE'
                    THEN CONCAT('posted Txn # ', ji.txn_no,' on Purchase Journal Entry')
                  WHEN book_type = 'SJE'
                    THEN CONCAT('posted Txn # ', ji.txn_no,' on Sales Journal Entry')
                  WHEN book_type = 'CRJ'
                    THEN CONCAT('posted Txn # ', ji.txn_no,' on Cash Receipt Journal')
                  END
                ) as message,
                ji.date_created date
                FROM
                journal_info ji
                WHERE ji.is_deleted=FALSE AND ji.is_active=TRUE

                UNION

                SELECT
                ji.created_by_user user_id,
                ( CASE WHEN book_type = 'CDJ' 
                    THEN CONCAT('cancelled Txn # ', ji.txn_no, ' on Cash Disbursement Journal')
                  WHEN book_type = 'PCV'
                    THEN CONCAT('cancelled Txn # ', ji.txn_no,' on Petty Cash Voucher')
                  WHEN book_type = 'GJE'
                    THEN CONCAT('cancelled Txn #', ji.txn_no,' on General Journal Entry')
                  WHEN book_type = 'PJE'
                    THEN CONCAT('cancelled Txn # ', ji.txn_no,' on Purchase Journal Entry')
                  WHEN book_type = 'SJE'
                    THEN CONCAT('cancelled Txn # ', ji.txn_no,' on Sales Journal Entry')
                  WHEN book_type = 'CRJ'
                    THEN CONCAT('cancelled Txn # ', ji.txn_no,' on Cash Receipt Journal')
                  END
                ) as message,
                ji.date_cancelled date
                FROM
                journal_info ji
                WHERE ji.is_deleted=TRUE OR ji.is_active=FALSE) as t
                LEFT JOIN user_accounts ua ON ua.user_id = t.user_id
                ORDER BY t.date DESC LIMIT 30) AS m
                ";

                return $this->db->query($sql)->result();
    }

    function create_default_user(){

        //return;
        $sql="INSERT IGNORE INTO user_accounts
                  (user_id,user_name,user_pword,user_lname,user_fname,user_mname,user_address,user_email,user_mobile,user_group_id)
              VALUES
                  (1,'admin',SHA1('admin'),'Rueda','Paul Christian','Bontia','San Jose, San Simon, Pampanga','chrisrueda14@yahoo.com','0935-746-7601',1)
        ";
        $this->db->query($sql);

    }

    function authenticate_user($uname,$pword){
        $this->db->select('ua.user_id,ua.user_name,ua.user_group_id,ua.photo_path,ua.is_online,ua.user_email,CONCAT_WS(" ",ua.user_fname,ua.user_mname,ua.user_lname) as user_fullname');
        $this->db->from('user_accounts as ua');
        $this->db->join('user_groups as ug', 'ua.user_group_id = ug.user_group_id','left');
        $this->db->where('ua.user_name', $uname);
        $this->db->where('ua.user_pword', sha1($pword));
        $this->db->where('ua.is_active', 1);
        $this->db->where('ua.is_deleted', 0);
        // $this->db->where('ua.is_online', 0);

        return $this->db->get();

    }


    function get_user_invoice_counter(){
        $sql="SELECT ua.user_id,
                CONCAT_WS(' ',ua.user_fname,ua.user_lname) as user_fullname,
                ug.user_group,

                IFNULL(ic.counter_start,0)as counter_start,
                IFNULL(ic.counter_end,0)as counter_end,
                IFNULL(ic.last_invoice,0) as last_invoice

                FROM user_accounts as ua
                LEFT JOIN user_groups as ug ON ua.user_group_id=ug.user_group_id
                LEFT JOIN invoice_counter as ic ON ua.user_id=ic.user_id";

        return $this->db->query($sql)->result();


    }

    function validate(){
        $usertoken=$this->get_user_list($this->session->userdata('user_id'));
        if($this->session->userdata('token_id') != $usertoken[0]->token_id) {
            redirect(base_url('Login/transaction/logout'));
        } 
            date_default_timezone_set('Asia/Manila');
            $this->db->set('is_online', 1);
            $this->db->set('last_seen', date("Y-m-d H:i:s"));
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('user_accounts');
    }

    function get_user_list($id=null){

        $this->db->select('ua.user_id,ua.user_name,ua.user_lname,ua.user_fname,ua.user_mname,ua.photo_path,ua.token_id');
        $this->db->select('ua.user_address,ua.user_email,ua.user_mobile,ua.user_telephone');
        $this->db->select('DATE_FORMAT(ua.user_bdate,"%m/%d/%Y")as user_bdate,ua.user_group_id');
        $this->db->select('ua.is_active,ug.user_group,CONCAT_WS(" ",ua.user_fname,ua.user_mname,ua.user_lname)as full_name');
        $this->db->from('user_accounts as ua');
        $this->db->join('user_groups as ug', 'ua.user_group_id = ug.user_group_id','left');
        $this->db->where('ua.is_active=', 1);
        $this->db->where('ua.is_deleted=', 0);


        if($id!=null){ $this->db->where('ua.user_id=', $id); }

        return $this->db->get()->result();
    }

    function generateToken($userId){
        $static_str='AL';
        $currenttimeseconds = date("mdY_His");
        $token_id=$static_str.$userId.$currenttimeseconds;
        $data = array(
                 'tktToken' => md5($token_id),
                 'userId' => $userId,
                 );
        return md5($token_id);
     }

    function Online_users(){
        $sql="SELECT 
            IF(last_seen > NOW() - INTERVAL 5 MINUTE && is_online = 1, 1, 0) as _isonline,
            ua.*      


            FROM user_accounts ua
            WHERE is_deleted = FALSE and is_active = TRUE
            ";  
    return $this->db->query($sql)->result();

     }




}




?>