
<div id=filter>
  <div class="filter-card">
    <p class="filter-title">filter by</p>

    <div class="filter-container">
      <div class="filter-btn-container">
        <button class="filter-btn filter-btn-bold">Collection</button>
        <img class="search-filter-img" src="/img/btn-black.png" />
      </div>
      <div class="dropdown-content filter-dropdown">

        <?php foreach ($collections as $collection): ?>
        <a href="index.php?collection=<?php echo $collection->collection ?>">
        <?php echo str_replace("-"," ", $collection->collection)  ?>
        </a>
        <?php endforeach ?>

      </div>
    </div>

    <div class="filter-container">
      <div class="filter-btn-container">
        <button class="filter-btn filter-btn-bold">Color</button>
        <img class="search-filter-img" src="/img/btn-black.png" />
      </div>
      <div class="dropdown-content filter-dropdown">
        <?php foreach ($colors as $color): ?>
          <a href="index.php?color=<?php echo $color->color?>">
          <?php echo str_replace("-"," ", $color->color)  ?>
        </a>
        <?php endforeach ?>
      </div>
    </div>

    <div class="filter-container">
      <div class="filter-btn-container">
        <button class="filter-btn filter-btn-bold">Category</button>
        <img class="search-filter-img" src="/img/btn-black.png" />
      </div>

      <div id="myDropdown" class="dropdown-content filter-dropdown">
        <?php foreach ($categories_id as $cat): ?>
          <a href="index.php?category=<?php echo urlencode($products_table->getCategoryName($cat->category_id))?>">
          <?php echo str_replace("-"," ", $products_table->getCategoryName($cat->category_id))  ?>
        </a>
        <?php endforeach ?>
      </div>
    </div>

    <!--Filter by Range Price -->
    <div class="filter-price-container">
      <p>Price Range</p>
    </div>

    <div class="filter-slide-container">
      <form method="get" id="range-form">
      <hr class="filter-hr">
      <input type="range" min="1" max="1000" value="<?php echo $_GET['range-min'] ? $_GET['range-min']  : 1 ?>" class="filter-slide" id="myRange" name="range-min">
      <input type="range" min="1000" max="10000" value="<?php echo $_GET['range-max'] ? $_GET['range-max'] : 10000 ?>" class="filter-slide revert" id="myRangeRevert" name="range-max">
      </form>
      <div class="filter-range">
        <p class="filter-range-min"></p>
        <p class="filter-range-max"></p>
      </div>
    </div>
  </div>
</div>