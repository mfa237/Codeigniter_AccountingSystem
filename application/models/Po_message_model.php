<?php

class Po_message_model extends CORE_Model {
    protected  $table="po_messages";
    protected  $pk_id="po_message_id";

    function __construct() {
        parent::__construct();
    }


    function get_po_message_list($po_id=null,$po_message_id=null){
        $sql="SELECT m.*,

(
                            CASE
                                WHEN m.DaysPosted>0 THEN CONCAT(m.DaysPosted,' day ago')
                                WHEN m.DaysPosted=0 AND m.HoursPosted>0 THEN CONCAT(m.HoursPosted,' hour ago')
                                WHEN m.DaysPosted=0 AND m.HoursPosted=0 AND m.MinutePosted>0 THEN CONCAT(m.MinutePosted,' min ago')
                                WHEN m.DaysPosted=0 AND m.HoursPosted=0 AND m.MinutePosted=0 AND m.SecondPosted>0 THEN CONCAT(m.SecondPosted,' sec ago')
                                ELSE '1 sec ago'
                            END
                        )as time_description

            FROM

            (SELECT pom.*,

                CONCAT(DAYNAME(pom.date_posted),', ',DATE_FORMAT(pom.date_posted,'%M %d, %Y %r'))as full_date_description,
                TIME_FORMAT(pom.date_posted,'%r') as TimePosted,
                DATEDIFF(NOW(),pom.date_posted)as DaysPosted,
                HOUR(TIMEDIFF(pom.date_posted,NOW()))as HoursPosted,
                MINUTE(TIMEDIFF(pom.date_posted,NOW()))as MinutePosted,
                SECOND(TIMEDIFF(pom.date_posted,NOW()))as SecondPosted,
                CONCAT_WS(' ',ua.user_fname,ua.user_lname)as message_posted_by,
                ua.photo_path

            FROM
              po_messages as pom
            LEFT JOIN
              user_accounts as ua
            ON
              pom.user_id=ua.user_id
            WHERE
              pom.is_deleted=FALSE

           ".($po_id==null?'':' AND pom.purchase_order_id='.$po_id)."
           ".($po_message_id==null?'':' AND pom.po_message_id='.$po_message_id)."

            )as m ORDER BY m.po_message_id";
        return $this->db->query($sql)->result();
    }





}

?>