<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 파비콘 -->
  <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <link rel="stylesheet" href="/assets/css/tailwind.css">

  <title>
    <?php echo $title; ?>
  </title>
</head>

<body class="bg-gray-100 min-h-screen h-full h-full flex flex-col">

  <div class="bg-white w-full border-b border-gray-200">
    <a href="/admin" class="flex items-center justify-center font-black text-point1 py-4">
      TOGO ADMIN
    </a>
  </div>

  <div class="flex flex-1">
    <nav class="w-64 flex flex-col items-center justify-start bg-white">
      <a class="flex items-center mt-4" href="/admin/member/list">
        <span class="mx-3">회원  관리</span>
      </a>

      <a class="flex items-center mt-4" href="/admin/campaign/list">
        <span class="mx-3">캠페인 관리</span>
      </a>

      <a class="flex items-center mt-4" href="/admin/wallet/list">
        <span class="mx-3">출금 관리</span>
      </a>
    </nav>

    <div class="container mx-auto py-8">
      <?php
      if($title) {
      ?>
      <h1 class="inline text-2xl font-semibold leading-none"><?php echo $title; ?></h1>
      <?php
      }
      ?>