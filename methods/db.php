<?php
    require_once '../vendor/autoload.php';
 
    use Ramsey\Uuid\Uuid;

    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","geohorizon");

    // $con = mysqli_connect("sql207.epizy.com","epiz_31642307","zSvY3IqEfP2","epiz_31642307_geohorizon");

    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    function getEvents($condition=''){
        global $con;

        // $q = "SELECT e.s_no,e.event_id,e.event_type,e.icon_class,e.name,e.description,e.date_time,e.venue,e.amount,c.name as organizer,c.mail as organizer_mail,c.phone as organizer_phone,e.organizer_id,e.image_path FROM events e,contacts c where organizer_id=contact_id";
       
        $q = "SELECT e.s_no,e.event_id,e.short,e.event_type,e.icon_class,e.name,e.description,e.date_time,e.venue,e.amount,e.organizer,e.image_path FROM events e order by e.s_no";
        
        if($condition !== '')
            $q = $q." and ".$condition;
        return mysqli_query($con, $q);        
    }

    function getUsers($condition=''){
        global $con;
        
        $q = "SELECT s_no,user_id,user_name,amt_required,amt_paid,status,user_mail,user_phone,user_type,user_time,events FROM accounts";

        if($condition !== '')
            $q = $q." WHERE ".$condition;
        return mysqli_query($con, $q);    
    }

    function getContacts($condition=''){
        global $con;
        $q = "SELECT c.s_no,c.contact_id,c.name,c.mail,c.phone,c.profession,c.department,c.college,c.about,c.profile_path,c.event_id,e.name as event FROM contacts c,events e where c.event_id = e.event_id 
        union SELECT s_no,contact_id,name,mail,phone,profession,department,college,about,profile_path,event_id,'Not Selected' as event FROM contacts where event_id = '--'";

        if($condition !== '')
            $q = $q." and ".$condition;
        return mysqli_query($con, $q);        
    }

    function getCandidates($condition=''){
        global $con;

        if($condition !== ''){
            $condition = " and ".$condition;
        }

        $q = "SELECT c.s_no,c.reg_id,a.user_id,a.user_name,a.user_mail,a.user_phone,e.event_id,e.event_type,e.name,t.payment_id,e.amount as event_amt,e.organizer,t.paid_amt,c.token,c.status,c.remark,c.date_time FROM candidate_list c,accounts a,events e,transactions t WHERE c.user_id = a.user_id and c.event_id = e.event_id and c.payment_id = t.payment_id".$condition;
        
        return mysqli_query($con, $q);     
    }

    // function getTransactions($condition=''){
    //     global $con;

    //     if($condition !== ''){
    //         $condition = " and ".$condition;
    //     }

    //     $q = "SELECT t.s_no,a.user_id,a.user_name,a.user_mail,a.user_phone,e.event_id,e.name,t.payment_id,e.amount as event_amt,t.paid_amt,t.paid_amt_currency,t.txn_id,t.payment_status,t.stripe_checkout_session_id,t.created,t.modified,c.date_time FROM candidate_list c,accounts a,events e,transactions t WHERE c.user_id = a.user_id and c.event_id = e.event_id and c.payment_id = t.payment_id".$condition;
        
    //     return mysqli_query($con, $q);     
    // }

    function getTransactions($condition=''){
        global $con;

        if($condition !== ''){
            $condition = " and ".$condition;
        }

        $q = "SELECT t.s_no,a.user_id,a.user_name,a.user_mail,a.user_phone,e.event_id,e.name,t.payment_id,e.amount as event_amt,t.paid_amt,t.payment_status,t.created,t.modified,c.date_time FROM candidate_list c,accounts a,events e,transactions t WHERE c.user_id = a.user_id and c.event_id = e.event_id and c.payment_id = t.payment_id".$condition;
        
        return mysqli_query($con, $q);     
    }

    function addUser($name,$pass,$mail,$phone){
        $id = Uuid::uuid4()->toString();
        $time = date("Y-m-d H:i:s");
        global $con;
        return mysqli_query($con,"INSERT INTO `accounts` (user_id,user_name,user_pass,user_mail,user_phone,user_time,events) VALUES ('$id','$name','".md5($pass)."', '$mail','$phone','$time','')");
    }

    function addEvent($name,$short,$desc,$datetime,$amount,$venue,$organizer_id,$img_path,$type,$icon){
        $id = Uuid::uuid4()->toString();
        global $con;
        return mysqli_query($con,"INSERT INTO `events` (event_id,name,short,description,date_time,venue,amount,organizer,image_path,icon_class,event_type) VALUES ('$id','$name','$short','$desc', '$datetime','$venue',$amount,'$organizer_id','$img_path','$icon','$type')");
    }

    function addContact($name,$mail,$phone,$profession,$department,$college,$about,$profile,$event_id){
        $id = Uuid::uuid4()->toString();
        global $con;
        return mysqli_query($con,"INSERT INTO `contacts` (contact_id,name,mail,phone,profession,department,college,about,profile_path,event_id) VALUES ('$id','$name','$mail', '$phone','$profession','$department','$college','$about','$profile','$event_id')");
    }

    function addCandidate($user_id,$event_id,$payment_id,$remark='Not Set'){
        $id = Uuid::uuid4()->toString();
        $token = Uuid::uuid4()->toString();
        $datetime = date("Y-m-d H:i:s");
        global $con;
        return mysqli_query($con,"INSERT INTO `candidate_list` (`reg_id`, `user_id`, `event_id`, `payment_id`, `token`, `remark`,`status`, `date_time`) VALUES ('$id', '$user_id', '$event_id', '$payment_id', '$token', '$remark','yellow','$datetime')");
    }
    
    function modifyUser($rows,$condition){
        global $con;
        return mysqli_query($con,"UPDATE `accounts` SET ".$rows." WHERE ".$condition);
    }

    function modifyEvent($rows,$condition){
        global $con;
        return mysqli_query($con,"UPDATE `events` SET ".$rows." WHERE ".$condition);

    }
    
    function modifyContact($rows,$condition){
        global $con;
        return mysqli_query($con,"UPDATE `contacts` SET ".$rows." WHERE ".$condition);
    }

    function modifyCandidate($rows,$condition){
        global $con;
        return mysqli_query($con,"UPDATE `candidate_list` SET ".$rows." WHERE ".$condition);
    }
    function modifyTransaction($rows,$condition){
        global $con;
        return mysqli_query($con,"UPDATE `transactions` SET ".$rows." WHERE ".$condition);
    }

?>