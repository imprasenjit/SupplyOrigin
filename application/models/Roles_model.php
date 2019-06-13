<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roles_model extends CI_Model
{

    public $table = 'admin_roles';
    public $id = 'role_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function get_rights(){
      $this->db->select("rights_id,display_name");
      $this->db->from("rights");
      $this->db->where('status', "1");
      $query = $this->db->get();
      return $query->result();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where("status","1");
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function check_role_name($name){
      $this->db->where(array("name"=>$name,"status"=>"1"));
      return $this->db->get($this->table)->row();
    }


    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }



    //For datatable
    function tot_rows(){
        $this->db->select("*");

        $this->db->from($this->table);
        $this->db->where('status', "1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");

        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $this->db->where('status', "1");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir){
        $this->db->select("*");
        $this->db->like($this->id, $search);
        $this->db->or_like('name', $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
        $this->db->where('status', "1");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()

    function tot_search_rows($search){
        $this->db->select("*");

        $this->db->like($this->id, $search);
        $this->db->or_like('name', $search);
        $this->db->from($this->table);
        $this->db->where('status', "1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()

    function get_roles_name($data){
      var_dump(json_decode($data));die;
    }

}

/* End of file roles_model.php */
/* Location: ./application/models/roles_model.php */
