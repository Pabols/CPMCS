<?php
include 'database.php';

function temperature($rfid,$temperature) {
    global $db;
    $check = $db->query("SELECT * FROM accounts_tbl WHERE rfid = '$rfid'");
    $row = $check->fetch_object();
    $accounts_id = $row->id;
    $query = $db->query("INSERT INTO temperature_tbl (accounts_id,temperature) VALUES ($accounts_id,'$temperature')");
    if($query) {
        header('location: index.php');
    }
}


function add_users($rfid,$firstname,$middlename,$surname,$email,$pwd,$contact,$user_type_id) {
    global $db;
    if(empty($_FILES['files']['name'])) {
        $image = 'default-avatar.png';
    } else {
        $image = $_FILES['files']['name'];
        move_uploaded_file($_FILES['files']['tmp_name'],'assets/profile/'.$_FILES['files']['name']);
    }
    $password = password_hash($pwd,PASSWORD_DEFAULT);
    $check = $db->query("SELECT * FROM accounts_tbl WHERE rfid = '$rfid' AND user_type_id != 4");
    if($check->num_rows > 0) {
        header('location: view-users.php?message='.encrypt_message('RFID serial number already exist.'));
    } else {
        $query = $db->query("INSERT INTO  accounts_tbl (image,rfid,firstname,middlename,surname,email,password,contact,user_type_id) VALUES ('$image','$rfid','$firstname','$middlename','$surname','$email','$password','$contact','$user_type_id')");
        if($query) {
            header('location: view-users.php?message='.encrypt_message('New user has been added.'));
        }
    }
}

function edit_profile($id) {
    global $db;
    $image = $_FILES['files']['name'];
    move_uploaded_file($_FILES['files']['tmp_name'],'assets/profile/'.$_FILES['files']['name']);
    $query = $db->query("UPDATE accounts_tbl SET image = '$image' WHERE id = ".decode($id));
    if($query) {
        header('location: view-users.php?message='.encrypt_message('Profile has been updated.'));
    }
}

function edit_users($id,$rfid,$firstname,$middlename,$surname,$email,$contact,$user_type_id) {
    global $db;
    $query = $db->query("UPDATE accounts_tbl SET rfid = '$rfid', firstname = '$firstname', middlename = '$middlename', surname = '$surname', email = '$email', contact = '$contact', user_type_id = '$user_type_id' WHERE id = ".decode($id));
    if($query) {
        header('location: edit-users.php?id='.$id.'&message='.encrypt_message('Changes has been saved.'));
    }
}

function edit_password($id,$pwd) {
    global $db;
    $password = password_hash($pwd,PASSWORD_DEFAULT);
    $query = $db->query("UPDATE accounts_tbl SET password = '$password' WHERE id = ".decode($id));
    if($query) {
        header('location: edit-password.php?id='.$id.'&message='.encrypt_message('Changes has been saved.'));
    }
}

function secure_login($email,$password) {
    global $db;
    $query = $db->query("SELECT * FROM accounts_tbl WHERE email = '$email' AND user_type_id = 5");
    if($query->num_rows > 0) {
        $row = $query->fetch_object();
        if(password_verify($password,$row->password)) {
            $_SESSION['id'] = $row->id;
            header('location: dashboard.php');
        } else {
            header('location: login.php?message='.encrypt_message('Invalid username or password.'));
        }
    } else {
        header('location: login.php?message='.encrypt_message('Invalid username or password.'));
    }
}


function delete_user($id) {
    global $db;
    $accounts_id = decode($id);
    $query = $db->query("DELETE FROM accounts_tbl WHERE id = $accounts_id");
    if($query) {
        header('location: view-users.php?message='.encrypt_message('User has been deleted.'));
    }
}


function post($data) {
    global $db;
    return $db->real_escape_string(htmlentities($_POST[$data]));
}

function users() {
    global $db;
    return $db->query("SELECT * FROM accounts_tbl WHERE user_type_id != 5");
}

function user_counting($user_type_id) {
    global $db;
    $query = $db->query("SELECT * FROM accounts_tbl WHERE user_type_id = $user_type_id");
    return $query ? $query->num_rows : 0;
}

function get_name($id) {
    global $db;
    $query = $db->query("SELECT * FROM accounts_tbl WHERE id = ".decode($id));
    $row = $query->fetch_object();
    return $row->firstname.' '.$row->surname;

}

function get_color($id) {
    global $db;
    $query = $db->query("SELECT * FROM accounts_tbl WHERE id = ".decode($id));
    $row = $query->fetch_object();
    switch($row->user_type_id) {
        case 1:
            $color = '#2196f3';
        break;
        case 2:
            $color = '#25b372';
        break;
        case 3:
            $color = '#f58646';
        break;
        case 4:
            $color = '#ef5350';
        break;
    }
    return $color;

}

function get_user_information($id) {
    global $db;
    $query = $db->query("SELECT * FROM accounts_tbl WHERE id = ".decode($id));
    if($query->num_rows > 0) {
        return $query->fetch_object();
    } else {
        return false;
    }
}

function encode($data) {
    return base64_encode(urlencode($data));
}

function decode($data) {
    return base64_decode(urldecode($data));
}

function encrypt_message($data) {
    return urlencode(base64_encode($data));
}

function decrypt_message($data) {
    return urldecode(base64_decode($data));
}

function get_user_temperature() {
    global $db;
    return $db->query("SELECT *, COUNT('tt.accounts_id') as total, tt.id as temperature_id FROM accounts_tbl as act INNER JOIN temperature_tbl as tt ON act.id = tt.accounts_id GROUP BY tt.accounts_id");
}

function get_reports() {
    global $db;
    return $db->query("SELECT *, tt.id as temperature_id,tt.date as scanned_date FROM accounts_tbl as act INNER JOIN temperature_tbl as tt ON act.id = tt.accounts_id INNER JOIN user_type_tbl as utt ON act.user_type_id = utt.id ORDER BY tt.id DESC");
}

function get_report_result($from,$to) {
    global $db;
    $date_from = $from.' 00:00:00';
    $date_to = $to.' 23:59:59';
    return $db->query("SELECT *, tt.id as temperature_id,tt.date as scanned_date FROM accounts_tbl as act INNER JOIN temperature_tbl as tt ON act.id = tt.accounts_id WHERE tt.date BETWEEN '$date_from' AND '$date_to' ORDER BY tt.accounts_id ASC ");
}

function get_temperatures($id) {
    global $db;
    return $db->query("SELECT * FROM temperature_tbl WHERE accounts_id = ".decode($id));
}

function get_all_temperatures() {
    global $db;
    return $db->query("SELECT * FROM temperature_tbl");
}

function show_all_user_types() {
    global $db;
    return $db->query("SELECT * FROM user_type_tbl");
}

function do_logout() {
    session_destroy();
    header('location:login.php');
}