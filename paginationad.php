<?php
if ($current_page > 3) {
$first_page = 1;
 ?>
 <a class="product-items product-items-number " href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
<?php }
  if ($current_page > 1) {
    $prev_page = $current_page - 1 ;
         ?>
 <a class="product-items product-items-number" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
 <?php }
?>
<?php
for($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if($num != $current_page) { ?>
        <?php if($num > $current_page - 3 && $num < $current_page + 3 ) { ?>
    <a class="product-items product-items-number" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><i class="num-config num-click"><?= $num?></i></a>
     <?php }  ?>
     <?php } else { ?>
     <strong class="product-items product-items-number"><i class="num-config"><?= $num?></i></strong>
     <?php } ?>
          <?php } ?>
<?php
    if ($current_page < $totalPages - 1 ) {
        $next_page = $current_page + 1 ;
            ?>
         <a class="product-items product-items-number" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
         <?php } ?>
<?php
    if ($current_page < $totalPages - 3 ) {
         $end_page = $totalPages;
                 ?>
            <a class="product-items product-items-number" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
         <?php }
       ?>              