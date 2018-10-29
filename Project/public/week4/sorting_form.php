<div class="container col-md-8 mt-2">
  <form method="get">
    <div class="row">
      <div class="form-group col-md-5">
        <label for="sortby">Sort By</label>
        <select class="custom-select" name="sortby">
        <?php for($i = 0; $i < sizeof($columns); $i++): ?>
            <option value="<?php echo $columns[$i]['COLUMN_NAME']; ?>" <?php echo isSelected('sortby', $columns[$i]['COLUMN_NAME']); ?>><?php echo $columnsInfo[$i]; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="form-check form-check-inline col-md-5">
        <label class="form-check-label mr-1" for="ASC">ASC</label>
        <input class="form-check-input" type="radio" id="ASC" name="order" value="ASC" <?php echo filter_input(INPUT_GET, 'order') === 'ASC' ? 'checked' : '' ?>>
        <label class="form-check-label mr-1" for="DESC">DESC</label>
        <input class="form-check-input" type="radio" id="DESC" name="order" value="DESC" <?php echo filter_input(INPUT_GET, 'order') === 'DESC' ? 'checked' : '' ?>>
      </div>
    </div>
    <input type="hidden" name="action" value="sort">
    <button type="submit" class="btn btn-primary">Sort</button>
  </form>
</div>