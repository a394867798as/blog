<!DOCTYPE html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>文章--@yield('title')</title>
<link rel='stylesheet' href="/css/all.css" type='text/css' media='all'/>
<link rel='stylesheet' href="/css/app.css" type='text/css' media='all'/>
    <script type='text/javascript' src="/js/all.js"></script>
    <script type='text/javascript' src="/js/app.js"></script>
</head>
<body>
<div class="container">
    <section class="content">
        <div class="pad group">
            @yield('content')
        </div>
    </section>
</div>
</body>
</html>