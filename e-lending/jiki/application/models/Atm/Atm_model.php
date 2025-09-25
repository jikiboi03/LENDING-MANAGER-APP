<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atm_model extends CI_Model
{
    protected $table = 'atm_banks';
    protected $column_order = ['atm_id', 'name', 'remarks', 'encoded', null];
    protected $column_search = ['atm_id', 'name', 'encoded'];
    protected $order = ['atm_id' => 'desc']; // default order 

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
            $order_column = $_POST['order']['0']['column'];
            $order_dir = $_POST['order']['0']['dir'];
            $this->db->order_by($this->column_order[$order_column], $order_dir);
        } else {
            $default_order = $this->order;
            $this->db->order_by(key($default_order), $default_order[key($default_order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $this->db->where('removed', '0');
        return $this->db->get()->result();
    }

    public function get_duplicates($name)
    {
        return $this->db
            ->from($this->table)
            ->where('name', $name)
            ->get();
    }

    public function get_atm()
    {
        return $this->db
            ->from($this->table)
            ->where('removed', '0')
            ->get()
            ->result();
    }

    public function get_atm_id($name)
    {
        $row = $this->db
            ->select('atm_id')
            ->from($this->table)
            ->where('name', $name)
            ->get()
            ->row();

        return $row->atm_id ?? null;
    }

    public function get_atm_name($atm_id)
    {
        $row = $this->db
            ->select('name')
            ->from($this->table)
            ->where('atm_id', $atm_id)
            ->get()
            ->row();

        return $row->name ?? null;
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->where('removed', '0');
        return $this->db->get()->num_rows();
    }

    public function count_all()
    {
        return $this->db
            ->from($this->table)
            ->where('removed', '0')
            ->count_all_results();
    }

    public function get_by_id($atm_id)
    {
        return $this->db
            ->from($this->table)
            ->where('atm_id', $atm_id)
            ->get()
            ->row();
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
