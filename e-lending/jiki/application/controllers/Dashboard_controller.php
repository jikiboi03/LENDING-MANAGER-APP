<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session               $session
 * @property CI_Input                 $input
 * @property CI_Loader                $load
 * @property CI_DB_query_builder      $db
 * @property Clients_model            $clients
 * @property Atm_model                $atm
 * @property Companies_model          $companies
 * @property Loans_model              $loans
 * @property Schedules_model          $schedules
 * @property Transactions_model       $transactions
 * @property Capital_model            $capital
 * @property Users_model              $users
 */
class Dashboard_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model', 'clients');
        $this->load->model('Atm/Atm_model', 'atm');
        $this->load->model('Companies/Companies_model', 'companies');
        $this->load->model('Loans/Loans_model', 'loans');
        $this->load->model('Schedules/Schedules_model', 'schedules');
        $this->load->model('Transactions/Transactions_model', 'transactions');
        $this->load->model('Capital/Capital_model', 'capital');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index()
    {
        if (
            $this->session->userdata('user_id') == '' ||
            $this->session->userdata('administrator') == '0'
        ) {
            redirect('error500');
        }

        $username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));
        if ($username_duplicates->num_rows() === 0) {
            redirect('error500');
        }

        $today = date('Y-m-d');
        $clients_list = $this->clients->get_clients();

        $clients_count = 0;
        $has_active_trans = 0;

        foreach ($clients_list as $client) {
            $active_loan = $this->loans->has_active_loan($client->client_id);
            if ($active_loan->num_rows() != 0) {
                $has_active_trans++;
            }
            $clients_count++;
        }

        $totals = $this->loans->get_total_loan_balance();
        $total_balance = $totals['balance'];
        $total_paid = $totals['paid'];

        $total_interests = $this->transactions->get_total_loan_interests()['interest'];
        $total_loans = $total_balance + $total_paid;

        $loans_cleared = $this->loans->count_loans_cleared();
        $loans_count = $this->loans->count_all_loans();

        $total_capital = $this->capital->get_total_capital();
        $total_capital = $total_capital === null ? 0 : $total_capital['total_capital'];

        $cash_on_hand = $total_capital + $total_interests - $total_balance;
        $gross_capital = $total_balance + $cash_on_hand;

        $schedules_today = $this->schedules->get_schedules_today($today);
        if ($schedules_today == null) {
            $schedules_today_str = 'None';
        } else {
            $schedules_today_str = '';
            foreach ($schedules_today as $schedule) {
                $sched_id = 'S' . $schedule->sched_id;
                $title = $schedule->title;
                $time = $schedule->time;
                $schedules_today_str .= ' | ' . $sched_id . ': ' . $title . ' @ ' . $time . '.';
            }
        }

        $active_loans_list = $this->loans->get_active_loans();
        if ($active_loans_list == null) {
            $near_due_date_str = 'None';
        } else {
            $near_due_date_str = '';
            $mo_name = date('M', strtotime($today));
            $mo_end_day = date('t', strtotime($today));
            $curr_day = date('d', strtotime($today));

            foreach ($active_loans_list as $loan) {
                $due_day = date('d', strtotime($loan->date_start));
                $mo_5day_less = $mo_end_day - 5;

                if ($curr_day > $mo_5day_less) {
                    if ($curr_day > $due_day) {
                        $ceil_day = ($curr_day + 5) - $mo_end_day;
                        if ($due_day <= $ceil_day) {
                            $near_due_date_str .= '<b>' . $this->clients->get_client_name($loan->client_id) . ' ' . $mo_name . ' ' . $due_day . '</b> - ' . (($mo_end_day + $due_day) - $curr_day) . ' day(s) left. ';
                        }
                    } else {
                        $near_due_date_str .= '<b>' . $this->clients->get_client_name($loan->client_id) . ' ' . $mo_name . ' ' . $due_day . '</b> - ' . ($due_day - $curr_day) . ' day(s) left. ';
                    }
                } else {
                    $date_diff = $due_day - $curr_day;
                    if ($date_diff <= 5 && $date_diff >= 0) {
                        $near_due_date_str .= '<b>' . $this->clients->get_client_name($loan->client_id) . ' ' . $mo_name . ' ' . $due_day . '</b> - ' . $date_diff . ' day(s) left. ';
                    }
                }
            }

            if ($near_due_date_str === '') {
                $near_due_date_str = 'None';
            }
        }

        $data = [
            'cash_on_hand'        => $cash_on_hand,
            'gross_capital'       => $gross_capital,
            'schedules_today_str' => $schedules_today_str,
            'clients_count'       => $clients_count,
            'has_active_trans'    => $has_active_trans,
            'total_balance'       => $total_balance,
            'total_paid'          => $total_paid,
            'total_interests'     => $total_interests,
            'total_loans'         => $total_loans,
            'loans_cleared'       => $loans_cleared,
            'loans_count'         => $loans_count,
            'near_due_date_str'   => $near_due_date_str,
            'title'               => 'Dashboard'
        ];

        $this->load->view('template/dashboard_header', $data);
        $this->load->view('template/dashboard_body', $data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }
}
