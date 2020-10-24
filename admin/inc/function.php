<?php

function add_class(){
  include("inc/db.php");
  if(isset($_POST['add_class']))
  {
    $class_name=$_POST['class_name'];
    $check=$con->prepare("select * from class where classno='$class_name'");
    $check->setFetchMode(PDO:: FETCH_ASSOC);
    $check->execute();
    $count=$check->rowCount();
    if($count==1){
      echo "<script> alert('Already added successfully')</script>";
      echo "<script> window.open('index.php?class','_self') </script>";
    }
    $add_class=$con->prepare("insert into class(classno) values('$class_name')");
    if($add_class->execute()){
      echo "<script> alert('Added successfully')</script>";
      echo "<script> window.open('index.php?class','_self') </script>";
    }
    else {
      echo "<script> alert('Not added successfully')</script>";
      echo "<script> window.open('index.php?class','_self') </script>";
    }
  }
}
function select_class()
{
   include("inc/db.php");
   $get_class=$con->prepare("select * from class");
   $get_class->setFetchMode(PDO:: FETCH_ASSOC);
   $get_class->execute();
   while($row=$get_class->fetch()):
       echo "<option value='".$row['classid']."'>".$row['classno']."</option>";
   endwhile;
 }

 function add_subclass(){
   include("inc/db.php");
   if(isset($_POST['add_subclass']))
   {
     $subclass_name=$_POST['subclass_name'];
     $class_id=$_POST['class_id'];
     $check=$con->prepare("select * from subject where subname='$subclass_name'");
     $check->setFetchMode(PDO:: FETCH_ASSOC);
     $check->execute();
     $count=$check->rowCount();
     if($count==1){
       echo "<script> alert('Already added successfully')</script>";
       echo "<script> window.open('index.php?subclass','_self') </script>";
     }
     $add_class=$con->prepare("insert into subject(subname,classid) values('$subclass_name','$class_id')");
     if($add_class->execute()){
       echo "<script> alert('Added successfully')</script>";
       echo "<script> window.open('index.php?subclass','_self') </script>";
     }
     else {
       echo "<script> alert('Not added successfully')</script>";
       echo "<script> window.open('index.php?subclass','_self') </script>";
     }
   }
 }
 function viewclass()
 {
   include("inc/db.php");
   $get_class=$con->prepare("select * from class");
   $get_class->setFetchMode(PDO:: FETCH_ASSOC);
   $get_class->execute();
   $i=1;
   while($row=$get_class->fetch()):
     echo "<tr>
            <td>".$i++."</td>
            <td>".$row['classno']."</td>
            <td><a href='index.php?class&edit_class=".$row['classid']."'>Edit</a></td>
            <td><a href='index.php?class&del_class=".$row['classid']."'>Delete</a></td>
          </tr>";
   endwhile;

   if (isset($_GET['del_class']))
   {
     $id=$_GET['del_class'];

     $del=$con->prepare("delete from class where classid='$id'");
     if($del->execute()){
       echo "<script> alert('Deleted successfully' )</script>";
       echo "<script>window.open{'index.php?class','_self'}</script>";
     }
     else{
       echo "<script> alert('Not deleted successfully' )</script>";
       echo "<script>window.open{'index.php?class','_self'}</script>";
     }
   }
 }

 function viewsubclass()
 {
   include("inc/db.php");
   $get_class=$con->prepare("select * from subject");
   $get_class->setFetchMode(PDO:: FETCH_ASSOC);
   $get_class->execute();
   $i=1;
   while($row=$get_class->fetch()):
     $id=$row['classid'];
     $get_c=$con->prepare("select * from class where classid='$id'");
     $get_c->setFetchMode(PDO:: FETCH_ASSOC);
     $get_c->execute();
     $row_class=$get_c->Fetch();
    echo "<tr>
            <td>".$i++."</td>
            <td>".$row['subname']."</td>
            <td>".$row_class['classno']."</td>
            <td><a href='index.php?subclass&edit_subject=".$row['sub_id']."'>Edit</a></td>
            <td><a href='index.php?subclass&del_subject=".$row['sub_id']."'>Delete</a></td>
          </tr>";
      endwhile;

      if (isset($_GET['del_subject']))
      {
        $id=$_GET['del_subject'];

        $del=$con->prepare("delete from subject where sub_id='$id'");
        if($del->execute()){
          echo "<script> alert('Deleted successfully' )</script>";
          echo "<script>window.open{'index.php?subclass','_self'}</script>";
        }
        else{
          echo "<script> alert('Not deleted successfully' )</script>";
          echo "<script>window.open{'index.php?subclass','_self'}</script>";
        }
      }
 }
 function edit_class(){
   include("inc/db.php");

   if(isset($_GET['edit_class']))
   {
     $id=$_GET['edit_class'];
     $get_class=$con->prepare("select * from class where classno='$id'");
     $get_class->setFetchMode(PDO::FETCH_ASSOC);
     $get_class->execute();
     $row=$get_class->fetch();
     echo "<h3>Edit Class</h3>
          <form id='edit' enctype='multipart/form-data' method='post'>
           <input type='text' name='class_name'   placeholder='Enter Class number' >
           <centre><button  name='edit_class'>Edit Class</button></centre>
     </form>";
     if (isset($_POST['edit_class']))
     {
       $class_name=$_POST['class_name'];
       $check=$con->prepare("select * from class where classno='$class_name'");
       $check->setFetchMode(PDO:: FETCH_ASSOC);
       $check->execute();
       $count=$check->rowCount();
           if($count==1)
           {
                 echo "<script> alert('Already added successfully')</script>";
                 echo "<script> window.open('index.php?class','_self') </script>";
           }
           else{
                 $up=$con->prepare("update class set classno='$class_name' where classid='$id'");
                 if($up->execute())
                 {
                     echo "<script> alert('Updated successfully')</script>";
                     echo "<script> window.open('index.php?class','_self') </script>";
                 }
                 else
                 {
                       echo "<script> alert('Not Updated successfully')</script>";
                       echo "<script> window.open('index.php?class','_self') </script>";
                 }
               }
        }
       }
       }

       function edit_subject(){
         include("inc/db.php");

         if(isset($_GET['edit_subject']))
         {
           $id=$_GET['edit_subject'];
           $get_class=$con->prepare("select * from subject where sub_id='$id'");
           $get_class->setFetchMode(PDO::FETCH_ASSOC);
           $get_class->execute();
           $row=$get_class->fetch();
           $class_id=$row['classid'];
           $get_c=$con->prepare("select classno from class where classid='$class_id'");
           $get_c->setFetchMode(PDO::FETCH_ASSOC);
           $get_c->execute();
           $row_class=$get_c->fetch();
           echo "<h3>Edit Subject</h3>
                <form id='edit' enctype='multipart/form-data' method='post'>
                <select  name='c_id'>
                <option >".$row_class['classno']."</option>";
                   echo select_class();
          echo "</select>
                 <input type='text' name='subject_name'   placeholder='Enter Subject' >
                 <centre><button  name='edit_subject'>Edit Subject</button></centre>
           </form>";
           if (isset($_POST['edit_subject']))
           {
             $class_name=$_POST['subject_name'];
             $class_id=$_POST['c_id'];
                       $up=$con->prepare("update subject set subname='$class_name', classid='$class_id' where sub_id='$id'");
                       if($up->execute())
                       {
                           echo "<script> alert('Updated successfully')</script>";
                           echo "<script> window.open('index.php?subclass','_self') </script>";
                       }
                       else
                       {
                             echo "<script> alert('Not Updated successfully')</script>";
                             echo "<script> window.open('index.php?subclass','_self') </script>";
                       }

             }}
             }
             function contact(){
               include("inc/db.php");
               $get_con=$con->prepare("select * from contact");
               $get_con->setFetchMode(PDO::FETCH_ASSOC);
               $get_con->execute();
               $row=$get_con->fetch();
               echo "<form enctype='multipart/form-data' method='post'>
                    <table>
                      <tr>
                        <td>Contact number</td>
                        <td><input type='tel' value='".$row['phn']."' name='phn' ></td>
                      </tr>
                      <tr>
                        <td>E-mail</td>
                        <td><input type='text' value='".$row['email']."' name='email' ></td>
                      </tr>
                      <tr>
                        <td>https://facebook.com</td>
                        <td><input type='text' value='".$row['fb']."' name='fb' ></td>
                      </tr>
                      <tr>
                        <td>https://instagram.com</td>
                        <td><input type='text' value='".$row['ins']."' name='ins' ></td>
                      </tr>
                    </table>
                    <br>
                     <centre> <button  name='up_con'>Save</button></centre>
               </form>";
               if(isset($_POST['up_con'])){
                 $p=$_POST['phn'];
                 $e=$_POST['email'];
                 $f=$_POST['fb'];
                 $i=$_POST['ins'];
                 $up=$con->prepare("update contact set phn='$p',email='$e',fb='$f',ins='$i'");
                 if($up->execute()){
                   echo "<script>window.open('index.php?contact,'_self')</script>";
                 }
               }
             }

             function about(){
               include("inc/db.php");
               $about=$con->prepare("select * from about");
               $about->setFetchMode(PDO::FETCH_ASSOC);
               $about->execute();
               $row=$about->fetch();
               echo "<form  method='post'>
                 <textarea name='about'>".$row['about']."</textarea>
                 <button  name='up_about'>Save</button>
               </form>";
              if(isset($_POST['up_about'])){
                  $info=$_POST['about'];
                  $up_about=$con->prepare("update about set about='$info'");
                  if($up_about->execute()){
                    echo "<script>window.open('index.php?about,'_self')</script>";
                  }

}
             }
     ?>
