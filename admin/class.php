<div id="bodyright">
  <?php
  if(isset($_GET['edit_class'])){
       echo edit_class();
      }
    else
    { ?>
    <h3>View all categories</h3>
    <div id="add">
      <details>
        <summary>Add Class</summary>
        <form enctype="multipart/form-data" method="post">
              <input type="text" name="class_name" placeholder="Enter Class number" >
              <centre>
                 <button  name="add_class">Add Class</button>
              </centre>
        </form>
        <table>
          <tr>
            <th>Srno</th>
            <th>Class</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php echo viewclass(); ?>
        </table>
      </details>
    </div>
  </div>

<?php echo add_class();} ?>
