<!-- *******Procecsee Update When you click the button Mofidy ******* -->
<?php
if (isset($_POST['update'])){
// Step 01: Get Data  from HTML Page
  $nfm = $_POST['fn'];
  $nlm = $_POST['ln'];
  $ndept = $_POST['Dept'];
  $nyr = $_POST['Year'];



// Step 02: Connection Between php and server-database
include 'p1c.php';


// Step 03: Query Construction
$qup = "UPDATE Students
        SET FirstName = '$nfm', 
            LastName = '$nlm',
            Department = $ndept,
            year = $nyr
        WHERE  Department = $ndept  AND
                year = $nyr       AND
                FirstName = '$nfm'";



// Step 04 : Query Verification
echo $qup;


// Step 05: Query Excecution
$table_student_update = mysqli_query($conn  , $qup);



// Step 06: Traitement of the query Result
echo "the student is updated succefully into the database";








}


?>