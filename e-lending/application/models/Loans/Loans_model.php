<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Loans_model extends CI_Model {
 
    var $table = 'loans';

    var $column_order = array('loan_id','amount','interest','total','status','date_start','date_end','remarks',null,'encoded'); //set column field database for datatable orderable
    var $column_search = array('loan_id','amount','interest','total','status','date_start','date_end','remarks','encoded'); //set column field database for datatable searchable

    var $order = array('loan_id' => 'desc'); // default order 
 
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

    private function _get_datatables_query_top_list()
    {   
        $this->db->from($this->table);
 
        $i = 0;
    }
 
    function get_datatables($client_id)
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records of the assigned client_id
        $this->db->where('client_id', $client_id);

        $query = $this->db->get();
        return $query->result();
    }

    function get_active_loans_datatables($client_id)
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records of the assigned client_id
        $this->db->where('client_id', $client_id);
        $this->db->where('status !=', 3);

        $query = $this->db->get();
        return $query->result();
    }    

    // for statistics controller - top list table
    function get_datatables_top_list()
    {        
        $this->_get_datatables_query_top_list();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $this->db->select('client_id, SUM(paid) AS paid, SUM(balance) AS balance, SUM(paid + balance) AS total_loans', FALSE);
        
        $this->db->group_by("client_id");
        $this->db->order_by("total_loans", "DESC");

        $query = $this->db->get();
        return $query->result();
    }

    function get_client_total_balance($client_id)
    {
        $this->db->select('SUM(balance) AS balance');
        $this->db->from($this->table);
        $this->db->where('client_id',$client_id);

        $query = $this->db->get();

        $row = $query->row();

        return $row->balance;
    }

    // check for new or ongoing loan transaction
    function has_active_loan($client_id)
    {    
        $this->db->from($this->table);
        $this->db->where('client_id',$client_id);
        $this->db->where('status !=', 3); // status is not cleared

        $query = $this->db->get();

        return $query;
    }

    // get all new or ongoing loan transactions
    function get_active_loans()
    {   
        $today = date('Y-m-d');
        $past_five_days = date('Y-m-d', strtotime($today. ' - 5 days'));
        $this->db->from($this->table);
        $this->db->where('status !=', 3); // status is not cleared
        $this->db->where('date_start <=', $past_five_days); // date start is not today

        $query = $this->db->get();

        return $query->result();
    }

    // check for total loan balance
    function get_total_loan_balance()
    {
        $this->db->select('SUM(balance) AS balance, SUM(paid) AS paid');
        $this->db->from($this->table);

        $query = $this->db->get();

        $data['balance'] = $query->row()->balance;
        $data['paid'] = $query->row()->paid;

        return $data;
    }

    function get_client_id($loan_id)
    {
        $this->db->select('client_id');
        $this->db->from($this->table);
        $this->db->where('loan_id',$loan_id);

        $query = $this->db->get();

        $row = $query->row();

        return $row->client_id;
    }

    function get_paid_value($loan_id)
    {
        $this->db->select('paid');
        $this->db->from($this->table);
        $this->db->where('loan_id',$loan_id);

        $query = $this->db->get();

        $row = $query->row();

        return $row->paid;
    }

    public function count_loans_cleared()
    {
        $this->db->from($this->table);

        $this->db->where('status', 3); // status is cleared

        return $this->db->count_all_results();
    }

    public function count_all_loans()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
 
    function count_filtered($client_id)
    {
        $this->_get_datatables_query();

        // get only records of the assigned client_id
        $this->db->where('client_id', $client_id);

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($client_id)
    {
        $this->db->from($this->table);

        // get only records of the assigned client_id
        $this->db->where('client_id', $client_id);

        return $this->db->count_all_results();
    }

    function count_active_loans_filtered($client_id)
    {
        $this->_get_datatables_query();

        // get only records of the assigned client_id
        $this->db->where('client_id', $client_id);
        $this->db->where('status !=', 3);

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_active_loans_all($client_id)
    {
        $this->db->from($this->table);

        // get only records of the assigned client_id
        $this->db->where('client_id', $client_id);
        $this->db->where('status !=', 3);

        return $this->db->count_all_results();
    }

    function count_filtered_top_list()
    {
        $this->_get_datatables_query_top_list();

        $this->db->select('client_id, SUM(paid) AS paid, SUM(balance) AS balance, SUM(paid + balance) AS total_loans', FALSE);
        
        $this->db->group_by("client_id");
        $this->db->order_by("total_loans", "DESC");

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_top_list()
    {
        $this->db->from($this->table);

        $this->db->select('client_id, SUM(paid) AS paid, SUM(balance) AS balance, SUM(paid + balance) AS total_loans', FALSE);
        
        $this->db->group_by("client_id");
        $this->db->order_by("total_loans", "DESC");

        return $this->db->count_all_results();
    }
 
    public function get_by_id($loan_id)
    {
        $this->db->from($this->table);
        $this->db->where('loan_id',$loan_id);
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

    public function deduct_balance($loan_id, $interest_amt)
    {
        $this->db->set('balance', 'balance-' . $interest_amt, false);
        $this->db->where('loan_id' , $loan_id);
        $this->db->update($this->table);
    }
}