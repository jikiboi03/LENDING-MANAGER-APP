<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loans_model extends CI_Model
{
    protected $table = 'loans';
    protected $column_order = ['loan_id', 'date_start', 'amount', 'date_end', 'total', 'status', null];
    protected $column_search = ['loan_id', 'date_start', 'amount', 'interest', 'total', 'status', 'date_end', 'remarks', 'encoded'];
    protected $order = ['loan_id' => 'desc'];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        if (!empty($_POST['search']['value'])) {
            $this->db->group_start();
            foreach ($this->column_search as $i => $item) {
                $this->db->or_like($item, $_POST['search']['value']);
            }
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
        } else {
            foreach ($this->order as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
    }

    private function _apply_limit()
    {
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
    }

    public function get_datatables($client_id)
    {
        $this->_get_datatables_query();
        $this->db->where('client_id', $client_id);
        $this->_apply_limit();
        return $this->db->get()->result();
    }

    public function get_active_loans_datatables($client_id)
    {
        $this->_get_datatables_query();
        $this->db->where(['client_id' => $client_id, 'status !=' => 3]);
        $this->_apply_limit();
        return $this->db->get()->result();
    }

    public function get_datatables_top_list()
    {
        $this->db->select('client_id, SUM(paid) AS paid, SUM(balance) AS balance, SUM(paid + balance) AS total_loans', false);
        $this->db->from($this->table);
        $this->db->group_by('client_id');
        $this->db->order_by('total_loans', 'DESC');
        $this->_apply_limit();
        return $this->db->get()->result();
    }

    public function get_client_total_balance($client_id)
    {
        return $this->db->select_sum('balance')
            ->from($this->table)
            ->where('client_id', $client_id)
            ->get()->row()->balance;
    }

    public function has_active_loan($client_id)
    {
        return $this->db->from($this->table)
            ->where(['client_id' => $client_id, 'status !=' => 3])
            ->get();
    }

    public function get_active_loans()
    {
        $past_five_days = date('Y-m-d', strtotime('-5 days'));
        return $this->db->from($this->table)
            ->where('status !=', 3)
            ->where('date_start <=', $past_five_days)
            ->order_by('SUBSTRING(date_start, 8)')
            ->get()->result();
    }

    public function get_total_loan_balance()
    {
        $result = $this->db->select('SUM(balance) AS balance, SUM(paid) AS paid')
            ->from($this->table)
            ->get()->row();
        return ['balance' => $result->balance, 'paid' => $result->paid];
    }

    public function get_client_id($loan_id)
    {
        return $this->db->select('client_id')->from($this->table)->where('loan_id', $loan_id)->get()->row()->client_id;
    }

    public function get_paid_value($loan_id)
    {
        return $this->db->select('paid')->from($this->table)->where('loan_id', $loan_id)->get()->row()->paid;
    }

    public function count_loans_cleared()
    {
        return $this->db->from($this->table)->where('status', 3)->count_all_results();
    }

    public function count_all_loans()
    {
        return $this->db->from($this->table)->count_all_results();
    }

    public function count_filtered($client_id)
    {
        $this->_get_datatables_query();
        $this->db->where('client_id', $client_id);
        return $this->db->get()->num_rows();
    }

    public function count_all($client_id)
    {
        return $this->db->from($this->table)->where('client_id', $client_id)->count_all_results();
    }

    public function count_active_loans_filtered($client_id)
    {
        $this->_get_datatables_query();
        $this->db->where(['client_id' => $client_id, 'status !=' => 3]);
        return $this->db->get()->num_rows();
    }

    public function count_active_loans_all($client_id)
    {
        return $this->db->from($this->table)
            ->where(['client_id' => $client_id, 'status !=' => 3])
            ->count_all_results();
    }

    public function count_filtered_top_list()
    {
        $this->db->select('client_id, SUM(paid) AS paid, SUM(balance) AS balance, SUM(paid + balance) AS total_loans', false)
            ->from($this->table)
            ->group_by('client_id')
            ->order_by('total_loans', 'DESC');
        return $this->db->get()->num_rows();
    }

    public function count_all_top_list()
    {
        return $this->count_filtered_top_list();
    }

    public function get_by_id($loan_id)
    {
        return $this->db->from($this->table)->where('loan_id', $loan_id)->get()->row();
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

    public function delete_by_id($loan_id)
    {
        $this->db->where('loan_id', $loan_id)->delete($this->table);
    }

    public function adjust_balance($loan_id, $amount, $operation = 'deduct')
    {
        $adjustment = ($operation === 'deduct') ? '-' . $amount : '+' . (-1 * $amount);
        $this->db->set('balance', "balance$adjustment", false)->where('loan_id', $loan_id)->update($this->table);
    }

    public function adjust_paid($loan_id, $amount, $operation = 'add')
    {
        $adjustment = ($operation === 'add') ? '+' . $amount : '-' . (-1 * $amount);
        $this->db->set('paid', "paid$adjustment", false)->where('loan_id', $loan_id)->update($this->table);
    }

    public function change_status($loan_id, $status)
    {
        $this->db->set('status', $status)->where('loan_id', $loan_id)->update($this->table);
    }

    public function update_loan_balance($loan_id, $balance)
    {
        $this->db->set('balance', $balance)->where('loan_id', $loan_id)->update($this->table);
    }

    public function update_loan_paid($loan_id, $paid)
    {
        $this->db->set('paid', $paid)->where('loan_id', $loan_id)->update($this->table);
    }
}
