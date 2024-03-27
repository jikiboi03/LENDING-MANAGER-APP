<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Capital_model extends CI_Model {
 
    var $table = 'capital';

    var $column_order = array('capital_id','date','amount','total','remarks',null,'encoded'); //set column field database for datatable orderable
    var $column_search = array('capital_id','date','amount','total','remarks','encoded'); //set column field database for datatable searchable

    var $order = array('capital_id' => 'asc'); // default order 
 
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
 
    function get_datatables()
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    // get all capital details
    function get_capitals()
    {
        $this->db->from($this->table);

        $query = $this->db->get();

        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
 
    public function get_by_id($capital_id)
    {
        $this->db->from($this->table);
        $this->db->where('capital_id',$capital_id);
        $query = $this->db->get();
 
        return $query->row();
    }

    // get total capital by getting latest capital value
    public function get_total_capital()
    {
        $this->db->order_by('capital_id', 'DESC');
        $this->db->limit(1);

        $this->db->from($this->table);

        $query = $this->db->get();

        if ($query->row() == null)
        {
            return null;
        }
        else
        {
            $data['total_capital'] = $query->row()->total;

            return $data;
        }
    }

    // get total capital additions (+) negative amount values
    function get_total_capital_additions()
    {
        $this->db->select('SUM(amount) AS amount');
        $this->db->from($this->table);

        // get only records of the assigned loan_id
        $this->db->where('amount >', 0);

        $query = $this->db->get();

        $data['amount'] = $query->row()->amount;

        return $data;
    }

    // get total capital deducations (-) negative amount values
    function get_total_capital_deductions()
    {
        $this->db->select('SUM(amount) AS amount');
        $this->db->from($this->table);

        // get only records of the assigned loan_id
        $this->db->where('amount <', 0);

        $query = $this->db->get();

        $data['amount'] = $query->row()->amount;

        return $data;
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
}