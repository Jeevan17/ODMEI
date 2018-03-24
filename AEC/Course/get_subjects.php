<?php include '../../dataConnections.php';
    session_start();
    if(!isset($_SESSION['AEC'])){
        echo "<script language='javascript'>window.location='../index.php';</script>";
    }
    if (array_key_exists('cid', $_POST))
    {
        $cid = $_POST['cid'];
        
        $_SESSION['cid'] = $cid;
        
        $sql = "SELECT * FROM course_yands WHERE CourseID='$cid'";
        $retval = mysqli_query($conn, $sql);
        if(mysqli_num_rows($retval)>0)
        {
            echo "
                <div class='alert alert-dismissible alert-primary'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong>Data Already Exists</strong>
                </div>
                ";
        }
        else
        {
            $sql = "SELECT CourseName FROM courses WHERE CourseID='$cid'";
        $retval = mysqli_query($conn, $sql);
        if(mysqli_num_rows($retval)>0)
        {

            while($row = mysqli_fetch_array($retval))
            {
                $Cname = $row['CourseName'];
            }
            echo "
                <hr>
                <h3><mark>$Cname</mark></h3>
                <br>
                <br>
                <form method='POST' action='course_details.php'>
                    <div class='row'>
                        <div class='col-sm-2 pt-2'>
                            Select Year and Semester:
                        </div>
                        <div class='col-sm-4'>
                            <select class='form-control' name='yands'>
                                <option>1/4 Sem-1</option>
                                <option>1/4 Sem-2</option>
                                <option>2/4 Sem-1</option>
                                <option>2/4 Sem-2</option>
                                <option>3/4 Sem-1</option>
                                <option>3/4 Sem-2</option>
                                <option>4/4 Sem-1</option>
                                <option>4/4 Sem-2</option>
                            </select>
                        </div>
                        <div class='col-sm-2 pt-2'>
                            Select Course Type:
                        </div>
                        <div class='col-sm-4'>
                            <select class='form-control' name='Ctype'>
                                <option>Theory</option>
                                <option>Elective-I</option>
                                <option>Elective-I</option>
                                <option>Elective-III</option>
                                <option>Elective-IV</option>
                                <option>Lab</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='col-sm-2 pt-2'>
                            Select Branch:
                        </div>
                        <div class='col-sm-4'>
                            <select class='form-control' name='Branch'>
                                <option>CSE</option>
                                <option>IT</option>
                                <option>ECE</option>
                                <option>Civil</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <center><input type='submit' value='Insert' class='btn btn-info pl-5 pr-5' name='submit'></center>
                </form>
                <br>
                ";
            }
            else
            {
                echo "
                <div class='alert alert-danger'>
                    <strong>No Data Found</strong>
                </div>";
            }
        }
    }
?>