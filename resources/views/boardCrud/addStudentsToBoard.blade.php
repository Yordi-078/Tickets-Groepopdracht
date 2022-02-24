@extends('layouts.app')

<body class="searchStudents">

  <form style="transform:translate(-50%, -50%);" action="{{ route('search' , $board_id) }}" type="get" class="search-bar">
    <h1>Click here to search for students</h1>
	  <input type="search" name="query" type="search" placeholder="Search" pattern=".*\S.*" required>
  	<button class="search-btn" type="submit">
		  <span><i class="fa-solid fa-magnifying-glass"></i></span>
	  </button>
  </form> 
  
</body>