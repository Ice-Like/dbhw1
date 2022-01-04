<?php

function head($title,$other=null){
  echo '
  <!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.88.1">
      <title>'.$title.'</title>
  
      <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
      ';

      echo $other;

      echo '
      
  
      <!-- Bootstrap core CSS -->
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  
      <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }
  
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>
  
      
      <!-- Custom styles for this template -->
      <link href="sidebars.css" rel="stylesheet">
      <link href="grid.css" rel="stylesheet">
    </head>
    <body>';
}

function menu($username,$select='home'){
echo '

        
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="bootstrap" viewBox="0 0 118 94">
        <title>Bootstrap</title>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
      </symbol>
      <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
      </symbol>
      <symbol id="speedometer2" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
      </symbol>
      <symbol id="table" viewBox="0 0 16 16">
        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
      </symbol>
      <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </symbol>
      <symbol id="grid" viewBox="0 0 16 16">
        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
      </symbol>
      <symbol id="collection" viewBox="0 0 16 16">
        <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
      </symbol>
      <symbol id="calendar3" viewBox="0 0 16 16">
        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
      </symbol>
      <symbol id="chat-quote-fill" viewBox="0 0 16 16">
        <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z"/>
      </symbol>
      <symbol id="cpu-fill" viewBox="0 0 16 16">
        <path d="M6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
        <path d="M5.5.5a.5.5 0 0 0-1 0V2A2.5 2.5 0 0 0 2 4.5H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2v1H.5a.5.5 0 0 0 0 1H2A2.5 2.5 0 0 0 4.5 14v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14h1v1.5a.5.5 0 0 0 1 0V14a2.5 2.5 0 0 0 2.5-2.5h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14v-1h1.5a.5.5 0 0 0 0-1H14A2.5 2.5 0 0 0 11.5 2V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5a.5.5 0 0 0-1 0V2h-1V.5zm1 4.5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3A1.5 1.5 0 0 1 6.5 5z"/>
      </symbol>
      <symbol id="gear-fill" viewBox="0 0 16 16">
        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
      </symbol>
      <symbol id="speedometer" viewBox="0 0 16 16">
        <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
      </symbol>
      <symbol id="toggles2" viewBox="0 0 16 16">
        <path d="M9.465 10H12a2 2 0 1 1 0 4H9.465c.34-.588.535-1.271.535-2 0-.729-.195-1.412-.535-2z"/>
        <path d="M6 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm.535-10a3.975 3.975 0 0 1-.409-1H4a1 1 0 0 1 0-2h2.126c.091-.355.23-.69.41-1H4a2 2 0 1 0 0 4h2.535z"/>
        <path d="M14 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/>
      </symbol>
      <symbol id="tools" viewBox="0 0 16 16">
        <path d="M1 0L0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.356 3.356a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 0 0-1.414l-3.356-3.356a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0zm9.646 10.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708zM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11z"/>
      </symbol>
      <symbol id="chevron-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
      </symbol>
      <symbol id="geo-fill" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
      </symbol>
    </svg>
    
    <main>
    
      <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
        <a href="home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <img src="data:image/png;base64,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" alt="" width="32" height="32" class="rounded-circle me-2">
          <span class="fs-4">內部管理系統</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">'
          .(
            ($select=='home') ? 
              '<a href="home.php" class="nav-link active" aria-current="page">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
              首頁
              </a>' : 
              '<a href="home.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
              首頁
              </a>'
          ).
          '
          </li>
          <li>'
          
          .(
            ($select=='dept') ? 
              '<a href="dept.php" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                部門管理
              </a>':
              '<a href="dept.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
                部門管理
              </a>'
          ).'
          </li>
          <li>'
          
          .(
            ($select=='employee') ? 
              '<a href="employee.php" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                員工管理
              </a>':
              '<a href="employee.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                員工管理
              </a>'
          ).'
          </li>
          <li>
          '
          
          .(
            ($select=='orderdetail') ? 
              '<a href="orderdetail.php" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                訂單管理
              </a>':
              '<a href="orderdetail.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                訂單管理
              </a>'
          ).'
          </li>
          <li>
          '
          
          .(
            ($select=='product') ? 
              '<a href="product.php" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                產品管理
              </a>':
              '<a href="product.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                產品管理
              </a>'
          ).'
          </li>
          <li>
          '
          
          .(
            ($select=='customer') ? 
              '<a href="customer.php" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                客戶管理
              </a>':
              '<a href="customer.php" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                客戶管理
              </a>'
          ).'
          </li>
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/000/550/980/small/user_icon_001.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong> '.$username.'</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="info.php">個人資料</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="index.php">登出</a></li>
          </ul>
        </div>
      </div>
    
      <div class="b-example-divider"></div>
    ';
}



    function footer($script_other=null){
    
    echo '</main>';
    echo $script_other;
    echo '
      
        <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
    
          <script src="sidebars.js"></script>
      </body>
    </html>
';
        }
?>