<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Realtime Chat</title>
  <link rel="stylesheet" href="style.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
  html,body{
      font-family: 'Poppins', sans-serif;
  }
  
  body {
      overflow: hidden;
  }

  .toast.fade {
    transition: all 1.5s ease !important;
  }
  
  a, a:hover, a:focus, a:active {
      text-decoration: none;
      color: inherit;
  }
  
  .popover-header {
      text-align: center;
      padding: 15px !important;
  }
  
  .notif-old {
      filter: opacity(.6);
  }
  
  .notif-text {
      font-size: .9rem;
  }
  
  .notif-date {
      font-size: .8rem;
  }
  /* linear-gradient(0deg, rgba(0,0,0,0.49933476808692223) 0%, rgba(255,255,255,0) 100%) */
  #gif {
  z-index: 0;
	position: fixed;
	right: 0;
	bottom: 0;
	min-width: 100%;
	min-height: 100%;
	opacity: .5;
  z-index: -2;
  }
</style>
</head>