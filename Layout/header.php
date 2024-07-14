<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <title>Test Daily expenses </title>
</head>

<body style="background-color:#edeff0">
<nav class="navbar navbar-expand-lg sticky-top" style="background-color:#5161ce;">
  <div class="container-fluid">
    <a class="nav-link" href="expenses.php">EXPENSES</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="catagory.php">Create catagory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="info.php">Inforamtion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="expenses.php">Expenses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="daily_expences_list.php">Daily expences list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="expensesfilter.php">Filter your data</a>
        </li>
      </ul>  
    </div>
    <form class="d-flex justify-content-end" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary" type="submit">Search</button>
    </form>
    <div class="logout mx-2 mt-2">
      <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
  </div>
</nav>
