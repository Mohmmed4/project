<?php
class helper
{
    public $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }
    function login($data){
        session_start();
        $name = $data['name'];
        $password = $data['password'];
        $name = mysqli_real_escape_string($this->conn,$name);
        $password = mysqli_real_escape_string($this->conn,$password);

        $sql = "SELECT * FROM admin WHERE full_name ='{$name}'";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            die("THE QUERY IS FAIL" . mysqli_error($this->conn));
        }
        $row = mysqli_fetch_array($result);
        $admin_id = $row    ['id'];
        $admin_name = $row['full_name'];
        $admin_password = $row['password'];
        $_SESSION['admin_name']=$admin_name;


        if (password_verify($password,$admin_password)) {
            header("Location: home_page.php");
        } else {
            header("Location: login.php");

        }



    }
    function register($data){
        $name = $data['name'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $password = $data['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM students WHERE full_name = '{$name}' OR email = '{$email}' OR phone = '{$phone}'";
        $true = $this->conn->query($sql);
        if ($true->num_rows > 0) {
            $row = mysqli_fetch_assoc($true);
            echo "Data already exists";
        } else {

            $sql = "INSERT INTO admin (full_name,email,address,phone,password)";
            $sql .= "VALUE ('$name','$email','$address','$phone','$password')";
            $result = mysqli_query($this->conn, $sql);
            if (!$result) {
                die('query fail' . mysqli_error());
            } else {
                echo "THE NEW RECORD IS SUCCESSFULLY";
            }
            mysqli_close($this->conn);
        }
    }

    function show_student()
    {
        $sql = "SELECT * FROM students  ";
        $result = mysqli_query($this->conn,$sql);
        if ($result) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $student_id = $row['id_s'];
                $full_name = $row['full_name_s'];
                echo "<option value='{$student_id}'>{$student_id}: {$full_name}</option>";

            }
        } else {
            echo "0 results";
        }
    }
    function show_driver(){
        $sql = "SELECT * FROM drivers  ";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $driver_id = $row['id_d'];
                $full_name = $row['full_name_d'];
                echo "<option value='{$driver_id}'>{$driver_id}: {$full_name}</option>";

            }
        } else {
            echo "0 results";
        }
    }
    function show_course(){
        $sql = "SELECT * FROM courses  ";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $id_course = $row['id_c'];
                $full_name = $row['full_name_c'];
                echo "<option value='{$id_course}'>{$id_course}: {$full_name}</option>";

            }
        } else {
            echo "0 results";
        }
    }

    function show_courses(){
        $sql = "SELECT * FROM courses  ";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id_c'];
                $full_name=$row['full_name_c'];
                $Time_start_lecture = $row['Time_start_lecture'];
                $Time_end_lecture = $row['Time_end_lecture'];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$full_name</td>";
                echo "<td>$Time_start_lecture</td>";
                echo "<td>$Time_end_lecture</td>";
                echo "<td><a href='courses.php?delete={$id}'>Delete</a></td>";
                echo "<td><a href='edit_course.php?edit={$id}'>Edit</a></td>";
                echo "<td><a href='students_in_course.php?view={$id}'>students in course</a></td>";
                echo "<tr>";

            }
        } else {
            echo "0 results";
        }
    }
    function insert_course($data){
        $name = $data['name'];
        $time1 = $data['Time_start_lecture'];
        $time2 = $data['Time_end_lecture'];

        $sql = "SELECT * FROM courses WHERE full_name_c = '{$name}' OR Time_start_lecture = '{$time1}' OR Time_end_lecture = '{$time2}'";
        $true = $this->conn->query($sql);
        if ($true->num_rows > 0) {
            $row = mysqli_fetch_assoc($true);
            echo "Data already exists";
        }elseif ($name == "" || empty($name) || $time1 == "" || empty($time1) || $time2 == "" || empty($time2)) {

            echo "enter the data";
        } else {
            $sql = "INSERT INTO courses(full_name_c,Time_start_lecture,Time_end_lecture)";
            $sql .= "VALUE('{$name}','{$time1}','{$time2}')";
            $result = mysqli_query($this->conn, $sql);
            if (!$result) {

                die('the query fail' . mysqli_error($this->conn));
            } else {
                header("Location: courses.php");
                echo "insert the new course " ;
            }

        }


    }
    function delete_course($data){
        $the_id = $data['delete'];;
         $sql ="DELETE FROM courses WHERE id_c ={$the_id} ";
        $result = mysqli_query($this->conn,$sql);


            header("Location: courses.php");

    }
    function edit_course($data){
        $the_id = $data['edit'];
        $sql = "SELECT * FROM courses WHERE id_c = {$the_id}";
        $edit = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($edit);
        $id = $row['id_c'];
        $full_name = $row['full_name_c'];
        $Time_start_lecture = $row['Time_start_lecture'];
        $Time_end_lecture = $row['Time_end_lecture'];
        return $x=[$id,$full_name,$Time_start_lecture,$Time_end_lecture];
    }
    function update_course($data){
        $name = $data['name'];
        $time1 = $data['Time_start_lecture'];
        $time2 = $data['Time_end_lecture'];
        $id = $data['id'];
        if ($name == "" || empty($name) || $time1 == "" || empty($time1) || $time2 == "" || empty($time2)) {

            echo "enter the data";
        } else {
            $sql = "UPDATE courses SET full_name_c = '{$name}', Time_start_lecture = '{$time1}', Time_end_lecture = '{$time2}' WHERE id_c = '{$id}'";
            $update = mysqli_query($this->conn, $sql);

            if (!$update) {

                die('the query fail' . mysqli_error($this->conn));
            } else {
                header("Location: courses.php");
            }

        }
    }

    function show_students(){
        $sql = "SELECT * FROM students  ";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id_s'];
                $full_name = $row['full_name_s'];
                $email = $row['email_s'];
                $address = $row['address_s'];
                $phone = $row['phone_s'];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$full_name</td>";
                echo "<td>$email</td>";
                echo "<td>$address</td>";
                echo "<td>$phone</td>";
                echo "<td><a href='students.php?delete={$id}'>Delete</a></td>";
                echo "<td><a href='edit_student.php?edit={$id}'>Edit</a></td>";
                echo "<td><a href='view_student.php?view={$id}'>View</a></td>";
                echo "<tr>";

            }
        } else {
            echo "0 results";
        }
    }
    function insert_student($data){
        $name = $data['name'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];

        $sql = "SELECT * FROM students WHERE email_s = '{$email}' OR phone_s = '{$phone}'";
        $true = $this->conn->query($sql);
        if ($true->num_rows > 0) {
            $row = mysqli_fetch_assoc($true);
            echo "Data already exists";
        }elseif ($name == "" || empty($name) || $email == "" || empty($email) || $address == "" || empty($address) || $phone == "" || empty($phone)) {

            echo "enter the data";
        } else {
            $sql = "INSERT INTO students(full_name_S,email_s,address_s,phone_s)";
            $sql .= "VALUE('{$name}','{$email}','{$address}','{$phone}')";
            $result = mysqli_query($this->conn, $sql);
            if (!$result) {

                die('the query fail' . mysqli_error($this->conn));
            } else {
                header("Location: students.php");
                echo "insert the new student " . $name;
            }

        }


    }
    function delete_student($data){
        $the_id = $data['delete'];
        $sql ="DELETE FROM students WHERE id_s ={$the_id} ";
        $delete = mysqli_query($this->conn,$sql);
        header("Location: students.php");
    }
    function edit_student($data){
        $the_id = $data['edit'];

        $sql = "SELECT * FROM students WHERE id_s = {$the_id}";
        $edit = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($edit);
        $id = $row['id_s'];
        $full_name = $row['full_name_s'];
        $email = $row['email_s'];
        $address = $row['address_s'];
        $phone = $row['phone_s'];
        return $x=[$id,$full_name,$email,$address,$phone];
    }
    function update_student($data){
        $name = $data['name'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $id=$data['id'];
        if ($name == "" || empty($name) || $email == "" || empty($email) || $address == "" || empty($address) || $phone == "" || empty($phone)) {

            echo "enter the data";
        } else {
            $sql = "UPDATE students SET full_name_s = '{$name}', email_s = '{$email}', address_s = '{$address}', phone_s = '{$phone}' WHERE id_s = '{$id}'";
            $update = mysqli_query($this->conn, $sql);

            if (!$update) {

                die('the query fail' . mysqli_error($this->conn));
            } else {
                header("Location: students.php");
            }

        }
    }

    function show_drivers(){
        $sql = "SELECT * FROM drivers  ";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id_d'];
                $full_name = $row['full_name_d'];
                $email = $row['email_d'];
                $address = $row['address_d'];
                $phone = $row['phone_d'];
                $time = $row['time_to_leave'];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$full_name</td>";
                echo "<td>$email</td>";
                echo "<td>$address</td>";
                echo "<td>$phone</td>";
                echo "<td>$time</td>";
                echo "<td><a href='drivers.php?delete={$id}'>Delete</a></td>";
                echo "<td><a href='edit_driver.php?edit={$id}'>Edit</a></td>";
                echo "<td><a href='view_driver.php?view_passengers={$id}'>View passengers</a></td>";
                echo "<tr>";

            }
        } else {
            echo "0 results";
        }
    }
    function insert_driver($data){
        $name = $data['name'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $time = $data['time'];

        $sql = "SELECT * FROM drivers WHERE email_d = '{$email}' OR phone_d = '{$phone}'";
        $true = $this->conn->query($sql);
        if ($true->num_rows > 0) {
            $row = mysqli_fetch_assoc($true);
            echo "Data already exists";
        }elseif ($name == "" || empty($name) || $email == "" || empty($email) || $address == "" || empty($address) || $phone == "" || empty($phone) || $time == "" || empty($time) ) {

            echo "enter the data";
        } else {
            $sql = "INSERT INTO drivers(full_name_d,email_d,address_d,phone_d,time_to_leave)";
            $sql .= "VALUE('{$name}','{$email}','{$address}','{$phone}','{$time}')";
            $result = mysqli_query($this->conn, $sql);
            if (!$result) {

                die('the query fail' . mysqli_error($this->conn));
            } else {
                header("Location: drivers.php");
                echo "insert the new student ";
            }

        }
    }
    function delete_driver($data){
        $the_id = $data['delete'];
        $sql ="DELETE FROM drivers WHERE id_d ={$the_id} ";
        $delete = mysqli_query($this->conn,$sql);
        header("Location: drivers.php");
    }
    function edit_driver($data){
        $the_id = $data['edit'];

        $sql = "SELECT * FROM drivers WHERE id_d = {$the_id}";
        $edit = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($edit);
        $id = $row['id_d'];
        $full_name = $row['full_name_d'];
        $email = $row['email_d'];
        $address = $row['address_d'];
        $phone = $row['phone_d'];
        $time = $row['time_to_leave'];
        return $x = [$id,$full_name,$email,$address,$phone,$time];
    }
    function update_driver($data){
        $name = $data['name'];
        $email = $data['email'];
        $address = $data['address'];
        $phone = $data['phone'];
        $time = $data['time'];
        $id=$data['id'];
        if ($name == "" || empty($name) || $email == "" || empty($email) || $address == "" || empty($address) || $phone == "" || empty($phone) || $time == "" || empty($time)) {

            echo "enter the data";
        } else {
            $sql = "UPDATE drivers SET full_name_d = '{$name}', email_d = '{$email}', address_d = '{$address}', phone_d = '{$phone}',time_to_leave ='{$time}' WHERE id_d = '{$id}'";
            $update = mysqli_query($this->conn, $sql);

            if (!$update) {

                die('the query fail' . mysqli_error($this->conn));
            } else {
                header("Location: drivers.php");
            }

        }
    }


    function add_student_bus ($data){
        $id_student = $data['id_student'];
        $id_driver  = $data['id_driver'];


         $count_students =  "SELECT id_student,full_name_s,id_driver
               FROM drivers,students,student_driver
               WHERE students.id_s = student_driver.id_student
        AND drivers.id_d = student_driver.id_driver AND drivers.id_d = '{$id_driver}'";
        $true1 = mysqli_query($this->conn,$count_students);
        $number =0;
        while ($raw = mysqli_fetch_assoc($true1)) {
            $count[] = $raw['id_student'];
            $number ++ ;
        }
        if($number >= 3){
          echo "the bus is full";
        }else{
            $check_driver ="SELECT drivers.time_to_leave
                    FROM drivers
                    WHERE drivers.id_d = '{$id_driver}'";
            $driver = mysqli_query($this->conn,$check_driver);
            $row1 = mysqli_fetch_assoc($driver);
            $driver_leave = $row1['time_to_leave'];
            $check_courses = "SELECT courses.Time_end_lecture
                    FROM students,courses,student_course
                    WHERE students.id_s = student_course.id_student AND courses.id_c = student_course.id_course AND
                     students.id_s = '{$id_student}'";
            $course = mysqli_query($this->conn,$check_courses);
            $row2 = mysqli_fetch_assoc($course);
            $course_leave = $row2['Time_end_lecture'];
            if($row2['Time_end_lecture']>=$driver_leave){
                echo "the course is let";
            }else{
                $sql = "SELECT * FROM student_driver WHERE id_student = '{$id_student}'";
                $true = $this->conn->query($sql);

                if ($true->num_rows > 0) {
                    $row = mysqli_fetch_assoc($true);
                    echo "Data already exists";
                }
                else {
                    $sql = "INSERT INTO student_driver(id_student,id_driver)";
                    $sql .= "VALUE('{$id_student}','{$id_driver}')";
                    $result = mysqli_query($this->conn, $sql);
                    if (!$result) {

                        die('the query fail' . " " .mysqli_error($this->conn));
                    } else {
                        echo "ok ";
                    }

                }
            }
        }







        }
    function add_student_course ($data){
        $id_student = $data['id_student'];
        $id_course  = $data['id_course'];
        $course ="SELECT id_course,id_student FROM courses,students,student_course WHERE students.id_s = student_course.id_student AND courses.id_c = student_course.id_course AND id_course = '{$id_course}'";
        $course_true= mysqli_query($this->conn,$course);
        $number =0;
        while ($raw = mysqli_fetch_assoc($course_true)) {
            $cunt = $raw['id_student'];
            $number ++ ;
        }
        if ($number>10){
            echo "the course is full";
        }else{

            $sql = "SELECT * FROM student_course WHERE id_student = '{$id_student}' AND id_course = '{$id_course}'";
            $true = $this->conn->query($sql);

            if ($true->num_rows > 0) {
                $row = mysqli_fetch_assoc($true);
                echo "Data already exists";
            }
            else {
                $sql = "INSERT INTO student_course(id_student,id_course)";
                $sql .= "VALUE('{$id_student}','{$id_course}')";
                $result = mysqli_query($this->conn, $sql);
                if (!$result) {

                    die('the query fail' . " " .mysqli_error($this->conn));
                } else {
                    echo "ok ";
                }

            }

        }
    }

    function view_passengers($data){
        $the_id = $data['view_passengers'];
        $sql = "SELECT id,drivers.id_d,students.full_name_s, students.address_s, drivers.full_name_d,drivers.time_to_leave, drivers.address_d, drivers.phone_d  
                    FROM students,drivers,student_driver
                    WHERE students.id_s = student_driver.id_student AND drivers.id_d = student_driver.id_driver  AND
                     drivers.id_d = '{$the_id}'";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            echo "no";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $id =$row['id'];
                $id_d =$row['id_d'];
                $full_name_d = $row['full_name_d'];
                $address_d = $row['address_d'];
                $phone_d = $row['phone_d'];
                $time_to_leave = $row['time_to_leave'];
                $full_name_s = $row['full_name_s'];
                $address_s = $row['address_s'];
                echo "<tr>";
                echo "<td>$id_d</td>";
                echo "<td>$full_name_d</td>";
                echo "<td>$address_d</td>";
                echo "<td>$phone_d</td>";
                echo "<td>$time_to_leave</td>";
                echo "<td>$full_name_s</td>";
                echo "<td>$address_s</td>";
                echo "<td><a href='view_driver.php?delete={$id}'>Delete</a></td>";

                echo "<tr>";


            }
        }
    }
    function view_more_information($data){
        $the_id = $data['view'];
        $sql = "SELECT students.id_s,students.full_name_s, drivers.full_name_d,drivers.time_to_leave, courses.full_name_c, students.email_s, students.address_s, students.phone_s, courses.Time_start_lecture,courses.Time_end_lecture  
                    FROM students,drivers,student_driver,courses,student_course
                    WHERE students.id_s = student_driver.id_student AND students.id_s = student_course.id_student 
                    AND drivers.id_d = student_driver.id_driver AND
                        courses.id_c = student_course.id_course AND
                     students.id_s = '{$the_id}'";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            echo "no";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $id_s =$row['id_s'];
                $full_name_s = $row['full_name_s'];
                $address_s = $row['address_s'];
                $full_name_d = $row['full_name_d'];
                $time_to_leave = $row['time_to_leave'];
                $full_name_c = $row['full_name_c'];
                $Time_start_lecture = $row['Time_start_lecture'];
                $Time_end_lecture = $row['Time_end_lecture'];
                echo "<tr>";
                echo "<td>$id_s</td>";
                echo "<td>$full_name_s</td>";
                echo "<td>$address_s</td>";
                echo "<td>$full_name_d</td>";
                echo "<td>$time_to_leave</td>";
                echo "<td>$full_name_c</td>";
                echo "<td>$Time_start_lecture</td>";
                echo "<td>$Time_end_lecture</td>";
                echo "<tr>";


            }
        }
    }
    function students_in_course($data){
        $the_id = $data['view'];
         $sql = "SELECT id,courses.id_c,courses.full_name_c,courses.Time_start_lecture,courses.Time_end_lecture, students.full_name_s,students.email_s   
                    FROM students,courses,student_course
                    WHERE students.id_s = student_course.id_student AND courses.id_c = student_course.id_course  AND
                     courses.id_c = '{$the_id}'";
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            echo "no";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $id_c =$row['id_c'];
                $full_name_c = $row['full_name_c'];
                $start_lecture = $row['Time_start_lecture'];
                $end_lecture = $row['Time_end_lecture'];
                $full_name_s = $row['full_name_s'];
                $email_s = $row['email_s'];
                echo "<tr>";
                echo "<td>$id_c</td>";
                echo "<td>$full_name_c</td>";
                echo "<td>$start_lecture</td>";
                echo "<td>$end_lecture</td>";
                echo "<td>$full_name_s</td>";
                echo "<td>$email_s</td>";
                echo "<td><a href='students_in_course.php?delete={$id}'>Delete</a></td>";
                echo "<tr>";


            }
        }
    }
    function delete_relation_course($data){
        $id = $data['delete'];
        $sql ="DELETE FROM `student_course` WHERE id={$id} ";
        $delete = mysqli_query($this->conn,$sql);
        header("Location: courses.php");

    }
    function delete_relation_driver($data){
        $id = $data['delete'];
        $sql ="DELETE FROM `student_driver` WHERE id={$id} ";
        $delete = mysqli_query($this->conn,$sql);
        header("Location: drivers.php");
    }

}

