<?php
// Step 01: Get Data  from HTML Page
if (isset($_POST['btnDisplay'])){
  $dept = isset($_POST['Dept'])?$_POST['Dept']: 'All'; //if (isset($_POST['Dept']))   $dept = $_POST['Dept']; else  $dept = 'All';
  $year = isset($_POST['Year'])?$_POST['Year']: 'All'; //if (isset($_POST['Year']))   $year = $_POST['Year']; else  $year = 'All';
//  echo "dept = " .  $dept . "<br>"; 
//  echo "Year = " .  $year . "<br>";
}


// Step 02: Connection Between php and server-database
include 'p1c.php';



// Step 03: Query Construction
$qsel = "SELECT DISTINCT d.DeptCode , s.year
          FROM   Departments d , Students s
          WHERE d.DeptNum = s.Department;";


// Step 04 : Query Verification
// echo $qsel;


// Step 05: Query Excecution
$table = mysqli_query($conn , $qsel); # Go to the server 127.0.0.1 and hit database abc1718, and Go tab SQL and Past the $sql Finalry store the result in $table
if(!($table))
  echo "Error: " . mysqli_error($conn) . "<br>";
else
  // echo "excecution of query is executed properly";




// Step 06: Traitement of the query Result
/*
while ($ardy=mysqli_fetch_assoc($table)){
  echo "<pre>";
  print_r ($ardy);
}
*/
?>

<form action="p2d.php" method="POST">
<table border  align = 'center' bgcolor='#e2adcc'>
  <!-- Hedaer -->
  <tr>
      <th>Department</th> <th>Year</th>
  </tr>

  <!-- //Rows -->
  <?php 
  while ($ardy=mysqli_fetch_assoc($table))
  {
    /*echo "<pre>";    print_r ($ardy); */
    //Check Department  
    if ($ardy['DeptCode']== $dept)
        $checkd = 'checked';
    else
      $checkd ='';
      

    //Check year  
    if ($ardy['year']== $year)
        $checky = 'checked';
    else
      $checky ='';
  ?>
      <!-- html blocks belong to while -->
      <tr>
          <td>  <input type="radio" name="Dept" value=<?php  echo $ardy['DeptCode']  ;?>     <?php echo "$checkd"  ; ?>   >  <?php   echo $ardy['DeptCode'] ;?>   </td>
          <td>  <input type="radio" name="Year" value=<?php  echo $ardy['year']      ;?>     <?php echo "$checky"  ; ?>   >  <?php   echo $ardy['year'] ;?>   </td>
      </tr>
      <!-- html blocks belong to while -->

  <?php
  }
  ?>
   
<!-- Buttuns  -->
<tr>
 <th colspan='2'> <input type='submit' name='btnDisplay' value='Display'> </th>
</tr>




</table>



</form>


<!-- =============================Display Table of Students ============================== -->
<?php
// Step 01: Get Data  from HTML Page
if (isset($_POST['btnDisplay'])){
$vdept = $_POST['Dept'];
$vyear = $_POST['Year'];
// echo $vdept . "    " . $vyear;

// Step 02: Connection Between php and server-database
// include 'p1c.php';  already includes the connection file in the line 12


// Step 03: Query Construction
$sql = "SELECT d.DeptCode , s.LastName , s.FirstName , s.AcademicYear , s.Department , s.year 
        FROM Departments d , Students s 
        WHERE d.DeptNum = s.department AND d.DeptCode = '$vdept' AND s.year = $vyear
        "; 

// Step 03: Query Verification manualy
// echo $sql ; // copy query from browser ---> ServerMysql--->Localost---->Database---->table students---->Tab: SQL PAST query------>Go ----> Result Tables of records

// Step 05: Query Excecution automatically;
$table1 = mysqli_query($conn  , $sql);
if (!($table1)){
  echo mysqli_error($conn) . "<br>";
}
else{
  // echo "The query select of department and students is well executed on the database" ."<br>" ; 
}

$nbr_Rows1 = mysqli_num_rows($table1); // number of rows in the table  exec_query
// echo "number of rows = "  . $nbr_Rows1 . "<br>";
// if ($nbr_Rows1 >0)
// echo "We found " . $nbr_Rows1 . " rows in table1"; //2
// else
//   echo "No records have been dispalyes in my database";



// Step 06: Traitement of the query Result
// while ($ar_rec = mysqli_fetch_assoc($table1)){
//   echo "<pre>" ;
//   print_r($ar_rec);
// }// while
?>  <!-- Close block PHP -->

<table  border align='left' border=1.0> <!-- Open block HTML -->
  <tr>
    <td>DeptCode</td>
    <td>LastName</td>
    <td>FirstName</td>
    <td>AcademicYear</td>
    <td>Department</td>
    <td>year</td>
    <td>Update</td>
    <td>Delete</td>
  </tr>
   
    <?php
      while ($ar_rec = mysqli_fetch_assoc($table1))
      {
       echo "<pre>" ;
       print_r($ar_rec);
      ?>

        <tr>
        <td> <?php  echo $ar_rec ['DeptCode'] ?>  </td> 
        <td> <?php  echo $ar_rec ['LastName'] ?>  </td>  
        <td> <?php  echo $ar_rec ['FirstName'] ?>  </td> 
        <td> <?php  echo $ar_rec ['AcademicYear'] ?>  </td> 
        <td> <?php  echo $ar_rec ['Department'] ?>  </td> 
        <td> <?php  echo $ar_rec ['year'] ?>  </td>  
        <td> <?php echo "<a href=p4au.php?gdept=$ar_rec[Department]&gyear=$ar_rec[year]&gfn=$ar_rec[FirstName]> Update $ar_rec[Department] $ar_rec[year]" . "  " .  $ar_rec ['FirstName'] . "</a>"   ; ?>   </td>
        <td> <?php echo "<a href=p5ad.php?gdept=$ar_rec[Department]&gyear=$ar_rec[year]&gfn=$ar_rec[FirstName]> Delete $ar_rec[Department] $ar_rec[year]" . "  " .  $ar_rec ['FirstName'] . "</a>"   ; ?>   </td>


        </tr>


      <?php
    }
      ?>

</table>                            <!-- Close block HTML -->



<?php
}// if isset
?>