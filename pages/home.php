<?php

// Filtres de recherche
$products_table = new Product();
$error_message = "";
$has_error = false;

if (isset($_POST["search"])) {
  $filter = htmlspecialchars($_POST["search"], ENT_QUOTES, 'UTF-8');
  $products = $products_table->search($filter);

  if (!isset($products)) {
    $has_error = true;
    $error_message .= "<h2>No results matching your search.. " . $filter . "</h2> <br> <p>Please try again with a different keyword...</p>";
  }
} else {
  $products = $products_table->getAll();
}


// Propriétés des articles 
$collections = $products_table->getColumn("collection");
$colors = $products_table->getColumn("color");
$categories_id = $products_table->getColumn("category_id");


// Limite d'article par pages
if ($_GET['limit']) {
  $limit = $_GET['limit'];
} else {
  $limit = 7;
}
$count = $products_table->count();
$pages = ceil($count / $limit);


// Header
require 'templates/header.php';
?>


<!-------------------------------------------------------------------------->
<!------------------------------- Search WEB ------------------------------->
<!-------------------------------------------------------------------------->

<!------------- Search-bar -------------->
<div class="search">
  <div class="search-bar-content">
    <div class="search-img-content">
      <img class="search-img" src="/img/Search.png" />
    </div>
    <form id="search-form" method="post">
      <input class="search-bar" type="text" name="search" placeholder="Search..." />
    </form>
  </div>
  <!---------- Number of results --------->
  <div class="search-result">
    <div class="search-match">
      <button class="search-match-btn filter-btn">Number of results</button>
      <img class="search-match-img" src="/img/btn-black.png" />
    </div>
    <div class="dropdown-content filter-dropdown result-dropdown">
      <a href="index.php?limit=7">7</a>
      <a href="index.php?page_id=1&limit=15">15</a>
      <a href="index.php?page_id=1&limit=23">23</a>
    </div>
  </div>
</div>


<!-------------------------------------------------------------------------->
<!----------------------------- Search  MOBILE ----------------------------->
<!-------------------------------------------------------------------------->

<div class="filter-mobile">

  <!-- Filter -->
  <div class="filter-container">
    <div class="filter-btn-container">
      <button class="filter-btn filter-btn-bold">Filter</button>
      <img class="search-filter-img" src="/img/btn-black.png" />
    </div>
    <!-- dropdown -->
    <div class="dropdown-content filter-dropdown">

      <a class="sub-filter-btn" href="">collection</a>
      <!-- sub-dropdown -->
      <div class="filter-container">
        <div class="dropdown-content-sub">
          <?php foreach ($collections as $collection): ?>
            <a href="index.php?collection=<?php echo $collection->collection ?>"><?php echo $collection->collection ?></a>
          <?php endforeach ?>
        </div>
      </div>

      <a class="sub-filter-btn" href="">color</a>
      <!-- sub-dropdown -->
      <div class="filter-container">
        <div class="dropdown-content-sub">
          <?php foreach ($colors as $color): ?>
            <a href="index.php?color=<?php echo $color->color ?>"><?php echo $color->color ?></a>
          <?php endforeach ?>
        </div>
      </div>

      <a class="sub-filter-btn" href="">category</a>
      <!-- sub-dropdown -->
      <div class="filter-container">
        <div class="dropdown-content-sub">
          <?php foreach ($categories_id as $cat): ?>
            <a
              href="index.php?category=<?php echo urlencode($products_table->getCategoryName($cat->category_id)) ?>"><?php echo $products_table->getCategoryName($cat->category_id) ?></a>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>

  </div>
<!-------------------------------------------------------------------------->
<!------------------------------- Grid ------------------------------------->
<!-------------------------------------------------------------------------->

<?php if ($has_error): ?>
  <div>
    <?php echo $error_message ?>
  <?php else: ?>


    <div id="grid">

      <!-------------- Filter ------------->

    <?php require 'templates/filter.php' ?>

    <!-------------- Cards ------------->
    <?php require 'templates/card.php' ?>



  </div>


  
  <!-------------------------------------------------------------------------->
  <!------------------------------- Footer ----------------------------------->
  <!-------------------------------------------------------------------------->

    <div id="footer">
      <div class="footer-container">

        <!-- Revenir une page en arriere -->
        <?php if ($_GET['page_id'] > 1): ?>
          <a href="index.php?p=home&page_id=<?= $_GET['page_id'] - 1; ?>&limit=<?= $limit ?>" class="footer-num"> < </a>
            <?php endif ?>

            <!-- Affichage des numéros de pages -->
            <?php if ($limit < $count): ?>
              <?php for ($i = 1; $i <= $pages; $i++): ?>

                <?php $active = ($_GET['page_id'] == $i) ? "num-active" : ""; ?>

                <a href="index.php?p=home&page_id=<?= $i ?>&limit=<?= $limit ?>"
                  class="footer-num <?= $active ?>"><?= $i ?></a>
              <?php endfor ?>


              <!-- aller une page en avant -->
              <?php if ($_GET['page_id'] < $pages): ?>
                <a href="index.php?p=home&page_id=<?= $_GET['page_id'] ? $_GET['page_id'] + 1 : 2; ?>&limit=<?= $limit ?>"
                  class="footer-num">></a>
              <?php endif ?>
            <?php endif ?>
      </div>
    </div>
  </div>
  </div>


  </div>
<?php endif ?>




    <!-------------- Modal ------------->
    <?php require 'templates/modal.php' ?>



<!------------- JS -------------->


<script src="/JS/index.js">

</script>


</body>

</html>