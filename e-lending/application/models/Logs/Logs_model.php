<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Logs_model extends CI_Model {
 
    var $table = 'logs';

    var $column_order = array('log_id','log_type','details','user_fullname','date_time'); //set 

    var $column_search = array('log_id','log_type','details','user_fullname','date_time'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('log_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_access_datatables()
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $this->db->where("(log_type = 'Login' OR log_type = 'Logout' OR log_type = 'Report')");
        $query = $this->db->get();
        return $query->result();
    }

    function get_ops_datatables()
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $this->db->where("(log_type != 'Login' AND log_type != 'Logout' AND log_type != 'Report')");
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_access()
    {
        $this->_get_datatables_query();

        $this->db->where("(log_type = 'Login' OR log_type = 'Logout' OR log_type = 'Report')");
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_access()
    {
        $this->db->from($this->table);

        $this->db->where("(log_type = 'Login' OR log_type = 'Logout' OR log_type = 'Report')");
        return $this->db->count_all_results();
    }

    function count_filtered_ops()
    {
        $this->_get_datatables_query();

        $this->db->where("(log_type != 'Login' AND log_type != 'Logout' AND log_type != 'Report')");
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_ops()
    {
        $this->db->from($this->table);

        $this->db->where("(log_type != 'Login' AND log_type != 'Logout' AND log_type != 'Report')");
        return $this->db->count_all_results();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
}