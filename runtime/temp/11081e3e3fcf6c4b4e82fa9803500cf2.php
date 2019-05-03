<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\phpStudy\PHPTutorial\WWW\chat\public/../application/index\view\index\lists.html";i:1550323867;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">-->
    <meta name="format-detection" content="telephone=no" />
    <title>沟通中</title>
    <link rel="stylesheet" type="text/css" href="http://www.chat.com/static/index/newcj/css/themes.css?v=2017129">
    <link rel="stylesheet" type="text/css" href="http://www.chat.com/static/index/newcj/css/h5app.css">
    <link rel="stylesheet" type="text/css" href="http://www.chat.com/static/index/newcj/fonts/iconfont.css?v=2016070717">
    <link rel="stylesheet" type="text/css" href="http://www.chat.com/static/index/newcj/css/chat_list.css">
    <script src="http://www.chat.com/static/index//newcj/js/jquery.min.js"></script>
    <script src="http://www.chat.com/static/index/newcj/js/dist/flexible/flexible_css.debug.js"></script>
    <script src="http://www.chat.com/static/index/newcj/js/dist/flexible/flexible.debug.js"></script>

	<!--引入QQ表情-->
	<script src="http://www.chat.com/static/index/qqFace/js/jquery.qqFace.js"></script>
	<style>
		.qqFace { margin-top: -180px; background: #fff; padding: 2px; border: 1px #dfe6f6 solid; }
		.qqFace table td { padding: 0px; }
		.qqFace table td img { cursor: pointer; border: 1px #fff solid; }
		.qqFace table td img:hover { border: 1px #0066cc solid; }
	</style>
	<!--引入QQ表情-->

</head>
<body>
<div class='fui-page-group'>
    <div class="fui-statusbar"></div>
<div class='fui-page chat-page'>
	<div class="fui-header">
	    <div class="title">消息列表</div>
	    <div class="fui-header-right"></div>
	</div>

	<div class="fui-content navbar chat-fui-content" style="padding-bottom: 2rem;">
		<div class="chat-list flex" >

			<div class="chat-img"  style="background-image: url('http://www.hwqugou.cn/img/555.jpg')">
				<span class="badge" style="top: -0.1rem;left: 80%;">1</span>
			</div>
			<div class="chat-info">
				<p class="chat-merch flex">
					<span class="title t-28">魔力克</span>
					<span class="time">2017-12-14</span>
				</p>
				<p class="chat-text singleflow-ellipsis">你好</p>
			</div>
		</div>
	</div>
</div>
</div>
</body>
<script>

    var API_URL =   "http://www.chat.com/index.php/api/chat/";

    var fromid  =	"<?php echo $fromid; ?>";

    var ws		=	new WebSocket("ws://127.0.0.1:8282");

    ws.onmessage	=	function(e){
        //解析数据
        var message		=	eval("("+e.data+")");

        //连接socket服务器，当收到消息时实时更新消息列表
        switch (message.type){
			case 'init':
			    //绑定当前用户uid
                var bind    =   '{"type":"bind","fromid":"'+fromid+'"}';
                ws.send(bind);
                list();
                return;
                //收到消息更新消息列表
			case 'text':
			    $(".chat-fui-content").html('');
			    list();
			    return;
            //收到消息更新消息列表
			case 'say_img':
                $(".chat-fui-content").html('');
                list();
                return;
		}

	}

    //获取用户消息列表，更新消息列表,渲染数据
	function list(){
        $.post(
            API_URL+"getList",
            {id:fromid},
            function(res){
                console.log(res);

                $.each(res,function (index,content) {
                    //1已读，0未读，未读消息进行标记，已读不标记
                    if (content.countNoRead == 0){
                        $(".chat-fui-content").append('<div onclick=redi("'+content.chatPage+'") class="chat-list flex" >\n' +
                            '\n' +
                            '\t\t\t<div class="chat-img"  style="background-image: url(\''+content.headUrl+'\')">\n' +
                            '\t\t\t</div>\n' +
                            '\t\t\t<div class="chat-info">\n' +
                            '\t\t\t\t<p class="chat-merch flex">\n' +
                            '\t\t\t\t\t<span class="title t-28">'+content.userName+'</span>\n' +
                            '\t\t\t\t\t<span class="time">'+mydate(content.time)+'</span>\n' +
                            '\t\t\t\t</p>\n' +
                            '\t\t\t\t<p class="chat-text singleflow-ellipsis">'+replace_em(content.lastMessage)+'</p>\n' +
                            '\t\t\t</div>\n' +
                            '\t\t</div>');
                    } else{
                        $(".chat-fui-content").append('<div onclick=redi("'+content.chatPage+'") class="chat-list flex" >\n' +
                            '\n' +
                            '\t\t\t<div class="chat-img"  style="background-image: url(\''+content.headUrl+'\')">\n' +
                            '\t\t\t\t<span class="badge" style="top: -0.1rem;left: 80%;">'+content.countNoRead+'</span>\n' +
                            '\t\t\t</div>\n' +
                            '\t\t\t<div class="chat-info">\n' +
                            '\t\t\t\t<p class="chat-merch flex">\n' +
                            '\t\t\t\t\t<span class="title t-28">'+content.userName+'</span>\n' +
                            '\t\t\t\t\t<span class="time">'+mydate(content.time)+'</span>\n' +
                            '\t\t\t\t</p>\n' +
                            '\t\t\t\t<p class="chat-text singleflow-ellipsis">'+replace_em(content.lastMessage)+'</p>\n' +
                            '\t\t\t</div>\n' +
                            '\t\t</div>');
                    }

                })
            },'json'
        );
	}




    /**
     *根据时间戳格式化为日期形式
     */
    function mydate(nS){

        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
    }

    /**
	 * 页面跳转
     */
	function redi(url) {
		window.location.href=url;
    }


    //查看结果,收到表情特殊字符后替换表情字符成表情GIF,如未匹配到表情，则返回原来的字符串
    function replace_em(str){

        str = str.replace(/\</g,'&lt;');

        str = str.replace(/\>/g,'&gt;');

        str = str.replace(/\n/g,'<br/>');

        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="http://www.chat.com/static/index/qqFace/arclist/$1.gif" border="0" />');

        return str;

    }
</script>

</html>
