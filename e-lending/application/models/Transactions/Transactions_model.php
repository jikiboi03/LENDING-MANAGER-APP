<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Transactions_model extends CI_Model {
 
    var $table = 'transactions';

    var $column_order = array('trans_id','date','type','amount','interest','total','remarks','encoded'); //set column field database for datatable orderable
    var $column_search = array('trans_id','date','type','amount','interest','total','remarks','encoded'); //set column field database for datatable searchable

    var $order = array('trans_id' => 'asc'); // default order 
 
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
 
    function get_datatables($loan_id)
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records of the assigned loan_id
        $this->db->where('loan_id', $loan_id);

        $query = $this->db->get();
        return $query->result();
    }

    // check for total transaction interests
    function get_total_loan_interests()
    {
        $this->db->select('SUM(interest) AS interest');
        $this->db->from($this->table);

        $query = $this->db->get();

        $data['interest'] = $query->row()->interest;

        return $data;
    }

    // get number of children registered by month
    // public function get_monthly_registrations($month, $year)
    // {
    //     $this->db->select('COUNT(child_id) AS child_count');    
        
    //     $this->db->from($this->table);

    //     $date_from = $year . '-' . $month . '-01';
    //     $date_to = $year . '-' . $month . '-31';

    //     $this->db->where('date_registered >=', $date_from);
    //     $this->db->where('date_registered <=', $date_to);
    //     $this->db->where('removed', '0');
        
    //     $query = $this->db->get();

    //     $data['child_count'] = $query->row()->child_count;

    //     return $data;
    // }

    // get monthly loan interests by month
    public function get_monthly_loan_interests($month, $year)
    {
        $this->db->select('SUM(interest) AS interest');    
        
        $this->db->from($this->table);

        $date_from = $year . '-' . $month . '-01';
        $date_to = $year . '-' . $month . '-31';

        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        
        $query = $this->db->get();

        $data['interest'] = $query->row()->interest;

        return $data;
    }

    function get_loan_id($trans_id)
    {
        $this->db->select('loan_id');
        $this->db->from($this->table);
        $this->db->where('trans_id',$trans_id);

        $query = $this->db->get();

        $row = $query->row();

        return $row->loan_id;
    }
 
    function count_filtered($loan_id)
    {
        $this->_get_datatables_query();

        // get only records of the assigned loan_id
        $this->db->where('loan_id', $loan_id);

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($loan_id)
    {
        $this->db->from($this->table);

        // get only records of the assigned loan_id
        $this->db->where('loan_id', $loan_id);

        return $this->db->count_all_results();
    }
 
    public function get_by_id($trans_id)
    {
        $this->db->from($this->table);
        $this->db->where('trans_id',$trans_id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    // delete loans data
    public function delete_by_id($loan_id)
    {
        $this->db->where('loan_id', $loan_id);
        $this->db->delete($this->table);
    }
}