<!DOCTYPE html>
<html lang="eng">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Handles CSRF token for requests automatically -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Laravel+Vue To-Do App</title>
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans|Space+Mono" rel="stylesheet">
</head>
<style>
	body {
		font-family: "Fira Sans", sans-serif;
	}
</style>
<body>
	<div id="main">
  <!-- HTML will be auto-injected here -->
	</div>
	<script src="/js/app.js"></script>
</body>
</html>