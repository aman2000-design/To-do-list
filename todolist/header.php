<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if (is_numeric($compid)) {?>
      <li class="nav-item active">
        <a class="nav-link" href="companyDetails.php">Company Details </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link " href="addEmp.php">
         Add Employee
        </a>
      </li>
     <?php }?>
      <li class="nav-item">
        <a class="nav-link" href="addTask.php">Add Task</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="list_of_Tasks.php">list of Tasks</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>