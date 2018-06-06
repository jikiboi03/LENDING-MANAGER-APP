<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Login_controller/index';
$route['404_override'] = '';
$route['error500'] = 'error_controller';
$route['translate_uri_dashes'] = TRUE;


// $route['log-user'] = 'login_controller/login_validation';


$route['dashboard'] = 'Dashboard_controller/index';
$route['user-logout'] = 'Login_controller/logout';


//************************************** COMPANIES ROUTES
//**************************************

$route['companies-page'] = 'Companies/Companies_controller';

$route['showlist-companies'] = 'Companies/Companies_controller/ajax_list';

$route['edit-company/(:num)'] = 'Companies/Companies_controller/ajax_edit/$1';

$route['add-company/(:num)'] = 'Companies/Companies_controller/ajax_add/$1';

$route['update-company/(:num)'] = 'Companies/Companies_controller/ajax_update/$1';

$route['delete-company/(:num)'] = 'Companies/Companies_controller/ajax_delete/$1';


//************************************** ATM BANKS ROUTES
//**************************************

$route['atm-page'] = 'Atm/Atm_controller';

$route['showlist-atm'] = 'Atm/Atm_controller/ajax_list';

$route['edit-atm/(:num)'] = 'Atm/Atm_controller/ajax_edit/$1';

$route['add-atm/(:num)'] = 'Atm/Atm_controller/ajax_add/$1';

$route['update-atm/(:num)'] = 'Atm/Atm_controller/ajax_update/$1';

$route['delete-atm/(:num)'] = 'Atm/Atm_controller/ajax_delete/$1';


//************************************** CLIENTS ROUTES
//**************************************

$route['clients-page'] = 'Clients/Clients_controller';

$route['showlist-clients'] = 'Clients/Clients_controller/ajax_list';

$route['edit-client/(:num)'] = 'Clients/Clients_controller/ajax_edit/$1';

$route['add-client/(:num)'] = 'Clients/Clients_controller/ajax_add/$1';

$route['update-client/(:num)'] = 'Clients/Clients_controller/ajax_update/$1';

$route['delete-client/(:num)'] = 'Clients/Clients_controller/ajax_delete/$1';


//************************************** CAPITAL ROUTES
//**************************************

$route['capital-page'] = 'Capital/Capital_controller';

$route['showlist-capital'] = 'Capital/Capital_controller/ajax_list';

$route['edit-capital/(:num)'] = 'Capital/Capital_controller/ajax_edit/$1';

$route['add-capital/(:num)'] = 'Capital/Capital_controller/ajax_add/$1';

$route['update-capital/(:num)'] = 'Capital/Capital_controller/ajax_update/$1';

$route['delete-capital/(:num)'] = 'Capital/Capital_controller/ajax_delete/$1';


//************************************** SCHEDULE ROUTES
//**************************************

$route['schedules-page'] = 'Schedules/Schedules_controller';

$route['showlist-schedules'] = 'Schedules/Schedules_controller/ajax_list';

$route['edit-schedule/(:num)'] = 'Schedules/Schedules_controller/ajax_edit/$1';

$route['add-schedule/(:num)'] = 'Schedules/Schedules_controller/ajax_add/$1';

$route['update-schedule/(:num)'] = 'Schedules/Schedules_controller/ajax_update/$1';

$route['delete-schedule/(:num)'] = 'Schedules/Schedules_controller/ajax_delete/$1';


//************************************** PROFILES ROUTES
//**************************************

$route['profiles-page/(:num)'] = 'Profiles/Profiles_controller/index/$1';

// $route['profiles-page/edit-cis-page/(:num)'] = 'profiles/profiles_controller/edit_cis_view/$1';

// $route['showlist-cis'] = 'cis/cis_controller/ajax_list';

// $route['edit-cis/(:num)'] = 'cis/cis_controller/ajax_edit/$1';

// $route['add-cis/(:num)'] = 'cis/cis_controller/ajax_add/$1';

// $route['update-cis/(:num)'] = 'cis/cis_controller/ajax_update/$1';

// $route['delete-cis/(:num)'] = 'cis/cis_controller/ajax_delete/$1';


//************************************** TRANSACTIONS ROUTES
//**************************************

$route['profiles-page/transactions-page/(:num)/(:num)'] = '../Transactions/Transactions_controller/index/$1/$2';

$route['profiles-page/showlist-transactions/(:num)'] = '../Transactions/Transactions_controller/ajax_list/$1';

$route['profiles-page/edit-transaction/(:num)'] = '../Transactions/Transactions_controller/ajax_edit/$1';

