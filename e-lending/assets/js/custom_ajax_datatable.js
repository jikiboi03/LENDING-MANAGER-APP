var save_method; //for save method string
var table;
var text;
var tableID = $("table").attr('id');

$(document).ready(function() 
{
    if(tableID == "companies-table")
    {
    //datatables
            table = $('#companies-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "showlist-companies",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],
                "scrollX": true
            });
    }
    if(tableID == "atm-table")
    {
    //datatables
            table = $('#atm-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "showlist-atm",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],
                "scrollX": true
            });
    }
    else if(tableID == "clients-table")
    {
    //datatables
            table = $('#clients-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "pageLength": 15,
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "showlist-clients",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -2 ], // 2nd last column
                    "orderable": false, //set not orderable
                },
                {
                      "targets": 6,
                      "className": "text-right",
                },
                {
                      "targets": 7,
                      "className": "text-center",
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var sex = data[10],
                      $node = this.api().row(row).nodes().to$();

                  if (sex == 'Male') 
                  {
                    $node.css('background-color', '#ccb3ff');
                  }
                  else
                  {
                    $node.css('background-color', '#ffb3d9');
                  }

                  var status = data[11],
                      $node = this.api().row(row).nodes().to$();

                  if (status == 'active') 
                  { 
                    if (isOdd(index) == 1) // to have different color when changed color is in sequence
                    {
                      $node.css('background-color', '#b3fffa');
                    }
                    else
                    {
                      $node.css('background-color', '#99ffff');
                    }
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "loans-table")
    {
    //datatables

            // get client_id
            var client_id = $('[name="client_id"]').val();

            table = $('#loans-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "ordering": false,
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../Profiles/Profiles_controller/ajax_list/" + client_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                      "targets": 1,
                      "className": "text-right",
                },
                {
                      "targets": 2,
                      "className": "text-right",
                },
                {
                      "targets": 3,
                      "className": "text-right",
                },
                {
                      "targets": 4,
                      "className": "text-center",
                },
                {
                      "targets": 5,
                      "className": "text-center",
                },
                {
                      "targets": 6,
                      "className": "text-center",
                },
                {
                      "targets": 7,
                      "className": "text-center",
                },
                {
                      "targets": 8,
                      "className": "text-right",
                },
                {
                      "targets": 9,
                      "className": "text-right",
                },
                {
                      "targets": 10,
                      "className": "text-right",
                }
                ],

                "rowCallback": function( row, data, index )
                {
                  var status = data[6],
                      $node = this.api().row(row).nodes().to$();

                  if (status == 'New') 
                  {
                    $node.css('background-color', '#99ff99');
                  }
                  else if (status == 'Ongoing') 
                  {
                    $node.css('background-color', '#ccff99');
                  }
                  else
                  {
                    $node.css('background-color', '#cccccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "client-portal-loans-table")
    {
    //datatables

            // get client_id
            var client_id = $('[name="client_id"]').val();

            table = $('#client-portal-loans-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "bPaginate": false,
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../Client_portal/Client_portal_controller/ajax_list/" + client_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                      "targets": 2,
                      "visible": false,
                },
                // {
                //       "targets": 3,
                //       "className": "text-right",
                // },
                // {
                //       "targets": 4,
                //       "className": "text-center",
                // },
                // {
                //       "targets": 5,
                //       "className": "text-center",
                // },
                // {
                //       "targets": 6,
                //       "className": "text-center",
                // },
                // {
                //       "targets": 7,
                //       "className": "text-center",
                // },
                // {
                //       "targets": 8,
                //       "className": "text-right",
                // },
                // {
                //       "targets": 9,
                //       "className": "text-right",
                // },
                // {
                //       "targets": 10,
                //       "className": "text-right",
                // }
                ],

                "rowCallback": function( row, data, index )
                {
                  var status = data[2],
                      $node = this.api().row(row).nodes().to$();

                  if (status == 'New') 
                  {
                    $node.css('background-color', '#99ff99');
                  }
                  else if (status == 'Ongoing') 
                  {
                    $node.css('background-color', '#ccff99');
                  }
                  else
                  {
                    $node.css('background-color', '#cccccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "transactions-table")
    {
    //datatables

            // get loan_id
            var loan_id = $('[name="loan_id"]').val();

            table = $('#transactions-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "bPaginate": false,
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../../../Transactions/Transactions_controller/ajax_list/" + loan_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                      "targets": 3,
                      "className": "text-right",
                },
                {
                      "targets": 4,
                      "className": "text-right",
                },
                {
                      "targets": 5,
                      "className": "text-right",
                },
                {
                      "targets": 7,
                      "className": "text-center",
                }
                ],

                "rowCallback": function( row, data, index ) {
                  var type = data[2],
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (type == 'Trans. Start') {
                     $node.css('background-color', '#99ff99');
                  }
                  else if (type == 'Paid Partial') {
                     $node.css('background-color', '#ccff99');
                  }
                  else if (type == 'Paid Full') {
                     $node.css('background-color', '#cccccc');
                  }
                  else if (type == 'Add Interest') {
                     $node.css('background-color', '#99ffff');
                  }
                  else if (type == 'Add Amount') {
                     $node.css('background-color', '#99cccc');
                  }
                  else if (type == 'Discount Amount') {
                     $node.css('background-color', '#ffcc99');
                  }
                },    

                "scrollX": true 
            });
    }
    else if(tableID == "client-portal-transactions-table")
    {
    //datatables

            // get loan_id
            var loan_id = $('[name="loan_id"]').val();

            table = $('#client-portal-transactions-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
                "bPaginate": false,
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../../../Trans_cp/Trans_cp_controller/ajax_list/" + loan_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                      "targets": 3,
                      "className": "text-right",
                },
                {
                      "targets": 4,
                      "className": "text-right",
                },
                {
                      "targets": 5,
                      "className": "text-right",
                },
                {
                      "targets": 7,
                      "className": "text-center",
                }
                ],

                "rowCallback": function( row, data, index ) {
                  var type = data[2],
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (type == 'Trans. Start') {
                     $node.css('background-color', '#99ff99');
                  }
                  else if (type == 'Paid Partial') {
                     $node.css('background-color', '#ccff99');
                  }
                  else if (type == 'Paid Full') {
                     $node.css('background-color', '#cccccc');
                  }
                  else if (type == 'Add Interest') {
                     $node.css('background-color', '#99ffff');
                  }
                  else if (type == 'Add Amount') {
                     $node.css('background-color', '#99cccc');
                  }
                  else if (type == 'Discount Amount') {
                     $node.css('background-color', '#ffcc99');
                  }
                },    

                "scrollX": true 
            });
    }
    else if(tableID == "capital-table")
    {
    //datatables

            table = $('#capital-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "showlist-capital",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                      "targets": 1,
                      "className": "text-center",
                },
                {
                      "targets": 2,
                      "className": "text-right",
                },
                {
                      "targets": 3,
                      "className": "text-right",
                },
                {
                      "targets": 4,
                      "className": "text-center",
                },
                {
                      "targets": 5,
                      "className": "text-center",
                }
                ],

                "rowCallback": function( row, data, index ) {
                  var amount = parseFloat(data[2]),
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (amount >= 0) {
                      if (isOdd(index) == 1) // to have different color when changed color is in sequence
                      {
                        $node.css('background-color', '#99cccc');
                      }
                      else
                      {
                        $node.css('background-color', '#aad5d5');
                      }
                  }
                  else {
                      if (isOdd(index) == 1) // to have different color when changed color is in sequence
                      {
                        $node.css('background-color', '#ffcc99');
                      }
                      else
                      {
                        $node.css('background-color', '#ffbf80');
                      }
                  }
                },    

                "scrollX": true 
            });
    }
    else if(tableID == "top-clients-list-table")
    {
    //datatables

            table = $('#top-clients-list-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "ordering": false,
                "searching": false,
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "showlist-statistics",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                {
                      "targets": 2,
                      "className": "text-right",
                },
                {
                      "targets": 3,
                      "className": "text-right",
                },
                {
                      "targets": 4,
                      "className": "text-center",
                },
                {
                      "targets": 5,
                      "className": "text-center",
                }
                ],  

                "rowCallback": function( row, data, index ) {
                  var has_balance = parseFloat(data[4]),
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (has_balance != 0) {
                    //  $node.css('background-color', '#ffff66');
                    
                    if (isOdd(index) == 1) // to have different color when changed color is in sequence
                    {
                      $node.css('background-color', '#ffffcc');
                    }
                    else
                    {
                      $node.css('background-color', '#ffff99');
                    }
                  }

                },   

                "scrollX": true 
            });
    }


    else if(tableID == "logs-table")
    {
            var logs_type = $('[name="logs_type"]').val();

            url = 'showlist-logs-' + logs_type;

            table = $('#logs-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": url,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index ) {
                  var log_type = data[1],
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (log_type == 'Add') {
                     $node.css('background-color', '#99ff99');
                  }
                  else if (log_type == 'Update') {
                     $node.css('background-color', '#99ffff');
                  }
                  else if (log_type == 'Delete') {
                     $node.css('background-color', '#ffcc99');
                  }
                  else if (log_type == 'Logout') {
                     $node.css('background-color', '#cccccc');
                  }
                  else if (log_type == 'Report') {
                     $node.css('background-color', '#ccff99');
                  }
                }               
            });           
    }
    
    else if(tableID == "schedules-table")
    {
            table = $('#schedules-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "showlist-schedules",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index ) {
                  var log_type = data[6],
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (log_type == 'Today') {
                     $node.css('background-color', '#99ff99');
                  }      
                  else if (log_type == 'Ended') {
                     $node.css('background-color', '#cccccc');
                  }
                  
                }               
            });           
    }

    else if(tableID == "users-table")
    {
            table = $('#users-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "language": {
                            processing: '<i style="color: gray;" class="fa fa-spinner fa-spin fa-5x fa-fw"></i><span class="sr-only">Loading...</span> '},
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "showlist-users",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index ) {
                  var user_type = data[1], user_id = data[0]
                      $node = this.api().row(row).nodes().to$();

                  // set color to light cyan if admin  
                  if (user_type == 'Administrator') {
                     $node.css('background-color', '#66ffff');
                  }
                  // set color to light gold if super admin
                  if (user_id == 'U101') {
                     $node.css('background-color', '#ffff66');
                  }
                },
                "scrollX": true              
            });           
    }
         
});

