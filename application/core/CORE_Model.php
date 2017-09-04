<?php

class CORE_model extends CI_Model
{
    protected  $table; //table name
    protected  $pk_id; //primary key id
    protected  $fk_id; //foreign key id


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function set($field,$value,$b=FALSE){ //FALSE will treat the $value as function to be executed on MySQL
        return $this->db->set($field,$value,$b);
    }

    function save(){
        return $this->db->insert($this->table, $this);
    }

    function modify($id){

        if(is_numeric($id)){
            $this->db->where($this->table.'.'.$this->pk_id,$id); //if the argument is NUMERIC, always filter on the primary key
        }else{
            $this->db->where($id); //if STRING or is ARRAY, just pass it
        }

        return $this->db->update($this->table, $this);
    }







    function  begin(){
        $this->db->trans_start(); //start transaction
    }

    function  commit(){
        $this->db->trans_complete(); //commit transaction
    }

    function status(){
        return $this->db->trans_status();
    }

    function create($data){
        //array of data to be inserted
        return $this->db->insert($this->table,$data);
    }

    function update($id,$data){
        $this->db->where($this->pk_id,$id);
        return   $this->db->update($this->table,$data);
    }

    function delete($id){
        //@modified 1/25/2017 to support array and string parameters
        if(is_numeric($id)) {
            $this->db->where($this->pk_id, $id);//if the argument is NUMERIC, always delete based on the primary key
        }else{
            $this->db->where($id); //if STRING or is ARRAY, delete base on the parameter fields
        }
        return   $this->db->delete($this->table);
    }

    function last_insert_id(){
        return $this->db->insert_id();
    }

    function delete_via_fk($id){
        $this->db->where($this->fk_id,$id);
        return   $this->db->delete($this->table);
    }



    function get_list($where_filter=null,$select_list=null,$join_array=null,$order_by=null,$group_by=null,$auto_select_escape=TRUE,$limit=null,$having=null){

        //select fields
        $this->db->select(($select_list===null?$this->table.'.*':(is_array($select_list)?join(',',$select_list):$select_list)),$auto_select_escape);
        $this->db->from($this->table);

        //joins
        if($join_array!=null){
            foreach($join_array as $tbl_join){
                $this->db->join($tbl_join[0],$tbl_join[1],$tbl_join[2]);
            }
        }



        //filter
        //if($where_filter!=null&&is_array($where_filter)){$this->db->where($where_filter); } //if the parameter is not null and provided as array then add where filter
        //if($where_filter!=null&&!is_array($where_filter)){$this->db->where($this->pk_id,$where_filter); } //if the parameter is not null and provided as value then add where filter on primary key
        //if($custom_where_filter!=null){$this->db->where($custom_where_filter);}

        //modifed @ 07/28/2016 to support array, string and numeric argument as filter
        if($where_filter!=null){
            if(is_numeric($where_filter)){
                $this->db->where($this->table.'.'.$this->pk_id,$where_filter); //if the argument is NUMERIC, always filter on the primary key
            }else{
                $this->db->where($where_filter); //if STRING or is ARRAY, just pass it
            }
        }

        //group by
        if($group_by!=null){ $this->db->group_by($group_by); }

        //order by
        $this->db->order_by($order_by==null?$this->table.'.'.$this->pk_id.' ASC':(is_array($order_by)?join(',',$order_by):$order_by));

        //limit
        if($limit!=null){ $this->db->limit($limit); }

        //having
        if($having!=null){ $this->db->having($having); }

        $query = $this->db->get();
        return $query->result();
    }







}




?>