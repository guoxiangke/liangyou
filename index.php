<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>良友直播|公众号：永不止息</title>

    <!-- Bootstrap -->
    <link href="http://libs.useso.com/js/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
	    body {
				background: #2980b9;
				color: #fff;
				font-family: '微软雅黑','Lato', Arial, sans-serif;
			}
			#playlist li{
				margin-bottom: 15px;	
			}			

			#playlist{
				padding:20px;
				padding-left: 0;
			}
			audio{
				width: 100%;
				font-family: 微软雅黑;
				font-size: 20px;
				text-decoration: none;
			}
			.active a{text-decoration:none;}
			li a{padding:5px;display:block;}
			li a:hover{text-decoration:none;}
		</style>
  </head>
  <body>
  	<div class="container-fluid">

			<div class="hidden-lg">
				<p class="bg-primary">点击右上角，在浏览器中打开即可后台播放！</p>
			</div>

	    <h1>Hello, LY!</h1>
	    
	    <audio id="audio" preload="auto" tabindex="0" controls type="audio/mpeg">
	        <source type="audio/mp3" src="http://www.cloud-audio.com/get_stream/ee6a0e-11b17b">
	        小永提示：不好意思！您的浏览器不支持，建议下载猎豹浏览器浏览本页面.
	    </audio>
	    <div class="hidden-xs">
		    <p>已加载:</p>
				<div class="progress">
				  <div id="valuenow" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%">
				    <span>0</span>%
				  </div>
				</div>
				<p>已播放: <span></span>%</p>				
			</div>
			<p id="bg-info"></p>
	    <ul id="playlist">
	    	<?php
	      $file_key = 'http://liangyou.yongbuzhixi.com/cron/cloud/'.date('Ymd').'.json';
	      // $file_key = 'http://liangyou.yongbuzhixi.com/cron/cloud/20150123.json';      
	      $file = file_get_contents($file_key);
	      $urls = json_decode($file,TRUE);
	      $count = 0;
	      foreach ($urls as $url => $value) {

	      if(isset($value['url'])){
	        // $id = str_replace('url.asp?id=', '', $url);
	        $title = $value['title'];
	        $mp3_link = $value['url'];
	        $desc = $value['desc'];
	        // $desc = '公众号：永不止息 '.date('md');
	        ?>
	        <li  class="btn btn-default" role="button" <?php if(!$count) echo ' class="active"';?>>
	        	<a href="<?php echo $mp3_link;?>"><?php echo $title;?></a>
	        	<p class="bg-info hidden"><?php echo $desc;?></p>
	        </li>
	        
	        <?php
	        $count++;
	        // $menu .= '【'.$id.'】'.$title."<br/>";
	      }
	        // break;
	    }
	    ?>
	    </ul>
	    <a href="http://t.cn/RZnnldY"><img src="http://liangyou.u.qiniudn.com/qrcode_for_gh_c2138e687da3_258.jpg"></a>
	    <p>Powered by： <a style="color:#000" href="http://t.cn/RZnnldY">永不止息</a></p>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://libs.useso.com/js/jquery/1.9.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<script type="text/javascript">
			var audio;
			var playlist;
			var tracks;
			var current;

			init();
			function init(){
			    current = 0;
			    audio = $('audio');
			    playlist = $('#playlist');
			    tracks = playlist.find('li a');
			    len = tracks.length - 1;
			    audio[0].volume = .10;
			    audio[0].play();
			    playlist.find('a').click(function(e){
			        e.preventDefault();
			        link = $(this);
			        current = link.parent().index();
			        $('#bg-info').html(link.parent().find('.bg-info').html());
			        $('h1').html(link.html());		
			        $('html, body').animate({ scrollTop: 0 }, 'fast');	        
			        run(link, audio[0]);
			    });
			    audio[0].addEventListener('ended',function(e){
			        current++;
			        if(current == len){
			            current = 0;
			            link = playlist.find('a')[0];
			        }else{
			            link = playlist.find('a')[current];    
			        }
			        run($(link),audio[0]);
			    });
			}
			function run(link, player){
			        player.src = link.attr('href');
			        par = link.parent();
			        par.addClass('active').siblings().removeClass('active');
			        audio[0].load();
			        audio[0].play();
			}

			var audio2 = document.querySelector('audio');
			var percentages = document.querySelectorAll('span');

			function loop() {
			  var buffered = audio2.buffered;
			  var loaded;
			  var played;

			  if (buffered.length) {
			    loaded = 100 * buffered.end(0) / audio2.duration;
			    played = 100 * audio2.currentTime / audio2.duration;
			    percentages[0].innerHTML = loaded.toFixed(2);
			    $('#valuenow').attr('valuenow',loaded.toFixed(2));			    
			    $('#valuenow').attr('style','width: ' + loaded.toFixed(0) + '%');
			    percentages[1].innerHTML = played.toFixed(2);
			  }

			  setTimeout(loop, 50);
			}

			loop();
		</script>
  </body>
</html>