function isOdd(num) { return num % 2;}

// ------------------------------------------------- 

// reset file path everytime modal_form_view is closed - for image upload
$('#modal_form_view').on('hidden.bs.modal', function(){
    $("#userfile").val("");
});

// ============================================================ DASHBOARD BACKUP DB SECTION =======================================


function back_up_db()
{
    $.confirm({
        title: 'Confirm Backup',
        theme: 'modern',
        type: 'blue',
        icon: 'fa fa-database',
        content: 'Are you sure to backup the database?',
        buttons: {
            confirm: function () {
                window.location.href='database-backup.php';
            },
            cancel: function () {
                // close
            },
        }
    });
}


// ================================================================== VIEW IMAGE SECTION ==========================================


function readURL(input,image) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $(image).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$("#userfile1").change(function(){
    readURL(this,'#image1');
});

$("#userfile2").change(function(){
    readURL(this,'#image2');
});

$("#userfile3").change(function(){
    readURL(this,'#image3');
});

// if attendance_date selection box is changed
// $("#attendance_date").change(function(){
//     window.location.href='../attendance-page/' + $('[name="attendance_date"]').val();
// });


// ================================================== VIEW SECTION =================================================================



function view_profile(client_id)
{
     window.location.href='profiles-page/' + client_id;
}

