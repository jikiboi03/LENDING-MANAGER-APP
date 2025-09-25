<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Capital_model extends CI_Model
{
    protected $table = 'capital';
    protected $column_order = ['capital_id', 'date', 'amount', 'total', 'remarks', 'encoded', null];
    protected $column_search = ['capital_id', 'date', 'amount', 'total', 'remarks', 'encoded'];
    protected $order = ['capital_id' => 'asc'];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $search_value = $_POST['search']['value'] ?? null;

        if ($search_value) {
            $this->db->group_start();
            foreach ($this->column_search as $i => $item) {
                if ($i === 0) {
                    $this->db->like($item, $search_value);
                } else {
                    $this->db->or_like($item, $search_value);
                }
            }
            $this->db->group_end();
        }

        if (!empty($_POST['order'])) {
            $order_column = $_POST['order'][0]['column'];
            $order_dir = $_POST['order'][0]['dir'];
            $this->db->order_by($this->column_order[$order_column], $order_dir);
        } else {
            $this->db->order_by(key($this->order), current($this->order));
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    public function get_capitals()
    {
        return $this->db->from($this->table)->get()->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->db->get()->num_rows();
    }

    public function count_all()
    {
        return $this->db->from($this->table)->count_all_results();
    }

    public function get_by_id($capital_id)
    {
        return $this->db
            ->from($this->table)
            ->where('capital_id', $capital_id)
            ->get()
            ->row();
    }

    public function get_total_capital()
    {
        $query = $this->db
            ->from($this->table)
            ->order_by('capital_id', 'DESC')
            ->limit(1)
            ->get();

        $row = $query->row();
        return $row ? ['total_capital' => $row->total] : null;
    }

    public function get_total_capital_additions()
    {
        $row = $this->db
            ->select('SUM(amount) AS amount')
            ->from($this->table)
            ->where('amount >', 0)
            ->get()
            ->row();

        return ['amount' => $row->amount];
    }

    public function get_total_capital_deductions()
    {
        $row = $this->db
            ->select('SUM(amount) AS amount')
            ->from($this->table)
            ->where('amount <', 0)
            ->get()
            ->row();

        return ['amount' => $row->amount];
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
