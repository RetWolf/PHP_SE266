<?php if(isset($results)): ?>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <!-- Create Table Headings Here -->
        <?php foreach($results[0] as $key => $val): ?>
          <?php if($key !== 'CountryID'): ?>
            <th scope="col"><?php echo $key; ?></th>
          <?php endif; ?>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <!-- Create Table Rows Here -->
      <?php foreach($results as $country): ?>
        <tr>
          <?php foreach($country as $key => $val): ?>
            <?php if($key !== 'CountryID'): ?>
              <!-- Create Link to Edit Country -->
              <?php if($key === 'Country'): ?>
                <td scope="row"><a href="edit.php?id=<?php echo $country['CountryID']; ?>"><?php echo $val; ?></a></td>
              <?php else: ?>
                <td><?php echo $val; ?></td>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>