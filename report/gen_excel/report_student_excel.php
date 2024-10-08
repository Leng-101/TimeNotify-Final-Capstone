<?php
include_once '../../connection.php';
$con = connect();

$outputheader='';

date_default_timezone_set('Asia/Manila');
            $timestamp = time();
            $time = date("h:i:s A", $timestamp);

            $mydate=getdate(date("U"));
            $daterec = "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";

$outputheader.='<table class="table-bordered">
                    <tr> 
                        <th colspan="12">ARELLANO UNIVERSITY ANDRES BONIFACIO CAMPUS</th>
                    </tr>
                    <tr> 
                        <th colspan="12">ANDRES BONIFACIO CAMPUS</th>
                    </tr>
                    <tr> 
                        <th colspan="12">ALL STUDENT RECORDS</th>
                    </tr>
                    <tr> 
                        <th colspan="12"></th>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>DATE GENERATED:</td>
                        <td colspan="3">'.$daterec.'</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>TIME GENERATED:</td>
                        <td colspan="3">'.$time.'</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>GENERATED BY:</td>
                        <td colspan="3">TIME NOTIFY ADMIN</td>
                    </tr>
                </table>';

$output='';

$output .='
        <table class="table" bordered="1">
            <thead>
                <tr class="heading">
                <th scope="col">STUDENT NUMBER</th>
                <th scope="col">NAME</th>
                <th scope="col">PICTURE NAME</th>
                <th scope="col">AGE</th>
                <th scope="col">SEX</th>
                <th scope="col">DEPARTMENT</th>
                <th scope="col">GRADE</th>
                <th scope="col">STRAND</th>
                <th scope="col">COURSE</th>
                <th scope="col">SECTION</th>
                <th scope="col">TEACHER</th>
                <th scope="col">GUARDIAN EMAIL</th>
                </tr>
            </thead>
                <tbody>';
                            $sql="Select * from `students`";
                            $result=mysqli_query($con,$sql);

                            if($result){
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    
                                    $stud_id=$row['stud_id']; 
                                    $studnum=$row['studnum']; 
                                    $lastname=$row['lastname'];
                                    $middlename=$row['middlename'];
                                    $firstname=$row['firstname'];
                                    $picture=$row['picture'];
                                    $age=$row['age'];
                                    $sex=$row['sex'];


                                    $img_src = "../../students/picture/".$picture;
                                    $department=$row['department'];
                                    $grade_year=$row['grade_year'];
                                    $strand=$row['strand'];
                                    $course=$row['course'];
                                    $section=$row['section'];
                                    $teacher_prof=$row['teacher_prof'];
                                    $g_email=$row['g_email'];


                                    $_SESSION['student_id'] = $stud_id; //Session StudID

                                    
                                    $output .='<tr>
                                            <td ><center>'.$studnum.'</center></td>
                                            <td ><center>'.$lastname.', '.$firstname.' '.$middlename.'</center></td>  
                                            <td ><center>'.$picture.'</center></td> 
                                            <td ><center>'.$age.'</center></td>   
                                            <td ><center>'.$sex.'</center></td>   
                                            <td ><center>'.$department.'</center></td>
                                            <td ><center>'.$grade_year.'</center></td>
                                            <td ><center>'.$strand.'</center></td>
                                            <td ><center>'.$course.'</center></td>
                                            <td ><center>'.$section.'</center></td>   
                                            <td ><center>'.$teacher_prof.'</center></td>
                                            <td ><center>'.$g_email.'</center></td>   
                                        </tr>
                                    ';
                                }
                            }
                        $output.='</table>';                                

header("Content-Type: application/xls");
header("Content-Disposition: attachment; Filename = all_student_record.xls ");

echo '<br>';
echo $outputheader;
echo '<br>';
echo $output;


?>