<div id="bodyright">
    <?php
    if(isset($_GET['edit_subject']))
    {
      echo edit_subject();
    }
    else{?>
    <h3>View all subcategories</h3>
    <div id="add">
      <details>
        <table >
          <tr>
            <th>Srno</th>
            <th>Subject</th>
            <th>Class</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php echo viewsubclass(); ?>
        </table>
       <summary>Add Subects</summary>

      <form enctype="multipart/form-data" method="post">
        <select  name="class_id">
          <option value="">Select class</option>
          <?php echo select_class(); ?>

        </select>
            <input type="text" name="subclass_name" placeholder="Enter subject" >
        <centre>
          <button  name="add_subclass">Add subjects</button>
        </centre>
      </form>
    </details>
  </div>
<?php } ?>
</div>
<?php echo add_subclass(); ?>