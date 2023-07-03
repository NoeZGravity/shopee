<?php
if ($current_page > 3) {
$first_page = 1;
 ?>
 <a class="home-filter-page home-filter-page-before" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
<?php }
  if ($current_page > 1) {
    $prev_page = $current_page - 1 ;
         ?>
 <a class="home-filter-page home-filter-page-before" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
 <?php }
?>
<?php
for($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if($num != $current_page) { ?>
        <?php if($num > $current_page - 3 && $num < $current_page + 3 ) { ?>
    <a class="home-filter-page home-filter-page-before" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><i class="num-config num-click"><?= $num?></i></a>
     <?php }  ?>
     <?php } else { ?>
     <strong class="home-filter-page-current"><i class="num-config"><?= $num?></i></strong>
     <?php } ?>
          <?php } ?>
<?php
    if ($current_page < $totalPages - 1 ) {
        $next_page = $current_page + 1 ;
            ?>
         <a class="home-filter-page home-filter-page-before" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
         <?php } ?>
<?php
    if ($current_page < $totalPages - 3 ) {
         $end_page = $totalPages;
                 ?>
            <a class="home-filter-page home-filter-page-before" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
         <?php }
       ?>              