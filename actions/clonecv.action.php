<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

$slug = $_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug' AND user_id =".$fn->Auth()['usr_id'].")");
$resume= $resumes->fetch_assoc();
if(!$resume){
    $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=".$resume['id'].")");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM education WHERE (resume_id=".$resume['id'].")");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM skills WHERE (resume_id=".$resume['id'].")");
$skills = $skills->fetch_all(1);

$ache = $db->query("SELECT * FROM achivements WHERE (resume_id=".$resume['id'].")");
$ache = $ache->fetch_all(1);

$proj = $db->query("SELECT * FROM projects WHERE (resume_id=".$resume['id'].")");
$proj = $proj->fetch_all(1);



$columns = '';
$values = '';
unset($resume['id']);

unset($resume['slug']);
unset($resume['updated_at']);
$resume['resume_title'].=' clone_'.time();

foreach($resume as $index=>$value){
    $value = $db->real_escape_string($value);
    $columns.= $index.',';
    $values .= "'$value',";
}
$authid = $fn->Auth()['usr_id'];

// $full_name = $db->real_escape_string($post['full_name']);
// $email_id = $db->real_escape_string($post['email_id']);
// $password = md5($db->real_escape_string($post['password']));

$columns.='slug,updated_at';
$values.="'".$fn->randomstring()."',".time();




try{
    $query = "INSERT INTO resumes";
    $query.= "($columns) ";
    $query.= "VALUES($values)";



$db->query($query);

$new_resume_id = $db->insert_id;

$columnss= 'created_at, updated_at, user_id';
$valuess= time().",".time().','.$authid;

foreach($exps as $exp){
    foreach($exp as $index=>$value){
        $exp[$index]=$db->real_escape_string($value);
    }
    $query2 = "INSERT INTO experiences(resume_id,position,company,job_desc,started,ended,$columnss) ";
    $query2.= "VALUES ($new_resume_id,'{$exp['position']}','{$exp['company']}','{$exp['job_desc']}','{$exp['started']}','{$exp['ended']}',$valuess)";
   
    $db->query($query2);
}

foreach($edus as $edu){
    foreach($edu as $index=>$value){
        $edu[$index]=$db->real_escape_string($value);
    }
    $query3 = "INSERT INTO education(resume_id,course,institute,started,ended,$columnss) ";
    $query3.= "VALUES ($new_resume_id,'{$edu['course']}','{$edu['institute']}','{$edu['started']}','{$edu['ended']}',$valuess)";
    $db->query($query3);
}

foreach($ache as $ach){
    foreach($ach as $index=>$value){
        $ach[$index]=$db->real_escape_string($value);
  
    }
    $query4 = "INSERT INTO achivements(resume_id,ach_title,ach_desc,organization,$columnss) ";
    $query4.= "VALUES ($new_resume_id,'{$ach['ach_title']}','{$ach['ach_desc']}','{$ach['organization']}',$valuess)";

    $db->query($query4);
}

foreach($proj as $prj){
    foreach($prj as $index=>$value){
        $prj[$index]=$db->real_escape_string($value);
    }
    $query5 = "INSERT INTO projects(resume_id,prj_title,prj_role,prj_desc,$columnss) ";
    $query5.= "VALUES ($new_resume_id,'{$prj['prj_title']}','{$prj['prj_role']}','{$prj['prj_desc']}',$valuess)";
    $db->query($query5);
}


foreach($skills as $skill){
    foreach($skill as $index=>$value){
        $skill[$index]=$db->real_escape_string($value);
    }
    $query4 = "INSERT INTO skills(resume_id,skill,percentage,$columnss) ";
    $query4.= "VALUES ($new_resume_id,'{$skill['skill']}','{$skill['percentage']}',$valuess)";
    $db->query($query4);
}



$fn->setAlert('Clone Created Successfully !!');
$fn->redirect('../myresumes.php');

}catch(Exception $error){
    
    $error->getMessage();
    $fn->setError($error->getMessage());
    $fn->redirect('../myresumes.php');
 }
?>