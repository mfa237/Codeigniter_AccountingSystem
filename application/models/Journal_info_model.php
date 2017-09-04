<?php

class Journal_info_model extends CORE_Model{

    protected  $table="journal_info"; //table name
    protected  $pk_id="journal_id"; //primary key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_bank_recon($bank_id,$sDate,$eDate) 
    {
        $sql="SELECT 
                t.*
            FROM
                (SELECT 
                    ji.*,
                    IF(ji.supplier_id = 0,c.customer_name,s.supplier_name) as particular,
                    department_name
                FROM
                    journal_info as ji
                LEFT JOIN suppliers AS s ON s.supplier_id = ji.supplier_id
                LEFT JOIN customers AS c ON c.customer_id = ji.customer_id
                LEFT JOIN departments AS d ON d.department_id = ji.department_id
                WHERE
                    ji.is_deleted = FALSE
                    AND ji.is_active = TRUE
                    AND ji.payment_method_id=2
                    AND ji.is_reconciled = 0
                    AND ji.bank_id = $bank_id
                    AND ji.date_txn BETWEEN '$sDate' AND '$eDate') AS t
                WHERE
                t.book_type = 'CDJ' OR t.book_type = 'CRJ'";

            return $this->db->query($sql)->result();
    }

    function get_supplier_subsidiary($supplier_id, $account_id, $startDate, $endDate) {
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
            ji.supplier_id,
            supplier_name,
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
            suppliers AS s ON s.supplier_id = ji.supplier_id
            WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE AND ji.supplier_id=$supplier_id AND ja.account_id=$account_id
            AND date_txn BETWEEN '$startDate' AND '$endDate'
            ORDER BY date_txn) as m";