function view_loan(client_id, loan_id)
{
     window.location.href='transactions-page/' + client_id + '/' + loan_id;
}

function view_cp_loan(client_id, loan_id)
{
     window.location.href='transactions-client-page/' + client_id + '/' + loan_id;
}

function edit_privileges(id) // for customer table
{
    save_method = 'update-privileges';
    $('#form')[0].reset(); // reset form on modals
    $('#form_privileges')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "Users/Users_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="user_id"]').val(data.user_id);
            $('[name="administrator"]').val(data.administrator).prop('selected', true);
            $('[name="current_administrator"]').val(data.administrator);
            
            //$('[name="report"]').val(data.report).prop('selected', true);

            $('#modal_form_privileges').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Privileges'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function view_edit_user(id) // for customer table
{
    save_method = 'update-user';
    $('#form')[0].reset(); // reset form on modals
    $('#form_privileges')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "Users/Users_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="user_id"]').val(data.user_id);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="repassword"]').val(data.password);
            $('[name="current_username"]').val(data.username);
            $('[name="lastname"]').val(data.lastname);
            $('[name="firstname"]').val(data.firstname);
            $('[name="current_name"]').val(data.lastname + data.firstname);
            $('[name="contact"]').val(data.contact);
            $('[name="email"]').val(data.email);
            $('[name="address"]').val(data.address);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


// ================================================== ADD SECTION ======================================================================

function add_company() // ---> calling for the Add Modal form
{
    save_method = 'add-company';
    text = 'Add Company';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_atm() // ---> calling for the Add Modal form
{
    save_method = 'add-atm';
    text = 'Add ATM Bank';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_client() // ---> calling for the Add Modal form
{
    save_method = 'add-client';
    text = 'Add Client';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_loan() // ---> calling for the Add Modal form
{
    save_method = 'add-loan';
    text = 'Add New Loan';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_payment() // ---> calling for the Add Modal form
{
    save_method = 'add-payment';
    text = 'Add Payment';
    
    $('#form_add_payment')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_add_payment').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}


function add_interest() // ---> calling for the Add Modal form
{
    save_method = 'add-interest';
    text = 'Add Interest';
    
    $('#form_add_interest')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_add_interest').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}


function adjust_loan() // ---> calling for the Add Modal form
{
    save_method = 'adjust-loan';
    text = 'Adjust Loan';
    
    $('#form_adjust_loan')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_adjust_loan').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function adjust_capital() // ---> calling for the Add Modal form
{
    save_method = 'adjust-capital';
    text = 'Adjust Capital';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_schedule() // ---> calling for the Add Modal form
{
    save_method = 'add-schedule';
    text = 'Add Appointment Schedule Record';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}


function add_user()
{
    save_method = 'add-user';

    $('#form')[0].reset(); // reset form on modals
    $('#form_privileges')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
}


// ================================================ EDIT SECTION =========================================================================



function edit_company(id)
{
    save_method = 'update-company';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "Companies/Companies_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="comp_id"]').val(data.comp_id);
            $('[name="name"]').val(data.name);
            $('[name="address"]').val(data.address);
            $('[name="remarks"]').val(data.remarks);
            $('[name="current_name"]').val(data.name);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Company'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_atm(id)
{
    save_method = 'update-atm';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "Atm/Atm_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="atm_id"]').val(data.atm_id);
            $('[name="name"]').val(data.name);
            $('[name="branch"]').val(data.branch);
            $('[name="remarks"]').val(data.remarks);
            $('[name="current_name"]').val(data.name);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit ATM Bank'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_client(id)
{
    save_method = 'update-client';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "Clients/Clients_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="client_id"]').val(data.client_id);
            $('[name="lname"]').val(data.lname);
            $('[name="fname"]').val(data.fname);

            $('[name="sex"]').val(data.sex).prop('selected', true);
            $('[name="contact"]').val(data.contact);
            $('[name="address"]').val(data.address);
            
            $('[name="comp_id"]').val(data.comp_id).prop('selected', true);
            $('[name="job"]').val(data.job);
            $('[name="salary"]').val(data.salary);

            $('[name="atm_id"]').val(data.atm_id).prop('selected', true);
            $('[name="atm_type"]').val(data.atm_type).prop('selected', true);
            $('[name="pin"]').val(data.pin)

            $('[name="remarks"]').val(data.remarks);
            $('[name="current_name"]').val(data.lname + data.fname);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Client'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_loan(id)
{
    save_method = 'update-loan';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "../Profiles/Profiles_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="loan_id"]').val(data.loan_id);
            
            $('[name="amount"]').val(data.amount);
            $('[name="interest"]').val(data.interest);
            $('[name="total"]').val(data.total);

            $('[name="date_start"]').val(data.date_start);
            $('[name="date_end"]').val(data.date_end);
            
            $('[name="remarks"]').val(data.remarks);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Loan'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_loan_date_remarks(id)
{
    save_method = 'update-loan-date-remarks';
    $('#form_edit_date_remarks')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "../Profiles/Profiles_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="loan_id"]').val(data.loan_id);

            $('[name="date_start"]').val(data.date_start);
            $('[name="remarks"]').val(data.remarks);
            
            $('#modal_form_edit_date_remarks').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Loan Date/Remarks'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_trans_date_remarks(id)
{
    save_method = 'update-trans-date-remarks';
    $('#form_edit_date_remarks')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "../../../Transactions/Transactions_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="trans_id"]').val(data.trans_id);
            $('[name="total"]').val(data.total);
            $('[name="date"]').val(data.date);
            $('[name="remarks"]').val(data.remarks);

            $('#modal_form_edit_date_remarks').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Transaction Date/Remarks'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_capital_date_remarks(id)
{
    save_method = 'update-capital-date-remarks';
    $('#form_edit_date_remarks')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "Capital/Capital_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="capital_id"]').val(data.capital_id);

            $('[name="date"]').val(data.date);
            $('[name="remarks"]').val(data.remarks);

            $('#modal_form_edit_date_remarks').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Capital Adjustment Date/Remarks'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_schedule(id)
{
    save_method = 'update-schedule';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "Schedules/Schedules_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="sched_id"]').val(data.sched_id);
            $('[name="title"]').val(data.title);
            $('[name="date"]').val(data.date);
            $('[name="time"]').val(data.time);
            $('[name="remarks"]').val(data.remarks);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Appointment Schedule'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// function edit_cis_view(child_id)
// {
//     window.location.href='edit-cis-page/' + child_id;
// }



function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

// =================================================== SAVE SECTION =====================================================================

// updating cis record
// function save_cis()
// {
//     // resetting errors in form validations
//     $('.form-group').removeClass('has-error'); // clear error class
//     $('.help-block').empty(); // clear error string

//     $('#btnSave').text('Saving...'); //change button text
//     $('#btnSave').attr('disabled',true); //set button disable 
    
//     $form = '#form';
//     url = "../../cis/cis_controller/ajax_update";

//     // ajax adding data to database
//     $.ajax({
//         url : url,
//         type: "POST",
//         data: $($form).serialize(),
//         dataType: "JSON",
//         success: function(data)
//         {
 
//             if(data.status) //if success close modal and reload ajax table
//             {
//                 var log_type = 'Update';

//                 var details = 'child CIS record updated C' 
//                 + $('[name="child_id"]').val() + ': '
//                 + $('[name="firstname"]').val() + ' ' 
//                 + $('[name="middlename"]').val() + ' ' 
//                 + $('[name="lastname"]').val(); 

//                 set_system_log_two(log_type, details);

//                 window.location.href='../../profiles-page/' + $('[name="child_id"]').val();
//             }
//             else
//             {
//                 for (var i = 0; i < data.inputerror.length; i++) 
//                 {
//                     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
//                     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
//                 }
//             }
//             $('#btnSave').text('Save'); //change button text
//             $('#btnSave').attr('disabled',false); //set button enable 
 
 
//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error adding / update data');
//             $('#btnSave').text('Save'); //change button text
//             $('#btnSave').attr('disabled',false); //set button enable 
 
//         }
//     });
// }

function cancel_trans()
{
    window.location.href='../../../profiles-page/' + $('[name="client_id"]').val();
}

function cancel_cp_trans()
{
    window.location.href='../../../client-portal-page/' + $('[name="client_id"]').val();
}

function save()
{
    // resetting errors in form validations
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    // initialize form for both add and update as default 
    $form = '#form';

    if(save_method == 'add-client') 
    {
        url = "Clients/Clients_controller/ajax_add";
    }
    else if(save_method == 'update-client') 
    {
        url = "Clients/Clients_controller/ajax_update";
    }
    else if(save_method == 'add-company') 
    {
        url = "Companies/Companies_controller/ajax_add";
    }
    else if(save_method == 'update-company') 
    {
        url = "Companies/Companies_controller/ajax_update";
    }
    else if(save_method == 'add-atm') 
    {
        url = "Atm/Atm_controller/ajax_add";
    }
    else if(save_method == 'update-atm') 
    {
        url = "Atm/Atm_controller/ajax_update";
    }
    else if(save_method == 'add-loan') 
    {
        url = "../Profiles/Profiles_controller/ajax_add";
    }
    else if(save_method == 'update-loan') 
    {
        url = "../Profiles/Profiles_controller/ajax_update";
    }
    else if(save_method == 'update-loan-date-remarks') 
    {
        $form = '#form_edit_date_remarks';
        url = "../Profiles/Profiles_controller/ajax_update_date_remarks";
    }
    else if(save_method == 'add-payment') 
    {
        $form = '#form_add_payment';
        url = "../../../Transactions/Transactions_controller/ajax_paid";
    }
    else if(save_method == 'add-interest') 
    {
        $form = '#form_add_interest';
        url = "../../../Transactions/Transactions_controller/ajax_add_interest";
    }
    else if(save_method == 'adjust-loan') 
    {
        $form = '#form_adjust_loan';
        url = "../../../Transactions/Transactions_controller/ajax_adjustment";
    }
    else if(save_method == 'update-trans-date-remarks') 
    {
        $form = '#form_edit_date_remarks';
        url = "../../../Transactions/Transactions_controller/ajax_update";
    }
    else if(save_method == 'adjust-capital') 
    {
        $form = '#form';
        url = "Capital/Capital_controller/ajax_add";
    }
    else if(save_method == 'update-capital-date-remarks') 
    {
        $form = '#form_edit_date_remarks';
        url = "Capital/Capital_controller/ajax_update";
    }
    
    else if(save_method == 'add-schedule') 
    {
        url = "Schedules/Schedules_controller/ajax_add";
    }
    else if(save_method == 'update-schedule') 
    {
        url = "Schedules/Schedules_controller/ajax_update";
    }

    else if(save_method == 'add-user') 
    {
        url = "Users/Users_controller/ajax_add";
    }
    else if(save_method == 'update-user') 
    {
        url = "Users/Users_controller/ajax_update";
    }
    else if(save_method == 'update-privileges') 
    {
        // change form for add stock to form_add_stock
        $form = '#form_privileges';
        url = "Users/Users_controller/ajax_privileges_update";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $($form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $('#modal_form_edit').modal('hide');
                
                $('#modal_form_privileges').modal('hide');

                $('#modal_form_add_payment').modal('hide');
                $('#modal_form_add_interest').modal('hide');
                $('#modal_form_adjust_loan').modal('hide');
                $('#modal_form_edit_date_remarks').modal('hide');
                
                reload_table();


                // set logs -------------------------------------------------------------------

                var log_type = "";
                var details = "";

                if(save_method == 'add-client') 
                {
                    log_type = 'Add';

                    details = 'New client record added: ' + $('[name="lname"]').val() 
                    + ', ' + $('[name="fname"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-client') 
                {
                    log_type = 'Update';

                    details = 'Client updated C' + $('[name="client_id"]').val() 
                    + ': ' + $('[name="lname"]').val() + ', ' + $('[name="fname"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-company')
                {
                    log_type = 'Add';

                    details = 'New company added: ' + $('[name="name"]').val(); 

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-company') 
                {
                    log_type = 'Update';

                    details = 'Company updated J' + $('[name="comp_id"]').val() 
                    + ': ' + $('[name="current_name"]').val() + ' to ' + $('[name="name"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-atm')
                {
                    log_type = 'Add';

                    details = 'New ATM bank added: ' + $('[name="name"]').val(); 

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-atm') 
                {
                    log_type = 'Update';

                    details = 'ATM Bank updated A' + $('[name="atm_id"]').val() 
                    + ': ' + $('[name="current_name"]').val() + ' to ' + $('[name="name"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-payment')
                {
                    log_type = 'Add';

                    details = 'New payment added to Loan ID: L' + $('[name="loan_id"]').val() + ' of Client: ' 
                    + $('[name="client_name"]').val(); 

                    set_system_log_three(log_type, details);

                    // refresh transaction page
                    window.location.href='../' +  $('[name="client_id"]').val() + '/' + $('[name="loan_id"]').val();
                }
                else if(save_method == 'add-interest')
                {
                    log_type = 'Add';

                    details = 'New interest added to Loan ID: L' + $('[name="loan_id"]').val() + ' of Client: ' 
                    + $('[name="client_name"]').val(); 

                    set_system_log_three(log_type, details);

                    // refresh transaction page
                    window.location.href='../' +  $('[name="client_id"]').val() + '/' + $('[name="loan_id"]').val();
                }
                else if(save_method == 'adjust-loan')
                {
                    log_type = 'Update';

                    details = 'New loan adjustment to Loan ID: L' + $('[name="loan_id"]').val() + ' of Client: ' 
                    + $('[name="client_name"]').val(); 

                    set_system_log_three(log_type, details);

                    // refresh transaction page
                    window.location.href='../' +  $('[name="client_id"]').val() + '/' + $('[name="loan_id"]').val();
                }
                else if(save_method == 'update-trans-date-remarks') 
                {
                    log_type = 'Update';

                    details = 'Transaction updated T' + $('[name="trans_id"]').val() + ' of Client: ' 
                    + $('[name="client_name"]').val(); 

                    set_system_log_three(log_type, details);
                }
                else if(save_method == 'adjust-capital')
                {
                    log_type = 'Update';

                    details = 'New capital adjustment'; 

                    set_system_log(log_type, details);

                    // refresh capital page
                    window.location.href='';
                }
                else if(save_method == 'update-capital-date-remarks') 
                {
                    log_type = 'Update';

                    details = 'Capital adjustment updated to: P' + $('[name="capital_id"]').val(); 

                    set_system_log(log_type, details);
                }

                else if(save_method == 'add-schedule')
                {
                    log_type = 'Add';

                    details = 'New schedule added: ' + $('[name="title"]').val(); 

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-schedule') 
                {
                    log_type = 'Update';

                    details = 'Schedule updated S' + $('[name="sched_id"]').val() 
                    + ': ' + $('[name="title"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-loan') 
                {
                    log_type = 'Add';

                    details = 'New loan added to: C' + $('[name="client_id"]').val() + ': ' + $('[name="client_name"]').val();

                    set_system_log_one(log_type, details);
                }
                else if(save_method == 'update-loan') 
                {
                    log_type = 'Update';

                    details = 'Loan updated to: C' + $('[name="client_id"]').val() + ': ' + $('[name="client_name"]').val();

                    set_system_log_one(log_type, details);
                }
                else if(save_method == 'update-loan-date-remarks') 
                {
                    log_type = 'Update';

                    details = 'Loan updated to: C' + $('[name="client_id"]').val() + ': ' + $('[name="client_name"]').val();

                    set_system_log_one(log_type, details);
                }
                

                else if(save_method == 'add-user') 
                {
                    log_type = 'Add';

                    details = 'New user added: ' + $('[name="username"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-user') 
                {
                    log_type = 'Update';

                    details = 'User record updated U' + $('[name="user_id"]').val() + ': ' 
                    + $('[name="username"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-privileges') 
                {
                    log_type = 'Update';

                    details = 'User record updated U' + $('[name="user_id"]').val();

                    set_system_log(log_type, details);
                }
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}




// ================================================= LOGS SECTION ===========================================================================




function set_system_log(log_type, details)
{
    // sanitize illegal string characters
    var cleanString = details.replace(/[|&;$%@"<>()+,]/g, "");

    $.ajax({
        url : "Logs/Logs_controller/ajax_add/" + log_type + '/' + cleanString,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// back url by one (../)
function set_system_log_one(log_type, details)
{
    // sanitize illegal string characters
    var cleanString = details.replace(/[|&;$%@"<>()+,]/g, "");

    $.ajax({
        url : "../Logs/Logs_controller/ajax_add/" + log_type + '/' + cleanString,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// back url by two (../../)
function set_system_log_two(log_type, details)
{
    // sanitize illegal string characters
    var cleanString = details.replace(/[|&;$%@"<>()+,]/g, "");

    $.ajax({
        url : "../../Logs/Logs_controller/ajax_add/" + log_type + '/' + cleanString,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}   

// back url by three (../../../)
function set_system_log_three(log_type, details)
{
    // sanitize illegal string characters
    var cleanString = details.replace(/[|&;$%@"<>()+,]/g, "");

    $.ajax({
        url : "../../../Logs/Logs_controller/ajax_add/" + log_type + '/' + cleanString,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
} 





// ================================================= DELETE SECTION =========================================================================



function delete_client(id, name)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {
                $.ajax({
                    url : "Clients/Clients_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'Client deleted C' + id; 

                        set_system_log(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            },
            cancel: function () {
                // close
            },
        }
    });
}
function delete_company(id, name)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {
                // ajax delete data to database
                $.ajax({
                    url : "Companies/Companies_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'Company deleted J' + id 
                        + ': ' + name; 

                        set_system_log(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            },
            cancel: function () {
                // close
            },
        }
    });
}
function delete_atm(id, name)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {
                // ajax delete data to database
                $.ajax({
                    url : "Atm/Atm_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'ATM Bank deleted A' + id 
                        + ': ' + name; 

                        set_system_log(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            },
            cancel: function () {
                // close
            },
        }
    });
}
function delete_loan(id)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {
                // ajax delete data to database
                $.ajax({
                    url : "../Profiles/Profiles_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'Loan deleted: L' + id + ' from client: ' + $('[name="client_name"]').val();

                        set_system_log_one(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    } 

                });
            },
            cancel: function () {
                // close
            },
        }
    });
}

function delete_schedule(id)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {
                // ajax delete data to database
                $.ajax({
                    url : "Schedules/Schedules_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'Appointment schedule deleted';

                        set_system_log(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            },
            cancel: function () {
                // close
            },
        }
    });
}

function delete_user(id)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {
                // ajax delete data to database
                $.ajax({
                    url : "Users/Users_controller/ajax_delete/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'User record deleted'; 

                        set_system_log(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        $('#modal_form_privileges').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Unable to delete one remaining administrator account');
                    }
                });
            },
            cancel: function () {
                // close
            },
        }
    });
}

function delete_interest(id, interest_amt)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {

                var loan_id = $('[name="loan_id"]').val();
                // ajax delete data to database
                $.ajax({
                    url : "../../../Transactions/Transactions_controller/ajax_delete/"+id+"/"+interest_amt+"/"+loan_id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'Loan interest deleted from client: ' + $('[name="client_name"]').val();

                        set_system_log_three(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();

                        // refresh transaction page
                        window.location.href='../' +  $('[name="client_id"]').val() + '/' + loan_id;
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    } 

                });
            },
            cancel: function () {
                // close
            },
        }
    });
}

function delete_payment(id, amount)
{
    $.confirm({
        title: 'Confirm Delete',
        theme: 'modern',
        type: 'red',
        icon: 'fa fa-warning',
        content: 'Are you sure to delete this data?',
        buttons: {
            confirm: function () {

                var loan_id = $('[name="loan_id"]').val();
                // ajax delete data to database
                $.ajax({
                    url : "../../../Transactions/Transactions_controller/ajax_delete_pay/"+id+"/"+amount+"/"+loan_id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var log_type = 'Delete';

                        var details = 'Loan interest deleted from client: ' + $('[name="client_name"]').val();

                        set_system_log_three(log_type, details);

                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();

                        // refresh transaction page
                        window.location.href='../' +  $('[name="client_id"]').val() + '/' + loan_id;
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    } 

                });
            },
            cancel: function () {
                // close
            },
        }
    });
}


// set typeahead value
// function set_typeahead_item(item)
// {
//     $('#srch-term').typeahead('val', item);
// }


// function firstFunction(receipt_window)
// {
//   var d = $.Deferred();
//   // some very time consuming asynchronous code...
//   setTimeout(function() 
//   {
//     // open new window
//     receipt_window.location.href = 'receipt';

//     d.resolve();
//   }, 1000);
//   return d.promise();
// }

// function secondFunction()
// {
//   var d = $.Deferred();
//   setTimeout(function() {
    
//     location.reload();
    
//     d.resolve();
//   }, 1000);
//   return d.promise();
// }

// ========================================================= LOAN FORM KEY LISTENER ===================================================

// generate total amount
$("#amount").change(function()
{
   $('[name="percentage"]').val(0).prop('selected', true);

   var amount = parseFloat($('[name="amount"]').val());
   var interest = parseFloat($('[name="interest"]').val());
    
   if ($('[name="amount"]').val() == '') 
   {
      amount = 0;  
   }
   if ($('[name="interest"]').val() == '') 
   {
      interest = 0;  
   }

   var total = (amount + interest).toFixed(2);

   $('[name="total"]').val(total); 
});

// generate total amount
$("#interest").change(function()
{
   $('[name="percentage"]').val(0).prop('selected', true);

   update_total_value();
});

// generate interest amount by percentage
$("#percentage").change(function()
{
   var amount = parseFloat($('[name="amount"]').val());
   var percentage = parseFloat($('[name="percentage"]').val());

   if (percentage != 0)
   {
      var interest = (amount * percentage).toFixed(2);

      $('[name="interest"]').val(interest);

      update_total_value();
   }
});

function update_total_value()
{
   var amount = parseFloat($('[name="amount"]').val());
   var interest = parseFloat($('[name="interest"]').val());

   if ($('[name="interest"]').val() == '') 
   {
      interest = 0;  
   }

   var total = (amount + interest).toFixed(2);

   $('[name="total"]').val(total);
}

// ========================================================= TRANSACTION FORM KEY LISTENER ===================================================

// generate total amount
$("#amount_payment").change(function()
{
   var amount = parseFloat($('[name="amount"]').val());
   var total_balance = parseFloat($('[name="total_balance"]').val());
    
   if ($('[name="amount"]').val() == '') 
   {
      amount = 0;  
   }

   var total = (total_balance - amount).toFixed(2);

   $('[name="total"]').val(total); 
});

// generate total amount
$("#interest_amount").change(function()
{
   $('[name="percentage"]').val(0).prop('selected', true);

   update_total_value_trans();
});

// generate interest amount by percentage (transactions page)
$("#percentage_trans").change(function()
{
   var total_balance = parseFloat($('[name="total_balance"]').val());
   var percentage = parseFloat($('[name="percentage"]').val());

   if (percentage != 0)
   {
      var interest = (total_balance * percentage).toFixed(2);

      $('[name="interest"]').val(interest);

      update_total_value_trans();
   }
});

// generate total amount
$("#adjustment_amount").change(function()
{
   var adjustment_amount = parseFloat($('[name="adjustment_amount"]').val());
   var total_balance = parseFloat($('[name="total_balance"]').val());
    
   if ($('[name="adjustment_amount"]').val() == '') 
   {
      adjustment_amount = 0;  
   }

   var total = (total_balance + adjustment_amount).toFixed(2);

   $('[name="total"]').val(total); 
});

function update_total_value_trans()
{
   var interest = parseFloat($('[name="interest"]').val());
   var total_balance = parseFloat($('[name="total_balance"]').val());
    
   if ($('[name="interest"]').val() == '') 
   {
      interest = 0;  
   }

   var total = (total_balance + interest).toFixed(2);

   $('[name="total"]').val(total);
}

// ========================================================= CAPITAL FORM KEY LISTENER ===================================================

// generate total amount
$("#amount_capital").change(function()
{
   var amount = parseFloat($('[name="amount"]').val());
   var total_capital = parseFloat($('[name="total_capital"]').val());
    
   if ($('[name="amount"]').val() == '') 
   {
      amount = 0;  
   }

   var total = (total_capital + amount).toFixed(2);

   $('[name="total"]').val(total); 
});


// ========================================================= FIX CALCULATION BUTTON ===================================================

function fix_bal_paid_calculation()
{
   var loan_id = $('[name="loan_id"]').val();

   $.ajax({
       url : "../../../Profiles/Profiles_controller/ajax_update_bal_paid/" + loan_id,
       type: "POST",
       dataType: "JSON",
       success: function(data)
       {
          location.reload();
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
          alert('Error get data from ajax');
       }
   });
}


// ========================================================= REPORTS SECTION ==========================================================

// enable / disable generate CIS reports button
$("#report_type").change(function()
{
   var report_type = $('[name="report_type"]').val();

   if (report_type == "null")
   {
       document.getElementById("generate_report").disabled = true;
   }
   else
   {
       document.getElementById("generate_report").disabled = false;
   } 
});

// enable / disable generate Monthly reports button
$("#report_type_monthly").change(function()
{
   var report_type_monthly = $('[name="report_type_monthly"]').val();
   var month_selection = $('[name="month_selection"]').val();
   var year_selection = $('[name="year_selection"]').val();

   if (report_type_monthly == "null" || month_selection == "null" || year_selection == "null")
   {
       document.getElementById("generate_report_monthly").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_monthly").disabled = false;
   } 
});

// enable / disable generate CIS reports button
$("#report_type_child").change(function()
{
   var report_type_child = $('[name="report_type_child"]').val();

   if (report_type_child == "null")
   {
       document.getElementById("generate_report_child").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_child").disabled = false;
   } 
});

// enable / disable generate Monthly reports button
$("#month_selection").change(function()
{
   var report_type_monthly = $('[name="report_type_monthly"]').val();
   var month_selection = $('[name="month_selection"]').val();
   var year_selection = $('[name="year_selection"]').val();

   if (report_type_monthly == "null" || month_selection == "null" || year_selection == "null")
   {
       document.getElementById("generate_report_monthly").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_monthly").disabled = false;
   }
});

// enable / disable generate Monthly reports button
$("#year_selection").change(function()
{
   var report_type_monthly = $('[name="report_type_monthly"]').val();
   var month_selection = $('[name="month_selection"]').val();
   var year_selection = $('[name="year_selection"]').val();

   if (report_type_monthly == "null" || month_selection == "null" || year_selection == "null")
   {
       document.getElementById("generate_report_monthly").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_monthly").disabled = false;
   }
});

// set / generate report based on selected type - CIS
function set_report()
{

    // fetch report type value
    var report_type = $('[name="report_type"]').val();

    // setting report logs
    var log_type = 'Report';

    if (report_type == "cis-active-male")
    {
        var details = 'CIS Active - Male Report generated'; 
        window.open("cis-report-active-male");
    }
    else if (report_type == "cis-active-female")
    {
        var details = 'CIS Active - Female Report generated'; 
        window.open("cis-report-active-female");
    }
    else if (report_type == "cis-graduated-male")
    {
        var details = 'CIS Graduated - Male Report generated'; 
        window.open("cis-report-graduated-male");
    }
    else if (report_type == "cis-graduated-female")
    {
        var details = 'CIS Graduated - Female Report generated';
        window.open("cis-report-graduated-female");
    }
    else
    {
        // window.open("inventory-report/print-report-borrow");   
    }

    set_system_log(log_type, details);
}

// set / generate report based on selected type - Monthly Checkup
function set_report_monthly()
{

    // fetch report type value
    var report_type_monthly = $('[name="report_type_monthly"]').val();
    var month_selection = $('[name="month_selection"]').val();
    var year_selection = $('[name="year_selection"]').val();

    // setting report logs
    var log_type = 'Report';

    if (report_type_monthly == "monthly-male")
    {
        var details = 'Monthly Monitoring - Male Report generated'; 
        window.open("monthly-report-male/" + month_selection + "/" + year_selection);
    }
    else if (report_type_monthly == "monthly-female")
    {
        var details = 'Monthly Monitoring - Female Report generated'; 
        window.open("monthly-report-female/" + month_selection + "/" + year_selection);
    }

    set_system_log(log_type, details);
}

// set / generate report based on selected type - Monthly Checkup
function set_report_child()
{

    // fetch report type value
    var report_type_child = $('[name="report_type_child"]').val();

    // setting report logs
    var log_type = 'Report';

    var details = 'Child Profile Report generated: C' + report_type_child; 
    window.open("child-report/" + report_type_child);

    set_system_log(log_type, details);
}


// ========================================== STATISTICS CHARTS =====================================================



// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-interests")) 
{
    // fetch registrations data
    var current_year = $('[name="current_year"]').val();

    var jan = parseFloat($('[name="jan"]').val());
    var feb = parseFloat($('[name="feb"]').val());
    var mar = parseFloat($('[name="mar"]').val());
    var apr = parseFloat($('[name="apr"]').val());

    var may = parseFloat($('[name="may"]').val());
    var jun = parseFloat($('[name="jun"]').val());
    var jul = parseFloat($('[name="jul"]').val());
    var aug = parseFloat($('[name="aug"]').val());

    var sep = parseFloat($('[name="sep"]').val());
    var oct = parseFloat($('[name="oct"]').val());
    var nov = parseFloat($('[name="nov"]').val());
    var dec = parseFloat($('[name="dec"]').val());

    var year_total = $('[name="year_total"]').val();

        Highcharts.chart('container-interests', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Total Loan Interests / Net Profit for Year ( ' + current_year + ' ): ₱ ' + year_total
        },
        subtitle: {
            text: 'January to December ' + current_year
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Interest Values in Php Amount'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                            return Highcharts.numberFormat(this.y,2);
                        }    
                },
                enableMouseTracking: true,
                tooltip: {
                    pointFormat: '<b style="color:#66cccc;">●</b> {series.name}: <b>₱ {point.y}.00</b>'
                }
            }
        },
        series: [{
            name: 'Monthly Total Interest',
            data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec]
        }]
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-interests-prev")) 
{
    // fetch registrations data
    var prev_year = $('[name="prev_year"]').val();

    var prev_jan = parseFloat($('[name="prev_jan"]').val());
    var prev_feb = parseFloat($('[name="prev_feb"]').val());
    var prev_mar = parseFloat($('[name="prev_mar"]').val());
    var prev_apr = parseFloat($('[name="prev_apr"]').val());

    var prev_may = parseFloat($('[name="prev_may"]').val());
    var prev_jun = parseFloat($('[name="prev_jun"]').val());
    var prev_jul = parseFloat($('[name="prev_jul"]').val());
    var prev_aug = parseFloat($('[name="prev_aug"]').val());

    var prev_sep = parseFloat($('[name="prev_sep"]').val());
    var prev_oct = parseFloat($('[name="prev_oct"]').val());
    var prev_nov = parseFloat($('[name="prev_nov"]').val());
    var prev_dec = parseFloat($('[name="prev_dec"]').val());

    var prev_year_total = $('[name="prev_year_total"]').val();

        Highcharts.chart('container-interests-prev', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Total Loan Interests / Net Profit for Year ( ' + prev_year + ' ): ₱ ' + prev_year_total
        },
        subtitle: {
            text: 'January to December ' + prev_year
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Interest Values in Php Amount'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                            return Highcharts.numberFormat(this.y,2);
                        }    
                },
                enableMouseTracking: true,
                tooltip: {
                    pointFormat: '<b style="color:#66cccc;">●</b> {series.name}: <b>₱ {point.y}.00</b>'
                }
            }
        },
        series: [{
            name: 'Monthly Total Interest',
            data: [prev_jan, prev_feb, prev_mar, prev_apr, prev_may, prev_jun, 
            prev_jul, prev_aug, prev_sep, prev_oct, prev_nov, prev_dec]
        }]
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-interests-prev-prev")) 
{
    // fetch registrations data
    var prev_prev_year = $('[name="prev_prev_year"]').val();

    var prev_prev_jan = parseFloat($('[name="prev_prev_jan"]').val());
    var prev_prev_feb = parseFloat($('[name="prev_prev_feb"]').val());
    var prev_prev_mar = parseFloat($('[name="prev_prev_mar"]').val());
    var prev_prev_apr = parseFloat($('[name="prev_prev_apr"]').val());

    var prev_prev_may = parseFloat($('[name="prev_prev_may"]').val());
    var prev_prev_jun = parseFloat($('[name="prev_prev_jun"]').val());
    var prev_prev_jul = parseFloat($('[name="prev_prev_jul"]').val());
    var prev_prev_aug = parseFloat($('[name="prev_prev_aug"]').val());

    var prev_prev_sep = parseFloat($('[name="prev_prev_sep"]').val());
    var prev_prev_oct = parseFloat($('[name="prev_prev_oct"]').val());
    var prev_prev_nov = parseFloat($('[name="prev_prev_nov"]').val());
    var prev_prev_dec = parseFloat($('[name="prev_prev_dec"]').val());

    var prev_prev_year_total = $('[name="prev_prev_year_total"]').val();

        Highcharts.chart('container-interests-prev-prev', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Total Loan Interests / Net Profit for Year ( ' + prev_prev_year + ' ): ₱ ' + prev_prev_year_total
        },
        subtitle: {
            text: 'January to December ' + prev_prev_year
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Interest Values in Php Amount'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                            return Highcharts.numberFormat(this.y,2);
                        }    
                },
                enableMouseTracking: true,
                tooltip: {
                    pointFormat: '<b style="color:#66cccc;">●</b> {series.name}: <b>₱ {point.y}.00</b>'
                }
            }
        },
        series: [{
            name: 'Monthly Total Interest',
            data: [prev_prev_jan, prev_prev_feb, prev_prev_mar, prev_prev_apr, prev_prev_may, prev_prev_jun, 
            prev_prev_jul, prev_prev_aug, prev_prev_sep, prev_prev_oct, prev_prev_nov, prev_prev_dec]
        }]
    });
}
