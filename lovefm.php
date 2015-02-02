<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>永不止息，需要有你！FM77</title>

    <!-- Bootstrap -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script type="text/javascript" src="script/soundmanager2.js"></script>
<script src="script/bar-ui.js"></script>
<link rel="stylesheet" href="css/bar-ui.css" />

<!-- demo for this page only, you don't need this stuff -->
<!-- <script src="script/demo.js"></script> -->
<link rel="stylesheet" href="css/demo.css" />

  </head>
  <body>
   
    <h1>liangyou</h1>

<!-- http://www.ucuc.hk/ -->
<div class="container-fluid">
  <img src="pray01.png" class="img-responsive" alt="Responsive image">
  如果不能播放，记得点击顶部“在浏览器中打开”哦！
</div> 





<!-- fixed, bottom-aligned, full-width player -->

<div class="sm2-bar-ui full-width fixed">

 <div class="bd sm2-main-controls">

  <div class="sm2-inline-texture"></div>
  <div class="sm2-inline-gradient"></div>

  <div class="sm2-inline-element sm2-button-element">
   <div class="sm2-button-bd">
    <a href="#play" class="sm2-inline-button play-pause">Play / pause</a>
   </div>
  </div>

  <div class="sm2-inline-element sm2-inline-status">

   <div class="sm2-playlist">
    <div class="sm2-playlist-target">
      <ul class="sm2-playlist-bd"><li><b>书香原地</b> - 刘文 (20141219)<span class="label">主播</span></li></ul></div>
   </div>

   <div class="sm2-progress">
    <div class="sm2-row">
    <div class="sm2-inline-time">0:00</div>
     <div class="sm2-progress-bd">
      <div class="sm2-progress-track">
       <div class="sm2-progress-bar"></div>
       <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
      </div>
     </div>
     <div class="sm2-inline-duration">0:00</div>
    </div>
   </div>

  </div>


  <div class="sm2-inline-element sm2-button-element sm2-menu">
   <div class="sm2-button-bd">
    <a href="#menu" class="sm2-inline-button menu">menu</a>
   </div>
  </div>

 </div>

 <div class="bd sm2-playlist-drawer sm2-element">

  <div class="sm2-inline-texture">
   <div class="sm2-box-shadow"></div>
  </div>

  <!-- playlist content is mirrored here -->

  <div class="sm2-playlist-wrapper">
    <ul class="sm2-playlist-bd">
    <?php
      $file_key = 'http://liangyou.yongbuzhixi.com/cron/nzzlist/'. date('Ymd') . '.json';
      $file = file_get_contents($file_key);
      $urls = json_decode($file,TRUE);
      $count = 0;
      foreach ($urls as $url => $value) {

      if(isset($value['mp3_link'])){
        // $id = str_replace('url.asp?id=', '', $url);
        $title = $value['title'];
        $mp3_link = $value['mp3_link'];
        // $desc = '公众号：永不止息 '.date('md');
        ?>
        <li<?php if(!$count) echo ' class="selected"';?>><a href="<?php echo $mp3_link;?>"><b>良友电台</b><span class="label"><?php echo $title. date('Ymd');?>"></span></a></li>
        <?php
        $count++;
        // $menu .= '【'.$id.'】'.$title."<br/>";
      }
        // break;
    }
    ?>
    </ul>
  </div>

 </div>

</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  </body>
</html>
