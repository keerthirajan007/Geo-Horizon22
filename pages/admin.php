<?php
    include("../actions/auth_session.php");
    
    if($_SESSION["user_type"] != "admin"){
        header("Location: ./sign_out.php");
    }
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGE : Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../_assets/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link href="../_assets/plugins/toastr/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../_assets/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">

    <link rel="stylesheet" href="../_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    
    <link rel="stylesheet" href="../_assets/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="../_assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="../_assets/plugins/bootstrap-icon-picker/css/fontawesome-iconpicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../_assets/css/adminlte.min.css">

    <link rel="stylesheet" href="../_assets/css/scrollbar.css">

    <link rel="stylesheet" href="../_assets/css/dash1.css">
</head>

<body class="hold-transition layout-fixed">

    <!-- layout-navbar-fixed layout-fixed -->
    <div class="wrapper">
        <div>
            <nav id="header" class="main-header navbar navbar-expand">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="menu-button" class="nav-link " data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                    <div id="content-header-left"></div>
                </ul>
                <!-- Messages Dropdown Menu -->
                <ul class="navbar-nav ml-auto">
                    <div id="content-header-right"></div>
                    <li onclick="refresh()" class="nav-item">
                        <a href="#" class="nav-link ">
                            &nbsp<i id="refresh-icon" class="fas fa-sync-alt"></i>
                        </a>
                    </li>
                    <li onclick="setMainContent('register')" class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link ">Register</a>
                    </li>
                    <!-- <li onclick="setMainContent('transactions')" class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link ">Transactions</a>
                    </li> -->
                    <li onclick="setMainContent('users')" class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link ">Users</a>
                    </li>
                    <!-- <li onclick="setMainContent('contact')" class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link ">Contacts</a>
                    </li> -->
                    <li onclick="setMainContent('event-list')" class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link ">Events</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="../actions/sign_out.php" class="nav-link ">Log out</a>
                    </li>

                </ul>
            </nav>
        </div>

        <aside id="sidebar" class="main-sidebar elevation-4 sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../_assets/img/4_logo.png" alt=""
                    class="brand-image img-circle" style="opacity: .8">
                <span class="brand-text font-weight-light">Geo Horizon'22</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <!-- <div id="tab-btn-profile" class="user-panel mt-3 pb-3 mb-3 d-flex"
                    onclick="setMainContentFromSideBar('profile')">
                    <div class="image">
                        <img src="../_assets/img/avatar.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['user_name'] ?></a>
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li id="tab-btn-all" class="nav-item">
                            <a href="#" class="nav-link  active" onclick="setMainContentFromSideBar('event-list')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Events
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul id="event-list-sidebar" class="nav nav-treeview">
                             
                            </ul>
                        </li>
                        <!-- <li id="tab-btn-contact" class="nav-item" onclick="setMainContentFromSideBar('contact')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-book"></i>
                                <p>
                                    Contacts
                                </p>
                            </a>
                        </li> -->
                        <!-- <li id="tab-btn-contact" class="nav-item" onclick="setMainContentFromSideBar('transactions')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Transactions
                                </p>
                            </a>
                        </li> -->
                        <li id="tab-btn-contact" class="nav-item" onclick="setMainContentFromSideBar('users')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li id="tab-btn-contact" class="nav-item" onclick="setMainContentFromSideBar('register')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p>
                                    Register
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./sign_out.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Log out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div id="content" class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <span class="float-right text-muted" id="last-refreshed"></span>
                    <h1 id="content-title" class="m-0" style="text-align: center;">
                    </h1>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row w-100" id="contact-container" hidden>
                        <div id="contact-container-left" class="col-md-6"></div>
                        <div id="contact-container-right" class="col-md-6"></div>
                    </div>
                    <div class="row w-100" id="event-list-container" hidden>
                        <div id="event-list-container-left" class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        </div>
                        <div id="event-list-container-mid" class="col-sm-6 col-md-6 col-lg-4 col-xl-4"></div>
                        <div id="event-list-container-right" class=" col-sm-6 col-md-6 col-lg-4 col-xl-4"></div>
                    </div>
                    <div class="row w-100" id="event-container" hidden>
                        <div class="col-12">
                            <div class="card" id="event-metadata">
                                <div class="card-header">
                                    <h3 class="card-title"  id="event-metadata-title"></h3>
                                </div>
                                <div class="card-body"  id="event-metadata-body">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Registered Candidates</h3>
                                    <span class="float-right">
                                        <a class="btn btn-flat btn-default dropdown-toggle" href="#" role="button" id="candidate-message-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Message
                                        </a>
                                        <div id="candidate-message-kind" class="dropdown-menu" aria-labelledby="candidate-message-dropdown">
                                            <a id="candidate-message-all" class="dropdown-item" href="#">To All Candidates</a>
                                            <a id="candidate-message-specific" class="dropdown-item" href="#">To Specific Candidates</a>
                                        </div>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <table id="candidate-list-table" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>S.No</th>
                                        <th>Candidate Id</th>
                                        <th>Candidate Name</th>
                                        <th>Mail Id</th>
                                        <th>Phone</th>
                                        <!-- <th>Amount Paid</th> -->
                                        <!-- <th>Currency</th> -->
                                        <!-- <th>Payment Id</th> -->
                                        <th>Key Code</th>
                                        <th>Status</th>
                                        <th>Remark</th>
                                    </tr>
                                    </thead>
                                    <tbody id="candidate-list-table-body">
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100" id="contact-form-container" hidden>
                        <form id="contact-form" method="post" onsubmit="submitContactForm();return false"
                            enctype="multipart/form-data">
                            <input hidden readonly type="text" class="form-control" id="contact-id" name="contact-id">
                            <input hidden readonly type="text" class="form-control" id="contact-path"
                                name="contact-path">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="contact-name">Full Name</label>
                                        <div class="input-group">
                                            <input required type="text" class="form-control" id="contact-name"
                                                placeholder="Enter full name" name="contact-name">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-email">Email ID</label>
                                        <div class="input-group">
                                            <input required type="email" class="form-control" id="contact-email"
                                                placeholder="example@gmail.com" name="contact-email">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-phone">Phone No</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend" style="max-width:35%;">
                                                <select class="form-control"
                                                    style="max-width:100%;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                                                    name="countryCode" id="countryCode">
                                                    <option data-countryCode="DZ" value="213">Algeria </option>
                                                    <option data-countryCode="AD" value="376">Andorra </option>
                                                    <option data-countryCode="AO" value="244">Angola </option>
                                                    <option data-countryCode="AI" value="1264">Anguilla
                                                    </option>
                                                    <option data-countryCode="AG" value="1268">Antigua &amp;
                                                        Barbuda
                                                    </option>
                                                    <option data-countryCode="AR" value="54">Argentina </option>
                                                    <option data-countryCode="AM" value="374">Armenia </option>
                                                    <option data-countryCode="AW" value="297">Aruba </option>
                                                    <option data-countryCode="AU" value="61">Australia </option>
                                                    <option data-countryCode="AT" value="43">Austria </option>
                                                    <option data-countryCode="AZ" value="994">Azerbaijan
                                                    </option>
                                                    <option data-countryCode="BS" value="1242">Bahamas </option>
                                                    <option data-countryCode="BH" value="973">Bahrain </option>
                                                    <option data-countryCode="BD" value="880">Bangladesh
                                                    </option>
                                                    <option data-countryCode="BB" value="1246">Barbados
                                                    </option>
                                                    <option data-countryCode="BY" value="375">Belarus </option>
                                                    <option data-countryCode="BE" value="32">Belgium </option>
                                                    <option data-countryCode="BZ" value="501">Belize </option>
                                                    <option data-countryCode="BJ" value="229">Benin </option>
                                                    <option data-countryCode="BM" value="1441">Bermuda </option>
                                                    <option data-countryCode="BT" value="975">Bhutan </option>
                                                    <option data-countryCode="BO" value="591">Bolivia </option>
                                                    <option data-countryCode="BA" value="387">Bosnia Herzegovina
                                                    </option>
                                                    <option data-countryCode="BW" value="267">Botswana </option>
                                                    <option data-countryCode="BR" value="55">Brazil </option>
                                                    <option data-countryCode="BN" value="673">Brunei </option>
                                                    <option data-countryCode="BG" value="359">Bulgaria </option>
                                                    <option data-countryCode="BF" value="226">Burkina Faso
                                                    </option>
                                                    <option data-countryCode="BI" value="257">Burundi </option>
                                                    <option data-countryCode="KH" value="855">Cambodia </option>
                                                    <option data-countryCode="CM" value="237">Cameroon </option>
                                                    <option data-countryCode="CA" value="1">Canada </option>
                                                    <option data-countryCode="CV" value="238">Cape Verde Islands
                                                    </option>
                                                    <option data-countryCode="KY" value="1345">Cayman Islands
                                                    </option>
                                                    <option data-countryCode="CF" value="236">Central African
                                                        Republic
                                                    </option>
                                                    <option data-countryCode="CL" value="56">Chile </option>
                                                    <option data-countryCode="CN" value="86">China </option>
                                                    <option data-countryCode="CO" value="57">Colombia </option>
                                                    <option data-countryCode="KM" value="269">Comoros </option>
                                                    <option data-countryCode="CG" value="242">Congo </option>
                                                    <option data-countryCode="CK" value="682">Cook Islands
                                                    </option>
                                                    <option data-countryCode="CR" value="506">Costa Rica
                                                    </option>
                                                    <option data-countryCode="HR" value="385">Croatia </option>
                                                    <option data-countryCode="CU" value="53">Cuba </option>
                                                    <option data-countryCode="CY" value="90392">Cyprus North
                                                    </option>
                                                    <option data-countryCode="CY" value="357">Cyprus South
                                                    </option>
                                                    <option data-countryCode="CZ" value="42">Czech Republic
                                                    </option>
                                                    <option data-countryCode="DK" value="45">Denmark </option>
                                                    <option data-countryCode="DJ" value="253">Djibouti </option>
                                                    <option data-countryCode="DM" value="1809">Dominica
                                                    </option>
                                                    <option data-countryCode="DO" value="1809">Dominican
                                                        Republic
                                                    </option>
                                                    <option data-countryCode="EC" value="593">Ecuador </option>
                                                    <option data-countryCode="EG" value="20">Egypt </option>
                                                    <option data-countryCode="SV" value="503">El Salvador
                                                    </option>
                                                    <option data-countryCode="GQ" value="240">Equatorial Guinea
                                                    </option>
                                                    <option data-countryCode="ER" value="291">Eritrea </option>
                                                    <option data-countryCode="EE" value="372">Estonia </option>
                                                    <option data-countryCode="ET" value="251">Ethiopia </option>
                                                    <option data-countryCode="FK" value="500">Falkland Islands
                                                    </option>
                                                    <option data-countryCode="FO" value="298">Faroe Islands
                                                    </option>
                                                    <option data-countryCode="FJ" value="679">Fiji </option>
                                                    <option data-countryCode="FI" value="358">Finland </option>
                                                    <option data-countryCode="FR" value="33">France </option>
                                                    <option data-countryCode="GF" value="594">French Guiana
                                                    </option>
                                                    <option data-countryCode="PF" value="689">French Polynesia
                                                    </option>
                                                    <option data-countryCode="GA" value="241">Gabon </option>
                                                    <option data-countryCode="GM" value="220">Gambia </option>
                                                    <option data-countryCode="GE" value="7880">Georgia </option>
                                                    <option data-countryCode="DE" value="49">Germany </option>
                                                    <option data-countryCode="GH" value="233">Ghana </option>
                                                    <option data-countryCode="GI" value="350">Gibraltar
                                                    </option>
                                                    <option data-countryCode="GR" value="30">Greece </option>
                                                    <option data-countryCode="GL" value="299">Greenland
                                                    </option>
                                                    <option data-countryCode="GD" value="1473">Grenada </option>
                                                    <option data-countryCode="GP" value="590">Guadeloupe
                                                    </option>
                                                    <option data-countryCode="GU" value="671">Guam </option>
                                                    <option data-countryCode="GT" value="502">Guatemala
                                                    </option>
                                                    <option data-countryCode="GN" value="224">Guinea </option>
                                                    <option data-countryCode="GW" value="245">Guinea - Bissau
                                                    </option>
                                                    <option data-countryCode="GY" value="592">Guyana </option>
                                                    <option data-countryCode="HT" value="509">Haiti </option>
                                                    <option data-countryCode="HN" value="504">Honduras </option>
                                                    <option data-countryCode="HK" value="852">Hong Kong
                                                    </option>
                                                    <option data-countryCode="HU" value="36">Hungary </option>
                                                    <option data-countryCode="IS" value="354">Iceland </option>
                                                    <option selected data-countryCode="IN" value="91">India
                                                    </option>
                                                    <option data-countryCode="ID" value="62">Indonesia </option>
                                                    <option data-countryCode="IR" value="98">Iran </option>
                                                    <option data-countryCode="IQ" value="964">Iraq </option>
                                                    <option data-countryCode="IE" value="353">Ireland </option>
                                                    <option data-countryCode="IL" value="972">Israel </option>
                                                    <option data-countryCode="IT" value="39">Italy </option>
                                                    <option data-countryCode="JM" value="1876">Jamaica </option>
                                                    <option data-countryCode="JP" value="81">Japan </option>
                                                    <option data-countryCode="JO" value="962">Jordan </option>
                                                    <option data-countryCode="KZ" value="7">Kazakhstan </option>
                                                    <option data-countryCode="KE" value="254">Kenya </option>
                                                    <option data-countryCode="KI" value="686">Kiribati </option>
                                                    <option data-countryCode="KP" value="850">Korea North
                                                    </option>
                                                    <option data-countryCode="KR" value="82">Korea South
                                                    </option>
                                                    <option data-countryCode="KW" value="965">Kuwait </option>
                                                    <option data-countryCode="KG" value="996">Kyrgyzstan
                                                    </option>
                                                    <option data-countryCode="LA" value="856">Laos </option>
                                                    <option data-countryCode="LV" value="371">Latvia </option>
                                                    <option data-countryCode="LB" value="961">Lebanon </option>
                                                    <option data-countryCode="LS" value="266">Lesotho </option>
                                                    <option data-countryCode="LR" value="231">Liberia </option>
                                                    <option data-countryCode="LY" value="218">Libya </option>
                                                    <option data-countryCode="LI" value="417">Liechtenstein
                                                    </option>
                                                    <option data-countryCode="LT" value="370">Lithuania
                                                    </option>
                                                    <option data-countryCode="LU" value="352">Luxembourg
                                                    </option>
                                                    <option data-countryCode="MO" value="853">Macao </option>
                                                    <option data-countryCode="MK" value="389">Macedonia
                                                    </option>
                                                    <option data-countryCode="MG" value="261">Madagascar
                                                    </option>
                                                    <option data-countryCode="MW" value="265">Malawi </option>
                                                    <option data-countryCode="MY" value="60">Malaysia </option>
                                                    <option data-countryCode="MV" value="960">Maldives </option>
                                                    <option data-countryCode="ML" value="223">Mali </option>
                                                    <option data-countryCode="MT" value="356">Malta </option>
                                                    <option data-countryCode="MH" value="692">Marshall Islands
                                                    </option>
                                                    <option data-countryCode="MQ" value="596">Martinique
                                                    </option>
                                                    <option data-countryCode="MR" value="222">Mauritania
                                                    </option>
                                                    <option data-countryCode="YT" value="269">Mayotte </option>
                                                    <option data-countryCode="MX" value="52">Mexico </option>
                                                    <option data-countryCode="FM" value="691">Micronesia
                                                    </option>
                                                    <option data-countryCode="MD" value="373">Moldova </option>
                                                    <option data-countryCode="MC" value="377">Monaco </option>
                                                    <option data-countryCode="MN" value="976">Mongolia </option>
                                                    <option data-countryCode="MS" value="1664">Montserrat
                                                    </option>
                                                    <option data-countryCode="MA" value="212">Morocco </option>
                                                    <option data-countryCode="MZ" value="258">Mozambique
                                                    </option>
                                                    <option data-countryCode="MN" value="95">Myanmar </option>
                                                    <option data-countryCode="NA" value="264">Namibia </option>
                                                    <option data-countryCode="NR" value="674">Nauru </option>
                                                    <option data-countryCode="NP" value="977">Nepal </option>
                                                    <option data-countryCode="NL" value="31">Netherlands
                                                    </option>
                                                    <option data-countryCode="NC" value="687">New Caledonia
                                                    </option>
                                                    <option data-countryCode="NZ" value="64">New Zealand
                                                    </option>
                                                    <option data-countryCode="NI" value="505">Nicaragua
                                                    </option>
                                                    <option data-countryCode="NE" value="227">Niger </option>
                                                    <option data-countryCode="NG" value="234">Nigeria </option>
                                                    <option data-countryCode="NU" value="683">Niue </option>
                                                    <option data-countryCode="NF" value="672">Norfolk Islands
                                                    </option>
                                                    <option data-countryCode="NP" value="670">Northern Marianas
                                                    </option>
                                                    <option data-countryCode="NO" value="47">Norway </option>
                                                    <option data-countryCode="OM" value="968">Oman </option>
                                                    <option data-countryCode="PW" value="680">Palau </option>
                                                    <option data-countryCode="PA" value="507">Panama </option>
                                                    <option data-countryCode="PG" value="675">Papua New Guinea
                                                    </option>
                                                    <option data-countryCode="PY" value="595">Paraguay </option>
                                                    <option data-countryCode="PE" value="51">Peru </option>
                                                    <option data-countryCode="PH" value="63">Philippines
                                                    </option>
                                                    <option data-countryCode="PL" value="48">Poland </option>
                                                    <option data-countryCode="PT" value="351">Portugal </option>
                                                    <option data-countryCode="PR" value="1787">Puerto Rico
                                                    </option>
                                                    <option data-countryCode="QA" value="974">Qatar </option>
                                                    <option data-countryCode="RE" value="262">Reunion </option>
                                                    <option data-countryCode="RO" value="40">Romania </option>
                                                    <option data-countryCode="RU" value="7">Russia </option>
                                                    <option data-countryCode="RW" value="250">Rwanda </option>
                                                    <option data-countryCode="SM" value="378">San Marino
                                                    </option>
                                                    <option data-countryCode="ST" value="239">Sao Tome &amp;
                                                        Principe
                                                    </option>
                                                    <option data-countryCode="SA" value="966">Saudi Arabia
                                                    </option>
                                                    <option data-countryCode="SN" value="221">Senegal </option>
                                                    <option data-countryCode="CS" value="381">Serbia </option>
                                                    <option data-countryCode="SC" value="248">Seychelles
                                                    </option>
                                                    <option data-countryCode="SL" value="232">Sierra Leone
                                                    </option>
                                                    <option data-countryCode="SG" value="65">Singapore </option>
                                                    <option data-countryCode="SK" value="421">Slovak Republic
                                                    </option>
                                                    <option data-countryCode="SI" value="386">Slovenia </option>
                                                    <option data-countryCode="SB" value="677">Solomon Islands
                                                    </option>
                                                    <option data-countryCode="SO" value="252">Somalia </option>
                                                    <option data-countryCode="ZA" value="27">South Africa
                                                    </option>
                                                    <option data-countryCode="ES" value="34">Spain </option>
                                                    <option data-countryCode="LK" value="94">Sri Lanka </option>
                                                    <option data-countryCode="SH" value="290">St. Helena
                                                    </option>
                                                    <option data-countryCode="KN" value="1869">St. Kitts
                                                    </option>
                                                    <option data-countryCode="SC" value="1758">St. Lucia
                                                    </option>
                                                    <option data-countryCode="SD" value="249">Sudan </option>
                                                    <option data-countryCode="SR" value="597">Suriname </option>
                                                    <option data-countryCode="SZ" value="268">Swaziland
                                                    </option>
                                                    <option data-countryCode="SE" value="46">Sweden </option>
                                                    <option data-countryCode="CH" value="41">Switzerland
                                                    </option>
                                                    <option data-countryCode="SI" value="963">Syria </option>
                                                    <option data-countryCode="TW" value="886">Taiwan </option>
                                                    <option data-countryCode="TJ" value="7">Tajikstan </option>
                                                    <option data-countryCode="TH" value="66">Thailand </option>
                                                    <option data-countryCode="TG" value="228">Togo </option>
                                                    <option data-countryCode="TO" value="676">Tonga </option>
                                                    <option data-countryCode="TT" value="1868">Trinidad &amp;
                                                        Tobago
                                                    </option>
                                                    <option data-countryCode="TN" value="216">Tunisia </option>
                                                    <option data-countryCode="TR" value="90">Turkey </option>
                                                    <option data-countryCode="TM" value="7">Turkmenistan
                                                    </option>
                                                    <option data-countryCode="TM" value="993">Turkmenistan
                                                    </option>
                                                    <option data-countryCode="TC" value="1649">Turks &amp;
                                                        Caicos
                                                        Islands
                                                    </option>
                                                    <option data-countryCode="TV" value="688">Tuvalu </option>
                                                    <option data-countryCode="UG" value="256">Uganda </option>
                                                    <option data-countryCode="GB" value="44">UK </option>
                                                    <option data-countryCode="UA" value="380">Ukraine </option>
                                                    <option data-countryCode="AE" value="971">United Arab
                                                        Emirates
                                                    </option>
                                                    <option data-countryCode="UY" value="598">Uruguay </option>
                                                    <option data-countryCode="US" value="1">USA </option>
                                                    <option data-countryCode="UZ" value="7">Uzbekistan </option>
                                                    <option data-countryCode="VU" value="678">Vanuatu </option>
                                                    <option data-countryCode="VA" value="379">Vatican City
                                                    </option>
                                                    <option data-countryCode="VE" value="58">Venezuela </option>
                                                    <option data-countryCode="VN" value="84">Vietnam </option>
                                                    <option data-countryCode="VG" value="84">Virgin Islands -
                                                        British
                                                    </option>
                                                    <option data-countryCode="VI" value="84">Virgin Islands - US
                                                    </option>
                                                    <option data-countryCode="WF" value="681">Wallis &amp;
                                                        Futuna
                                                    </option>
                                                    <option data-countryCode="YE" value="969">Yemen </option>
                                                    <option data-countryCode="YE" value="967">Yemen </option>
                                                    <option data-countryCode="ZM" value="260">Zambia </option>
                                                    <option data-countryCode="ZW" value="263">Zimbabwe </option>
                                                </select>
                                            </div>
                                            <input required type="text" class="form-control" placeholder="1234567890"
                                                id="contact-phone" name="contact-phone"
                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6  col-md-6">
                                    <div class="form-group">
                                        <label for="contact-profession">Profession</label>
                                        <div class="input-group">
                                            <input required type="text" class="form-control" id="contact-profession"
                                                placeholder="Enter the profession" name="contact-profession">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-department">Department</label>
                                        <div class="input-group">
                                            <input required type="text" class="form-control" id="contact-department"
                                                placeholder="Department" name="contact-department">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-college">College/Company/Institution</label>
                                        <div class="input-group">
                                            <input required type="text" class="form-control" id="contact-college"
                                                placeholder="Name of College / Company / Institution"
                                                name="contact-college">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="contact-event">
                                            Event (Optional)
                                        </label>
                                        <div class="input-group">
                                            <select class="form-control" id="contact-event"
                                                 name="contact-event">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" id="contact-about-container">
                                        <label for="contact-about">About</label>
                                        <textarea name="contact-about" required type="textarea" class="form-control"
                                            autocapitalize="on" id="contact-about"
                                            placeholder="Role in this GeoHorizon"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact-image">Profile Image</label>
                                <div class="d-flex flex-row p-1" id="profile-image-container">
                                    <input onchange="setFileImage('contactImage')" type="file" accept="image/*"
                                        id="contact-image" name="contact-image" hidden>
                                    <input type="text" id="contact-image-conformation" name="contact-image-conformation"
                                        value="0" hidden>

                                    <image class="m-1 border border-light rounded" id='contactImage'
                                        src="../uploads/contacts/default.png" width="100" />

                                    <span style="width:fit-content;gap:10px" class="d-flex flex-column m-1">
                                        <button onclick="openFileImage('contactImage')" class="btn btn-info">Change
                                            Image</button>
                                        <button hidden id="contact-image-remove" class="btn btn-info"
                                            onclick="removeFileImage('contactImage')">Remove
                                            Image</button>
                                        <button hidden id="contact-image-reset" class="btn btn-info"
                                            onclick="resetFileImage('contactImage')">Reset
                                            Image</button>
                                    </span>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="w-100" id="event-form-container" hidden>
                        <form id="event-form" onsubmit="submitEventForm();return false" method="post"
                            enctype="multipart/form-data">
                            <input hidden readonly type="text" class="form-control" id="event-id" name="event-id">
                            <input hidden readonly type="text" class="form-control" id="event-path" name="event-path">
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="event-name">Event Name</label>
                                    <input required type="text" class="form-control" id="event-name"
                                    placeholder="Enter event name" name="event-name">
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="event-type">Event Type</label>
                                    <select required class="form-control" id="event-type" name="event-type">
                                        <option value="event-technical">Technical Event</option>
                                        <option value="event-non-technical">Non Technical Event</option>
                                        <option value="workshop">Workshop</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="event-description-container">
                                <label for="event-description">Event Description</label>
                                <textarea name="event-description" required type="textarea" class="form-control"
                                    autocapitalize="on" id="event-description"
                                    placeholder="Write a description about the event"></textarea>
                            </div>

                            <div class="form-group" id="event-short-container">
                                <label for="event-short">Short Description</label>
                                <textarea name="event-short" required type="textarea" class="form-control"
                                    autocapitalize="on" id="event-short"
                                    placeholder="Write a short description about the event"></textarea>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="event-venue">Venue</label>
                                    <div class="input-group">
                                        <input name="event-venue" required type="text" class="form-control"
                                            id="event-venue">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label>Date and time</label>
                                    <div class="input-group date" data-target-input="nearest">
                                        <input type="text" id="event-datetime" name="event-datetime"
                                            class="form-control datetimepicker-input" data-target="#event-datetime" />
                                        <div class="input-group-append" data-target="#event-datetime"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-lg-4">
                                    <label for="event-amount">Amount (₹)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₹</span>
                                        </div>
                                        <input name="event-amount" required type="number" class="form-control"
                                            id="event-amount" min="0">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-lg-4">
                                    <label for="event-organizer">Organizer</label>
                                    <textarea type="textarea" maxlength="400" required name="event-organizer" class="form-control" id="event-organizer">
                                    </textarea>
                                </div>

                                <div class="form-group col-md-4 col-lg-4">
                                    <label for="event-icon">Icon</label>
                                    <button data-selected="graduation-cap" type="button" id="event-icon" class="form-control btn btn-default dropdown-toggle iconpicker-component" data-toggle="dropdown">
                                        <i id="event-icon-val" class="fa fa-fw"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu border-0"></div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="event-image">Event Poster</label>
                                <div class="d-flex flex-row p-1" id="profile-image-container">
                                    <input onchange="setFileImage('eventImage')" type="file" accept="image/*"
                                        id="event-image" name="event-image" hidden>

                                    <input type="text" id="event-image-conformation" name="event-image-conformation"
                                        value="0" hidden>

                                    <image class="m-1 border border-light rounded" id='eventImage'
                                        src="../uploads/events/default.png" width="100" />

                                    <span style="width:fit-content;gap:10px" class="d-flex flex-column m-1">
                                        <button onclick="openFileImage('eventImage')" class="btn btn-info">Change
                                            Image</button>
                                        <button hidden id="event-image-remove" class="btn btn-info"
                                            onclick="removeFileImage('eventImage')">Remove
                                            Image</button>
                                        <button hidden id="event-image-reset" class="btn btn-info"
                                            onclick="resetFileImage('eventImage')">Reset
                                            Image</button>
                                    </span>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="row w-100" id="transactions-container" hidden>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Transactions</h3>
                                </div>
                                <div class="card-body">
                                    <table id="transactions-table" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>SI.No</th>
                                        <th>Name</th>
                                        <th>Mail Id</th>
                                        <th>Phone</th>
                                        <th>Event Name</th>
                                        <th>Event Amount</th>
                                        <th>Payment Id</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Status</th>
                                        <!-- <th>Paid Currency</th> -->
                                        <!-- <th>Stripe Session Id</th> -->
                                        <!-- <th>Transaction Id</th> -->
                                        <th>Registered At</th>
                                        <th>Modified At</th>
                                    </tr>
                                    </thead>
                                    <tbody id="transactions-table-body">
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100" id="users-container" hidden>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Users</h3>
                                    <span class="float-right">
                                        <a class="btn btn-flat btn-default dropdown-toggle" href="#" role="button" id="user-message-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Message
                                        </a>
                                        <div id="user-message-kind" class="dropdown-menu" aria-labelledby="user-message-dropdown">
                                            <a id="user-message-all" class="dropdown-item" href="#">To All Users</a>
                                            <a id="user-message-specific" class="dropdown-item" href="#">To Specific Users</a>
                                        </div>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <table id="users-table" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>SI.No</th>
                                        <th>Name</th>
                                        <th>Mail Id</th>
                                        <th>Phone</th>
                                        <th>Created At</th>
                                        <th>Required Amt</th>
                                        <th>Paid Amt</th>
                                        <th>Status</th>
                                        <th>Registered Events</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody id="users-table-body">
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100" id="register-container" hidden>
                        <div class="col-10 col-lg-5 col-md-6 col-sm-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Register Event</h3>
                                </div>
                                <div class="card-body">
                                    <form id="register-form" onsubmit="setRegisterModal();return false" method="post">
                                        <div class="form-group">
                                            <label for="register-name">User Name</label>
                                            <div class="input-group">
                                                <select required type="text" class="form-control" id="register-name" name="register-name">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="register-event">Event Name</label>
                                            <div class="input-group">
                                                <select required type="text" class="form-control" id="register-event" name="register-event">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-info">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <div id="main-loader" class="loading-screen">
            <div class="spinner-border text-primary spin-center" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

    </div>

    <!-- compose window -->
    <div class="col-11 col-lg-8 col-md-9 col-sm-10" style="position: absolute;right: 10px;bottom: 10px;z-index:100">
        <div class="card card-info" id="candidate-mail" style="display:none">
            <div class="card-header">
                <h3 class="card-title"  id="candidate-mail-title">Message</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body"  id="candidate-mail-body" style="max-height:70vh;overflow:auto">
                <div class="input-group mb-3 border-bottom border-width-2" id="candidate-mail-user-container">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-0"><i class="fas fa-user"></i></span>
                    </div>
                    <select id="candidate-mail-user" required type="text" class="form-control">
                    </select>
                </div>
                <div class="input-group mb-3 border-bottom border-width-2" id="candidate-mail-user1-container">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-0"><i class="fas fa-user"></i></span>
                    </div>
                    <select id="candidate-mail-user1" required type="text" class="form-control">
                    </select>
                </div>
                <div class="input-group mb-3">
                    <input id="candidate-mail-subject" required type="text" class="form-control form-control-border border-width-2" placeholder="Subject">
                </div>
                <div class="form-group" id="candidate-mail-text-container">
                    <textarea rows="8" id="candidate-mail-content" name="candidate-mail-text" required type="textarea" class="form-control"
                        autocapitalize="on" id="candidate-mail-text"
                        placeholder="Write a content"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-default btn-flat" data-toggle="modal" data-target="#candidate-message-help-modal">Help</button>
                <button id="candidate-mail-send" class="btn btn-sm btn-info float-right">
                    Send
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="warning-modal" style="z-index:3000">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <p id='warning-modal-content'></p>
              <button type="button" class="btn btn-info btn-flat float-right" data-dismiss="modal">
                  Okay
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->

    <div class="modal fade" id="normal-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header"><h5 class="w-100" id='normal-modal-title'>Header</h5></div>
            <div class="modal-body" id='normal-modal-content' style="max-height:70vh;overflow:auto">
              Hello
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
                    Close
                </button>
                <button id='normal-modal-register' type="button" class="btn btn-primary btn-flat" hidden>
                    Confirm
                </button>
                <button id='normal-modal-save' type="button" class="btn btn-info btn-flat" data-dismiss="modal" hidden>
                    Save changes
                </button>
                <button id='normal-modal-save-alert' type="button" class="btn btn-info btn-flat" data-dismiss="modal" hidden>
                    Save changes With Alert
                </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->

      <div class="modal fade" id="candidate-message-help-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header"><h5>Message Help</h5></div>
            <div class="modal-body" style="max-height:70vh;overflow:auto">
                <div>
                    You can type variable name in message content, when you send the message
                    it will be replaced by its values.For example `Hi ${name}` will be replaced to `Hi User1`.
                    Don't use backslash character( \ ) for any reasons,it will be removed during validation for safety purposes.
                 </div>
                 <br>
                 <div id="msg-help-users">
                    <span>These variable are available for messaging users</span>
                    <div class="row">
                        <dt class="col-sm-4">Variable Name</dt>
                        <dt class="col-sm-8">Variable Value</dt>
                        <dt class="col-sm-4">${name}</dt>
                        <dd class="col-sm-8">User name</dd>
                        <dt class="col-sm-4">${mail}</dt>
                        <dd class="col-sm-8">User mail id</dd>
                        <dt class="col-sm-4">${phone}</dt>
                        <dd class="col-sm-8">User phone number</dd>
                        <dt class="col-sm-4">${time}</dt>
                        <dd class="col-sm-8">Time of User registration</dd>
                    </div>
                </div>
                <br>
                 <div id="msg-help-events">
                     <span>These variable are available for messaging candidates</span>
                    <div class="row">
                        <dt class="col-sm-4">Variable Name</dt>
                        <dt class="col-sm-8">Variable Value</dt>
                        <dt class="col-sm-4">${reg_id}</dt>
                        <dd class="col-sm-8">Candidate id</dd>
                        <dt class="col-sm-4">${name}</dt>
                        <dd class="col-sm-8">Candidate name</dd>
                        <dt class="col-sm-4">${mail}</dt>
                        <dd class="col-sm-8">Candidate mail id</dd>
                        <dt class="col-sm-4">${phone}</dt>
                        <dd class="col-sm-8">Candidate phone number</dd>
                        <dt class="col-sm-4">${time}</dt>
                        <dd class="col-sm-8">Time of candidate registration</dd>
                        <dt class="col-sm-4">${key_code}</dt>
                        <dd class="col-sm-8">Specific key for candidates(Key Code)</dd>
                        <dt class="col-sm-4">${status}</dt>
                        <dd class="col-sm-8">Candidate status</dd>
                        <dt class="col-sm-4">${remark}</dt>
                        <dd class="col-sm-8">Candidate remark</dd>
                        <dt class="col-sm-4">${event_name}</dt>
                        <dd class="col-sm-8">Event Name</dd>
                        <dt class="col-sm-4">${amount}</dt>
                        <dd class="col-sm-8">Required Amount</dd>
                        <dt class="col-sm-4">${paid}</dt>
                        <dd class="col-sm-8">Paid Amount</dd>
                        <!-- <dt class="col-sm-4">${currency}</dt>
                        <dd class="col-sm-8">Paid Currency Region</dd> -->
                        <dt class="col-sm-4">${pay_id}</dt>
                        <dd class="col-sm-8">Payment Id</dd>
                        <!-- <dt class="col-sm-4">${txn_id}</dt>
                        <dd class="col-sm-8">Transaction Id</dd> -->
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
                    close
                </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../_assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../_assets/plugins/moment/moment.min.js"></script>

    <script src="../_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    

    <script src="../_assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- for data tables -->
    <script src="../_assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../_assets/plugins/jszip/jszip.min.js"></script>
    <script src="../_assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../_assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../_assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../_assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../_assets/plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js"></script>
    <script src="../_assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="../_assets/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="../_assets/plugins/select2/js/select2.full.min.js"></script>
    
    <script src="../_assets/plugins/bootstrap-icon-picker/js/fontawesome-iconpicker.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="../_assets/js/adminlte.min.js"></script>

    <script src="../_assets/js/dash1.js"></script>

    <script>
        var fileDom = {
            eventImage: document.getElementById("eventImage"),
            eventImageFile: document.getElementById("event-image"),
            eventImageRemove: document.getElementById("event-image-remove"),
            eventImageReset: document.getElementById("event-image-reset"),
            eventImageConform: document.getElementById("event-image-conformation"),
            contactImage: document.getElementById("contactImage"),
            contactImageFile: document.getElementById("contact-image"),
            contactImageRemove: document.getElementById("contact-image-remove"),
            contactImageReset: document.getElementById("contact-image-reset"),
            contactImageConform: document.getElementById("contact-image-conformation"),
        }
        $('#candidate-mail-content').summernote({
            height:230,
            tabDisable:true,
            dialogsInBody: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline','strikethrough', 'superscript', 'subscript', 'clear']],
                ['font', ['fontname','fontsize','fontsizeunit']],
                ['color', ['forecolor','backcolor']],
                ['insert',['link','picture','hr']],
                ['para', ['style','ul', 'ol', 'paragraph','height']],
                ['misc', ['fullscreen','codeview','undo','redo','help']]
            ],
            styleTags: ['p',{ title: 'Blockquote', tag: 'blockquote', value: 'blockquote' } ,'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            oninit : function() {
                $("[data-event=fullscreen]").click();
            }
        });

        $('.dropdown-toggle').dropdown();

        $('#event-datetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });

        // change to new 
        var setFileImage = (name) => {
            if (fileDom[name + "File"].files && fileDom[name + "File"].files[0]) {
                var imageFile = fileDom[name + "File"].files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    //set the image data as source
                    fileDom[name].src = e.target.result;
                    fileDom[name + "Remove"].hidden = false;
                    fileDom[name + "Reset"].hidden = false;
                    fileDom[name + "Conform"].value = "1";
                }
                reader.readAsDataURL(imageFile);
            }
        }

        // change to default
        var removeFileImage = name => {
            event.stopPropagation();
            event.preventDefault();

            fileDom[name + "File"].value = "";
            fileDom[name + "File"].type = "text";
            fileDom[name + "File"].type = "file";
            fileDom[name + "Remove"].hidden = true;
            fileDom[name + "Reset"].hidden = false;
            fileDom[name + "Conform"].value = "2";
            if (name == "contactImage") {
                fileDom.contactImage.src = "../uploads/contacts/default.png";
            } else if (name == "eventImage") {
                fileDom.eventImage.src = "../uploads/events/default.png";
            }
        }

        // no change/reset
        var resetFileImage = name => {
            event.stopPropagation();
            event.preventDefault();

            fileDom[name + "File"].value = "";
            fileDom[name + "File"].type = "text";
            fileDom[name + "File"].type = "file";
            fileDom[name + "Reset"].hidden = true;
            fileDom[name + "Remove"].hidden = false;
            fileDom[name + "Conform"].value = "0";
            if (name == "contactImage") {
                fileDom.contactImage.src = "../uploads/contacts/" +
                    contactFormDom.path.value;
            } else if (name == "eventImage") {
                fileDom.eventImage.src = "../uploads/events/" +
                    eventFormDom.path.value;
            }
        }

        var openFileImage = name => {
            event.stopPropagation();
            event.preventDefault();

            fileDom[name + "File"].click();
        }
    </script>
</body>

</html>