$route['profiles-page/add-transaction/(:num)'] = '../Transactions/Transactions_controller/ajax_add/$1';

$route['profiles-page/update-transaction/(:num)'] = '../Transactions/Transactions_controller/ajax_update/$1';

$route['profiles-page/delete-transaction/(:num)'] = '../Transactions/Transactions_controller/ajax_delete/$1';


//************************************** NOTIFICATIONS ROUTES
//**************************************

$route['notifications-page/notifications-monthly-page'] = 'Notifications/Notifications_controller/index/monthly';

$route['notifications-page/notifications-quarterly-page'] = 'Notifications/Notifications_controller/index/quarterly';

$route['notifications-page/notifications-deworming-page'] = 'Notifications/Notifications_controller/index/deworming';

$route['notifications-page/notifications-severe-page'] = 'Notifications/Notifications_controller/index/severe';





//************************************** LOGS ROUTES
//**************************************

$route['logs-page'] = 'Logs/Logs_controller';

$route['showlist-cis'] = 'Logs/Logs_controller/ajax_list';



//************************************** STATISTICS ROUTES
//**************************************


$route['statistics-page'] = 'Statistics/Statistics_controller/index';



//************************************** REPORTS (TCPDF) ROUTES
//**************************************

// cis report

$route['reports-page'] = 'reports/reports_controller';

$route['cis-report-active-male'] = 'pdf_reports/pdf_cis_report_controller/index/Male';

$route['cis-report-active-female'] = 'pdf_reports/pdf_cis_report_controller/index/Female';

$route['cis-report-graduated-male'] = 'pdf_reports/pdf_grad_report_controller/index/Male';

$route['cis-report-graduated-female'] = 'pdf_reports/pdf_grad_report_controller/index/Female';

// monthly checkup report

$route['monthly-report-male/(:num)/(:num)'] = 'pdf_reports/pdf_monthly_report_controller/index/Male/$1/$2';

$route['monthly-report-female/(:num)/(:num)'] = 'pdf_reports/pdf_monthly_report_controller/index/Female/$1/$2';

// child profile report

$route['child-report/(:num)'] = 'pdf_reports/pdf_child_report_controller/index/$1';



//************************************** HVI ROUTES
//**************************************

$route['profiles-page/dec-tree-page/(:num)'] = 'dec_tree/dec_tree_controller/index/$1';



//************************************** USERS
//**************************************

$route['users-page'] = 'Users/Users_controller/index';

$route['showlist-users'] = 'Users/Users_controller/ajax_list';

$route['edit-user/(:num)'] = 'Users/Users_controller/ajax_edit/$1';

$route['add-user/(:num)'] = 'Users/Users_controller/ajax_add/$1';

$route['update-user/(:num)'] = 'Users/Users_controller/ajax_update/$1';

$route['edit-priveleges/(:num)'] = 'Users/Users_controller/ajax_edit/$1';

$route['update-priveleges/(:num)'] = 'Users/Users_controller/ajax_priveleges_update/$1';

$route['delete-user/(:num)'] = 'Users/Users_controller/ajax_delete/$1';




//************************************** REPORT
//**************************************
			//** SALES **//
// $route['report/sales-report'] = 'sales_report/sales_report_controller';

// $route['report/sales-report/print-report/(:any)/(:any)'] = 'sales_report/sales_report_controller/ajax_set_report/$1/$2';


			//** INVENTORY **//
// $route['report/inventory-report'] = 'inventory_report/inventory_report_controller';

// $route['report/inventory-report/print-report'] = 'inventory_report/inventory_report_controller/ajax_set_report';

// $route['report/inventory-report/print-report-damaged'] = 'inventory_report/inventory_report_controller/ajax_set_report_damaged';

// $route['report/inventory-report/print-report-borrow'] = 'inventory_report/inventory_report_controller/ajax_set_report_borrow';

// data = [{
//     y: percent_active,
//     color: colors[0],
//     drilldown: {
//         name: 'Active genders',
//         categories: ['Male', 'Female'],
//         data: [((children_active_male / total_children_count) * 100), ((children_active_female / total_children_count) * 100)],
//         color: colors[0]
//     }
// }, {
//     y: percent_graduated,
//     color: colors[1],
//     drilldown: {
//         name: 'Graduated genders',
//         categories: ['Male', 'Female'],
//         data: [((children_graduated_male / total_children_count) * 100), ((children_graduated_female / total_children_count) * 100)],
//         color: colors[1]
//     }
// }],