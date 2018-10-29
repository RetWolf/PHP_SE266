<div class="container col-md-8 mt-2">
  <form method="get">
    <div class="row">
      <div class="form-group col-md-5">
        <label for="searchby">Search By</label>
        <select class="custom-select" name="searchby">
          <?php for($i = 0; $i < sizeof($columns); $i++): ?>
            <option value="<?php echo $columns[$i]['COLUMN_NAME']; ?>" <?php echo isSelected('searchby', $columns[$i]['COLUMN_NAME']); ?>><?php echo $columnsInfo[$i]; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-group col-md-5">
        <label for="searchvalue">Enter Value:</label>
        <input type="text" class="form-control" name="searchValue" value="<?php echo filter_input(INPUT_GET, 'searchValue') === "" ? "" : filter_input(INPUT_GET, 'searchValue'); ?>">
        <input type="hidden" name="action" value="search">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
</div>