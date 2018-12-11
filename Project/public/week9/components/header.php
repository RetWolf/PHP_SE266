<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <span class="navbar-brand mb-0 h1">Country Data</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <!-- Create links to the Home, Search, and Chart pages. Use ternary statement for setting active tags in navbar. -->
      <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'index') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'search') ? 'active' : '' ?>">
        <a class="nav-link" href="search.php">Search</a>
      </li>
      <li class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], 'byRegion') ? 'active' : '' ?>">
        <a class="nav-link" href="byRegion.php">By Region</a>
      </li>
    </ul>
  </div>
</nav>