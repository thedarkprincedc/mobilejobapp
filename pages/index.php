<!DOCTYPE html>
<html lang="en" ng-app="MobileJobApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobile Job App</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
    <!-- Optional theme -->
	<link href="libs/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link rel="stylesheet" href="content/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!--
  	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	      <div class="container">
		        <div class="navbar-header" >
		          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bs-example-modal-sm">
		          	<b><span style="color:#5555EE;">Pi</span>Sync</b>
		          		
		          </a>
		        </div>
		        <div class="navbar-collapse collapse">
		          	<ul class="nav navbar-nav">
		          		<li>
		          			<a href="#accounts">Accounts</a>
		          		</li>
		          		<li>
		          			<a href="#devices">Devices</a>
		          		</li>
		          		<li>
		          			<a href="#download_queue">Download Queue</a>
		          		</li>
		          		<li ng-repeat="menu_item in menu"><a href="#{{menu_item.path}}">{{menu_item.name}}</a></li>
		          	</ul>
					<form class="navbar-form navbar-right" role="search">
						<!--<div class="form-group">
							<input type="text" class="form-control" id="search_field" name="search_field" x-webkit-speech placeholder="Search">
						</div>
						
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#login" ng-hide="">Login</a></li>
						<li><a href="#logout" ng-hide="">Logout</a></li>
					</ul>
		        </div><!--/.nav-collapse
	      </div>
    </div>
    --><br/>
    <!--div class="container"> <div class="logo"><img src="content/logo.gif" /></div><br/></div>-->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    	&nbsp;&nbsp;&nbsp;
    	<img src="content/logo.gif" />
    	
    </div>
   
	<div ng-view></div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- dev -->
    <!--<script src="libs/jquery-1.11.2.js"></script>
    <script src="libs/angular/angular.js"></script>
	<script src="libs/angular/angular-route.js"></script> 
	<script src="libs/angular/angular-resource.js"></script> 
	<script src="libs/angular/angular-sanitize.js"></script>-->
	<!-- Prod -->
	<script src="libs/jquery-1.11.2.min.js"></script>
    <script src="libs/angular/angular.min.js"></script>
	<script src="libs/angular/angular-route.min.js"></script> 
	<script src="libs/angular/angular-resource.min.js"></script> 
	<script src="libs/angular/angular-sanitize.min.js"></script> 
	
	<script src="js/app.js"></script>
	<script src="js/controller.js"></script>
	<script src="partials/joblistings_controller.js"></script>
	<script src="partials/admin_controller.js"></script>
	<script src="js/services.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="libs/bootstrap/js/bootstrap.js"></script>
  </body>
</html>