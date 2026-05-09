<?php
// Step 01: Get Data  from HTML Page
$vdept = $_GET['gdept']; //echo $vdept; 1
$vyear = $_GET['gyear'];//echo $vyear;   2
$vname = $_GET['gfn'];//echo $vname;  Riham

// Step 02: Connection Between php and server-database
include 'p1c.php';

// Step 03: Query Construction
$sel_std = "SELECT *
            FROM Students s
            WHERE  s.Department = $vdept AND s.year = $vyear AND s.Firstname='$vname'" ; 

$sel_dept= "SELECT DeptNum , Deptcode FROM Departments";

$sel_year = "SELECT DISTINCT year From Students";


// Step 04 : Query Verification
//  echo $sel_std ;
// echo $sel_dept;
// echo $sel_year;


// Step 05: Query Excecution
$table_std = mysqli_query($conn  , $sel_std);
$table_dept = mysqli_query($conn  , $sel_dept);
$table_year = mysqli_query($conn  , $sel_year);


// Step 06: Traitement of the query Result
?>

<form action="p6delete.php" method="POST">
  <table border=1.0 align='center'>

     <!-- First Part of the table FirstNanme and lastName -->     
     <?php
     while($ar_std = mysqli_fetch_assoc($table_std))
     {// echo "ar_std";   echo "<pre>";      print_r ($ar_std);   
     ?> 
       <tr> <td> First name</td>   
            <td> <input type="text" name="fn" value="<?php echo $ar_std['FirstName'];?>">   </td> 
        </tr>
        <tr> <td> Last name</td>   
            <td> <input type="text" name="ln" value="  <?php echo $ar_std['LastName']   ; ?>    ">   </td> 
        </tr>
     
     <?php
     }
     ?>

      <!-- Second Part of the table display radio box Departement-->  
      <tr>

        <td>Department <br>        
          <?php
          while($ar_dept = mysqli_fetch_assoc($table_dept))
          {    //echo "ar_dept";   echo "<pre>";      print_r ($ar_dept); 
          if ($ar_dept['DeptNum'] == $vdept)
              $check_dept= 'checked';
          else 
          $check_dept='';
          ?>
          <input type="radio" name="Dept" value= " <?php echo $ar_dept['DeptNum'] ; ?>"  <?php echo $check_dept  ;?>>
           <?php echo $ar_dept['Deptcode'] ; ?>
           <br>
          <?php
          }
          ?>      
       </td>   

        <!-- Third  Part of the table display radio box  year-->  
        <td>Year <br>        
          <?php
          while($ar_year = mysqli_fetch_assoc($table_year))
          {    //echo "ar_year";   echo "<pre>";      print_r ($ar_year); 
          if ($ar_year['year'] == $vyear)
              $check_year= 'checked';
          else 
          $check_year='';
          ?>
          <input type="radio" name="Year" value= " <?php echo $ar_year['year'] ; ?>"  <?php echo $check_year  ;?>>
           <?php echo $ar_year['year'] ; ?>
           <br>
          <?php
          }
          ?>      
       </td> 
      </tr>

      <!-- Fourth  Part of the table display Button Update-->  
    <tr> <td colspan="2" align="center" > <input type="submit" name=Delete value="Delete"> </td> </tr>
  </table>
</form>