            return $this->db->query($sql)->result();
    }


    function get_annual_income_statement($account_type) {
        $january=date('Y-01');
        $february=date('Y-02');
        $march=date('Y-03');
        $april=date('Y-04');
        $may=date('Y-05');
        $june=date('Y-06');
        $july=date('Y-07');
        $august=date('Y-08');
        $september=date('Y-09');
        $october=date('Y-10');
        $november=date('Y-11');
        $december=date('Y-12');

        $sql="SELECT
            core.*,
            SUM(core.jan_balance) as core_jan_balance,
            SUM(core.feb_balance) as core_feb_balance,
            SUM(core.mar_balance) as core_mar_balance,
            SUM(core.apr_balance) as core_apr_balance,
            SUM(core.may_balance) as core_may_balance,
            SUM(core.jun_balance) as core_jun_balance,
            SUM(core.jul_balance) as core_jul_balance,
            SUM(core.aug_balance) as core_aug_balance,
            SUM(core.sep_balance) as core_sep_balance,
            SUM(core.oct_balance) as core_oct_balance,
            SUM(core.nov_balance) as core_nov_balance,
            SUM(core.dec_balance) as core_dec_balance
        FROM
        (SELECT
        *
        FROM
        (SELECT 
        main.*,
        main.account_balance as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$january%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id) as tbl_prev

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        main.account_balance as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$february%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        main.account_balance as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$march%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        main.account_balance as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$april%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        main.account_balance as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$may%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        main.account_balance as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$june%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        main.account_balance as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$july%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        main.account_balance as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$august%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        main.account_balance as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$september%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        main.account_balance as oct_balance,
        0 as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$october%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        main.account_balance as nov_balance,
        0 as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$november%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id

        UNION ALL

        SELECT 
        main.*,
        0 as jan_balance,
        0 as feb_balance,
        0 as mar_balance,
        0 as apr_balance,
        0 as may_balance,
        0 as jun_balance,
        0 as jul_balance,
        0 as aug_balance,
        0 as sep_balance,
        0 as oct_balance,
        0 as nov_balance,
        main.account_balance as dec_balance,
        att.account_title 
        FROM
        (SELECT 
            ji.journal_id,
            at.account_no,
            at.grand_parent_id,
            ac.account_type_id,
            ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)
            )as account_balance
        FROM journal_info as ji
        INNER JOIN 
        (journal_accounts as ja 
        INNER JOIN
        (account_titles as at
        INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
        ON ja.account_id=at.account_id)
        ON ji.journal_id=ja.journal_id
        WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
        AND ac.account_type_id=$account_type
        AND ji.date_txn LIKE '%$december%'

        GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id)
        as core

        GROUP BY core.grand_parent_id";

        return $this->db->query($sql)->result();
    }

    function get_cur_prev_balance($account_type_id,$prev_sDate,$prev_eDate,$cur_sDate,$cur_eDate) {
        $sql="SELECT
                core.*,
                SUM(core.prev_balance) as core_prev_balance,
                SUM(core.cur_balance) as core_cur_balance
            FROM
            (SELECT
            *
            FROM
            (SELECT 
            main.*,
            main.account_balance as prev_balance,
            0 as cur_balance,
            att.account_title 
            FROM
            (SELECT 
                ji.journal_id,
                at.account_no,
                at.grand_parent_id,
                ac.account_type_id,
                ac.account_class_id,
                IF(
                    ac.account_type_id=1 OR ac.account_type_id=5,
                    SUM(ja.dr_amount)-SUM(ja.cr_amount),
                    SUM(ja.cr_amount)-SUM(ja.dr_amount)
                )as account_balance
            FROM journal_info as ji
            INNER JOIN 
            (journal_accounts as ja 
            INNER JOIN
            (account_titles as at
            INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
            ON ja.account_id=at.account_id)
            ON ji.journal_id=ja.journal_id
            WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
            AND ac.account_type_id=$account_type_id
            AND ji.date_txn BETWEEN '$prev_sDate' AND '$prev_eDate'

            GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id) as tbl_prev

            UNION ALL

            SELECT 
            main.*,
            0 as prev_balance,
            main.account_balance as cur_balance,
            att.account_title 
            FROM
            (SELECT 
                ji.journal_id,
                at.account_no,
                at.grand_parent_id,
                ac.account_type_id,
                ac.account_class_id,
                IF(
                    ac.account_type_id=1 OR ac.account_type_id=5,
                    SUM(ja.dr_amount)-SUM(ja.cr_amount),
                    SUM(ja.cr_amount)-SUM(ja.dr_amount)
                )as account_balance
            FROM journal_info as ji
            INNER JOIN 
            (journal_accounts as ja 
            INNER JOIN
            (account_titles as at
            INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
            ON ja.account_id=at.account_id)
            ON ji.journal_id=ja.journal_id
            WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
            AND ac.account_type_id=$account_type_id
            AND ji.date_txn BETWEEN '$cur_sDate' AND '$cur_eDate'

            GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id)
            as core

            GROUP BY core.grand_parent_id
            ";

            return $this->db->query($sql)->result();
    }

    function get_account_subsidiary($account_id, $startDate, $endDate,$includeChild=0) {
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
            DATE_FORMAT(ji.date_txn, '%m/%d/%Y')as date_txn,

            DATE_FORMAT(ji.date_created, '%Y-%m-%d') AS date_created,
            txn_no,
            at.account_title,par.account_title as parent_title,
            account_type,
            memo,
            remarks,
            (CASE WHEN ji.`supplier_id` = 0
            THEN CONCAT(customer_name, ' (Customer)') WHEN ji.`customer_id`=0
            THEN CONCAT(supplier_name, ' (Supplier)') END) AS particular,
            ac.account_type_id,
            ji.supplier_id,
            supplier_name,
            CONCAT(user_fname,' ',user_mname,' ',user_lname) AS posted_by,
            ja.dr_amount AS debit,
            ja.cr_amount AS credit
        FROM
            journal_accounts AS ja
                LEFT JOIN
            journal_info AS ji ON ji.journal_id = ja.journal_id
                LEFT JOIN
            (account_titles AS at LEFT JOIN account_titles as par ON par.account_id=at.grand_parent_id) ON at.account_id = ja.account_id
                LEFT JOIN
            account_classes AS ac ON ac.account_class_id = at.account_class_id
                LEFT JOIN
            account_types AS atypes ON atypes.account_type_id = ac.account_type_id
                LEFT JOIN
            user_accounts AS ua ON ua.user_id = ji.created_by_user
                LEFT JOIN
            suppliers AS s ON s.supplier_id = ji.supplier_id
                LEFT JOIN
            customers AS c ON c.customer_id = ji.customer_id

            WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE

            ".($includeChild==0?
                " AND ja.account_id=$account_id ":
                " AND at.grand_parent_id IN(SELECT atx.grand_parent_id FROM account_titles as atx WHERE atx.account_id=$account_id)"
            )."


            AND date_txn BETWEEN '$startDate' AND '$endDate'
            ORDER BY date_txn) as m";

            return $this->db->query($sql)->result();
    }


    function get_account_balance($type_id,$depid=null,$start=null,$end=null){
        $sql="SELECT main.*,att.account_title FROM(SELECT ji.journal_id,
            at.account_no,at.grand_parent_id,ac.account_type_id,ac.account_class_id,
            IF(
                ac.account_type_id=1 OR ac.account_type_id=5,
                SUM(ja.dr_amount)-SUM(ja.cr_amount),
                SUM(ja.cr_amount)-SUM(ja.dr_amount)

            )as account_balance


            FROM journal_info as ji

            INNER JOIN (journal_accounts as ja INNER JOIN
            (account_titles as at
            INNER JOIN account_classes as ac ON at.account_class_id=ac.account_class_id)
            ON ja.account_id=at.account_id)
            ON ji.journal_id=ja.journal_id

            WHERE ji.is_active=TRUE AND ji.is_deleted=FALSE
            AND ac.account_type_id=$type_id
            ".($depid!=null?" AND ji.department_id=$depid":"")."
            ".($start!=null&&$end!=null?" AND ji.date_txn BETWEEN '$start' AND '$end'":"")."

            GROUP BY at.grand_parent_id)as main LEFT JOIN account_titles as att ON main.grand_parent_id=att.account_id";
            return $this->db->query($sql)->result();
    }


    function get_petty_cash_list($asOfDate=null,$department_id=null) {
        $sql="SELECT
            ji.txn_no,
            ji.supplier_id,
            ji.remarks,
            ji.amount,
            ji.ref_no,
            ji.journal_id,
            ji.department_id,
            d.*,
            DATE_FORMAT(ji.date_txn,'%m/%d/%Y') AS date_txn,
            s.*,
            ja.account_id
            FROM journal_info AS ji
            LEFT JOIN suppliers AS s ON s.supplier_id=ji.`supplier_id`
            INNER JOIN journal_accounts AS ja ON ja.`journal_id`=ji.`journal_id`
            LEFT JOIN account_titles AS atitle ON atitle.`account_id`=ja.`account_id`
            LEFT JOIN `account_classes` AS ac ON ac.`account_class_id`=atitle.`account_class_id`
            LEFT JOIN departments AS d ON d.department_id=ji.department_id
            WHERE
            ji.`is_active`=TRUE AND
            ji.`is_deleted`=FALSE AND
            ji.book_type='PCV' AND
            ac.`account_type_id`=5 AND
            ji.is_replenished=FALSE AND
            ji.`date_txn` <= '$asOfDate'".
            ($department_id==1 ? "" : " AND ji.department_id = $department_id");
       return $this->db->query($sql)->result();
    }


    function get_grand_parent_account_subsidiary($start,$end){
        $sql="SELECT ji.date_txn,ji.txn_no,

                IF(ji.supplier_id>0,s.supplier_name,c.customer_name) as particular,
                ja.memo,ji.remarks,ja.dr_amount,ja.cr_amount,ja.account_id

                FROM (journal_info as ji
                LEFT JOIN customers as c ON c.customer_id=ji.customer_id
                LEFT JOIN suppliers as s ON s.supplier_id=ji.supplier_id
                )
                INNER JOIN (journal_accounts as ja
                INNER JOIN account_titles as at ON at.account_id=ja.account_id
                ) ON ja.journal_id=ji.journal_id

                WHERE ji.date_txn BETWEEN '$start' AND '$end'

                ORDER BY ji.date_txn";
      
      return $this->db->query($sql)->result();
    }

    function get_remaining_amount($asOfDate=null, $department_id=null) {
        $sql="SELECT
            (CASE WHEN x.`account_type_id` = 1 OR x.account_type_id=5 THEN
            IFNULL(((x.dr_amount) - (x.cr_amount)),0)
            ELSE
            IFNULL(((x.cr_amount) - (x.dr_amount)),0)
            END) as Balance
            FROM
            (SELECT
            petty_cash_account_id,
            ja.journal_id,
            ac.account_type_id,
            SUM(ja.dr_amount) AS dr_amount,
            SUM(ja.cr_amount) AS cr_amount,
            ji.date_txn,
            ji.department_id
            FROM `account_integration` AS ai
            LEFT JOIN journal_accounts AS ja ON ja.account_id=ai.petty_cash_account_id
            LEFT JOIN account_titles AS atitles ON atitles.account_id=ai.petty_cash_account_id
            LEFT JOIN account_classes AS ac ON ac.`account_class_id`=atitles.`account_class_id`
            LEFT JOIN journal_info AS ji ON ji.journal_id=ja.`journal_id` AND ji.is_active=TRUE AND ji.is_deleted=FALSE
            WHERE is_replenished=FALSE AND date_txn <= '$asOfDate' ".($department_id == 1 ? ") as x" : " AND ji.department_id=".$department_id.") AS x ");


        return $this->db->query($sql)->result();

    }



        function get_voucher_registry($startDate,$endDate) {
        $sql="SELECT


            
            SUM(ji.amount) AS summmary,
            ji.*,
            s.*

            FROM
            `journal_info` AS ji
            LEFT JOIN suppliers AS s ON s.`supplier_id`=ji.`supplier_id`
            WHERE ji.is_deleted=FALSE AND ji.is_active=TRUE
            AND ji.date_txn BETWEEN '$startDate' AND '$endDate'
            AND ji.book_type = 'CDJ' GROUP BY ji.journal_id
          ";

            return $this->db->query($sql)->result();
    }


    function get_voucher_registry_total($startDate,$endDate) {
        $sql="SELECT
        
            ROUND(SUM(amount), 2) as summary
            FROM
            journal_info
             WHERE journal_info.is_deleted=FALSE AND journal_info.is_active=TRUE
             AND journal_info.date_txn BETWEEN '$startDate' AND '$endDate'
             AND journal_info.book_type = 'CDJ' 

          ";

            return $this->db->query($sql)->result();
    }

        function get_check_registry($startDate,$endDate,$bank) {
        $sql="SELECT


            
            SUM(ji.amount) AS summmary,
            ji.*,
            s.*,
            bank.bank_id,
            bank.bank_name

            FROM
            `journal_info` AS ji
            LEFT JOIN suppliers AS s ON s.`supplier_id`=ji.`supplier_id`
            LEFT JOIN bank ON bank.bank_id = ji.bank_id 
            WHERE ji.is_deleted=FALSE AND ji.is_active=TRUE
            AND ji.bank_id = '$bank'
            AND ji.date_txn BETWEEN '$startDate' AND '$endDate' AND payment_method_id = 2
            AND ji.book_type = 'CDJ' GROUP BY ji.journal_id
          ";

            return $this->db->query($sql)->result();
    }




}

?>
