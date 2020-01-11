<!DOCTYPE html>
<html>
<head>
	<title>Expense Manager</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<style>
	/*body {
	  font-family: "Lato", sans-serif;
	}*/
	.sidenav {
	  height: 100%;
	  width: 200px;
	  position: fixed;
	  z-index: 1;
	  top: 0;
	  left: 0;
	  background-color: black;
	  overflow-x: hidden;
	  padding-top: 20px;
	}

	.sidenav .main_link {
	  padding: 0px;
	  margin: 20px;
	  text-decoration: none;
	  font-size: 14px;
	  font-weight: bolder;
	  color: #818181;
	  display: block;
	}

	.sidenav .sub_link{
	  padding: 0px;
	  margin: 20px 20px 20px 50px;
	  text-decoration: none;
	  font-size: 14px;
	  color: #818181;
	  display: block;
	}

	.sidenav img{
	  padding: 0px;
	  margin: 20px;
	  width: 50%;
	  border-radius: 50%;
	  display: block;
	}

	.sidenav a:hover {
	  color: #f1f1f1;
	}

	#profile_name{
	  padding-bottom: 30px;
	}


	.main {
	  margin-top: 50px;
	  margin-left: 200px; /* Same as the width of the sidenav */
	  font-size: 14px; /* Increased text to enable scrolling */
	  padding: 50px 10px;
	}

	@media screen and (max-height: 450px) {
	  .sidenav {padding-top: 15px;}
	  .sidenav a {font-size: 18px;}
	}

	.navbar {
	  padding-left: 200px;
	  overflow: hidden;
	  background-color: white;
	  border:1px solid grey;
	  position: fixed;
	  top: 0;
	  width: 100%;
	  font-weight: bolder;
	}

	.navbar a {

	  float: right;
	  display: block;
	  color: black;
	  text-align: center;
	  padding: 10px 50px;
	  text-decoration: none;
	  font-size: 13px;
	}

	.navbar .logout:hover {
	  float: right;
	  background: #ddd;
	  color: black;
	}

	.title{
	  font-weight: bold;
	  font-size: 20px;

	}
	.sub_title{
	  font-size: 15px;
	  font-weight: normal;
	}

	</style>
</head>
<body>

	<div class="sidenav">
	  <!-- <img src="cover.jpg"> -->
	  <a class="main_link" id="profile_name" href="#profile">John Paul P. Montilla (Admin)</a>
	  <a class="main_link" href="#about">Dashboard</a>
	  <a class="main_link" href="/roles">User Management</a>
	  <a class="sub_link" href="/roles">Roles</a>
	  <a class="sub_link" href="#services">User</a>
	  <a class="main_link" href="/category">Expense Management</a>
	  <a class="sub_link" href="/category">Expense Category</a>
	  <a class="sub_link" href="#clients">Expenses</a>
	</div>

	<div class="navbar">
	  <a>Welcome to Expense Manager</a>
	  <a class="logout" style="float: right;" href="#logout">Logout</a>
	</div>

	<div class="container">
		<div class="main">
	 		@yield('mainContent')
		</div>
	</div>

</body>
</html>