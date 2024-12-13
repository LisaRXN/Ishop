<!-------------------------------------------------------------------------->
<!------------------------------- Footer ----------------------------------->
<!-------------------------------------------------------------------------->

<div id="footer" class="footer-admin">

  <div class="footer-container-admin ">


    <!-- Revenir une page en arriere -->
    <?php if ($_GET['page_id'] > 1): ?>
      <a href="index.php?p=<?= $products_table->getTable() ?>&page_id=<?= $_GET['page_id']  - 1 ; ?>&limit=<?= $limit ?>"
        class="footer-num"><</a>
        <?php endif ?>

        <!-- Affichage des numéros de pages -->
        <?php if ($limit < $count): ?>
          <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="index.php?p=<?= $products_table->getTable() ?>&page_id=<?= $i ?>&limit=<?= $limit ?>"
              class="footer-num footer-num-admin"><?= $i ?></a>
          <?php endfor ?>

          <!-- aller une page en avant -->
          <?php if ($_GET['page_id'] < $pages): ?>
            <a href="index.php?p=<?= $products_table->getTable() ?>&page_id=<?= $_GET['page_id'] ? $_GET['page_id'] + 1 : 2; ?>&limit=<?= $limit ?>"
              class="footer-num footer-num-admin">></a>
          <?php endif ?>
        <?php endif ?>
  </div>
</div>