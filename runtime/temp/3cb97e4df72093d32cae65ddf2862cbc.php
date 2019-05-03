<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"C:\phpStudy\PHPTutorial\WWW\chat\public/../application/index\view\index\index.html";i:1550324058;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <title>沟通中</title>
    <link rel="stylesheet" type="text/css" href="http://www.chat.com/static/index/newcj/css/themes.css?v=2017129">
    <link rel="stylesheet" type="text/css" href="http://www.chat.com/static/index/newcj/css/h5app.css">
    <link rel="stylesheet" type="text/css" href="http://www.chat.com/static/index/newcj/fonts/iconfont.css?v=2016070717">
    <script src="http://www.chat.com/static/index/newcj/js/jquery.min2.js"></script>
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
<body ontouchstart>
<div class='fui-page-group'>
<div class='fui-page chatDetail-page'>
    <div class="chat-header flex">
        <i class="icon icon-toleft t-48"></i>
        <span class="shop-titlte t-30">商店</span>
        <span class="shop-online t-26"></span>
        <span class="into-shop">进店</span>
    </div>
    <div class="fui-content navbar" style="padding:1.2rem 0 1.35rem 0;">
        <div class="chat-content">
            <p style="display: none;text-align: center;padding-top: 0.5rem" id="more"><a>加载更多</a></p>
            <p class="chat-time"><span class="time">2017-11-12</span></p>

            <div class="chat-text section-left flex">
            <span class="char-img" style="background-image: url(http://www.chat.com/static/index/newcj/img/123.jpg)"></span>
            <span class="text"><i class="icon icon-sanjiao4 t-32"></i>你好</span>
             </div>

            <div class="chat-text section-right flex">
            <span class="text"><i class="icon icon-sanjiao3 t-32"></i>你好</span>
            <span class="char-img" style="background-image: url(http://www.chat.com/static/index/newcj/img/132.jpg)"></span>
           </div>

        </div>
    </div>
    <div class="fix-send flex footer-bar">
        <i class="icon icon-emoji1 t-50"></i>
        <input id="saytext" class="send-input t-28" maxlength="200">
        <input type="file" name="file" id="file" style="display: none">
        <i class="icon icon-add image_up t-50" style="color: #888;"></i>
        <span class="send-btn">发送</span>
    </div>
</div>
</div>

</body>
</html>
<script>
    //当前登录用户的uid
    var fromId  =   "<?php echo $fromid; ?>";

    //当前用户发送消息给另一个用户的uid（接收消息方的uid）
    var toid    =   "<?php echo $toid; ?>";

    //获取当前登录用户的头像
    var from_head   =   '';

    //获取对端用户的头像
    var to_head     =   '';

    //获取对端用户的昵称
    var to_name     =   '';

    var online      =   0;

    //处理数据接口
    var API_URL =   "http://www.chat.com/index.php/api/chat/";

    //new一个ws对象
    var ws = new WebSocket("ws://127.0.0.1:8282");
    ws.onmessage    =   function(e){
        //接收解析服务器发送得消息
        var message =   eval("("+e.data+")");
        switch (message.type)
        {
            //当类型为init时，则为首次链接需要绑定用户的uid以便实现点对点连接
            case 'init':
                var bind    =   '{"type":"bind","fromid":"'+fromId+'"}';
                ws.send(bind);
                //获取当前用户与聊天用的头像
                get_head(fromId,toid);
                //获取对端用户的昵称
                get_name(toid);
                //页面初始化，向服务器请求聊天记录消息
                message_load(fromId,toid);
                //初始化判断对端用户是否在线
                var online  =   '{"type":"online","toid":"'+toid+'","fromid":"'+fromId+'"}';
                ws.send(online);
                //当聊天页面初始化时把所有未读消息改成已读
                changeNoRead();
                break;

            //服务器返回的普通文本消息
            case 'text':
                //如果当前绑定的toid会等于接收消息传过来的fromid,则为给当前fromid发送得消息
                if(toid == message.fromid)
                {
                    //向.chat-content容器追加左侧非自己发送得消息
                    $(".chat-content").append(' <div class="chat-text section-left flex">\n' +
                        '            <span class="char-img" style="background-image: url('+to_head+')"></span>\n' +
                        '            <span class="text"><i class="icon icon-sanjiao4 t-32"></i>'+replace_em(message.data)+'</span>\n' +
                        '             </div>');
                    //把页面消息定位到最底部，无须下拉查看最新消息
                    $(".chat-content").scrollTop(3000);
                }
                //当在聊天页面并收到消息时把所有未读消息改成已读
                changeNoRead();
                break;

                //消息持久化，保存消息值数据库
            case 'save':
                save_message(message);
                //发送消息时，服务器返回isread判断用户是否在线，实时更新状态
                if (message.isread == 1){
                    online  =   1;
                    $(".shop-online").text('在线');
                } else{
                    online  =   0;
                    $(".shop-online").text('离线');
                }
                break;

            case 'say_img':
                //向.chat-content容器追加左侧非自己发送得消息
                $(".chat-content").append(' <div class="chat-text section-left flex">\n' +
                    '            <span class="char-img" style="background-image: url('+to_head+')"></span>\n' +
                    '            <span class="text"><i class="icon icon-sanjiao4 t-32"></i><img width="120" height="120" src="/static/uploads/'+message.img_name+'"></span>\n' +
                    '             </div>');
                //把页面消息定位到最底部，无须下拉查看最新消息
                $(".chat-content").scrollTop(3000);
                //当在聊天页面并收到图片消息时把所有未读消息改成已读
                changeNoRead();
                break;

                //判断用户是否在线
            case 'online':
                console.log(message,'online----');
                if (message.status == 1){
                    online  =   1;
                    $(".shop-online").text('在线');
                }else{
                    online  =   0;
                    $(".shop-online").text('离线');
                }
                break;
        }
        console.log(message);
    }

    $(".send-btn").click(function(){
        var text    =   $(".send-input").val();
        if (text == ''){
            return;
        }
        var message =   '{"data":"'+text+'","type":"say","fromid":"'+fromId+'","toid":"'+toid+'"}';
        //点击为自己发送得消息在右侧
        $(".chat-content").append('<div class="chat-text section-right flex">\n' +
            '            <span class="text"><i class="icon icon-sanjiao3 t-32"></i>'+replace_em(text)+'</span>\n' +
            '            <span class="char-img" style="background-image: url('+from_head+')"></span>\n' +
            '           </div>');
        //把页面消息定位到最底部，无须下拉查看最新消息
        $(".chat-content").scrollTop(3000);
        ws.send(message);
        $(".send-input").val('');
    });

    //发送post请求把所有未读消息变成已读
    function changeNoRead(){
        $.post(
            API_URL +   'changeNoRead',
            {"fromid":fromId,"toid":toid},
            function () {

            },
            'json'
        );
    }


    //ajax请求数据持久化
    function save_message(message){
        $.post(
            API_URL+"saveMessage",
            message,
            function () {
                //请求成功。。。
            },
            'json'
        )
    }

    //获取用户头像
    function get_head(fromid,toid)
    {
        $.post(
            API_URL+"getHead",
            {"fromid":fromid,"toid":toid},
            function (e) {
                from_head   =   e.from_head;
                to_head     =   e.to_head;
                console.log(e);
            },
            "json"
        )
    }

    //获取用户昵称
    function get_name(toid) {
        $.post(
            API_URL +   "get_name",
            {"toid":toid},
            function (e) {
                to_name =   e.toName;
                $(".shop-titlte").text('与'+to_name+'聊天中...');
                console.log(e);
            },
            "json"
        )
    }

    //页面初始化，请求服务器聊天记录
    function message_load(fromid,toid){
        $.post(
            API_URL +   'load',
            {"fromid":fromid,'toid':toid},
            function (e) {
                console.log(e);
                //循环返回的消息数据
                $.each(e,function (index,content) {
                    //自己的消息在右侧,别人的左侧
                    if (fromid == content.fromid) {
                        //判断是文本类型消息或者图片类型消息
                        if (content.type == 1){
                            //自己发送得文本消息在右侧,1为文本，2为图片
                            $(".chat-content").append('<div class="chat-text section-right flex">\n' +
                                '            <span class="text"><i class="icon icon-sanjiao3 t-32"></i>'+replace_em(content.content)+'</span>\n' +
                                '            <span class="char-img" style="background-image: url('+from_head+')"></span>\n' +
                                '           </div>');
                        }else{
                            //点击为自己发送得图片消息在右侧
                            $(".chat-content").append('<div class="chat-text section-right flex">\n' +
                                '            <span class="text"><i class="icon icon-sanjiao3 t-32"></i><img width="120" height="120" src="/static/uploads/'+content.content+'"></span>\n' +
                                '            <span class="char-img" style="background-image: url('+from_head+')"></span>\n' +
                                '           </div>');
                        }

                    }else{
                        //判断是文本类型消息或者图片类型消息，1为文本，2为图片
                        if (content.type == 1){
                            //别人发送得消息在左侧
                            $(".chat-content").append(' <div class="chat-text section-left flex">\n' +
                                '            <span class="char-img" style="background-image: url('+to_head+')"></span>\n' +
                                '            <span class="text"><i class="icon icon-sanjiao4 t-32"></i>'+replace_em(content.content)+'</span>\n' +
                                '             </div>');
                        } else{
                            //别人发送得消息在左侧
                            $(".chat-content").append(' <div class="chat-text section-left flex">\n' +
                                '            <span class="char-img" style="background-image: url('+to_head+')"></span>\n' +
                                '            <span class="text"><i class="icon icon-sanjiao4 t-32"></i><img width="120" height="120" src="/static/uploads/'+content.content+'"></span>\n' +
                                '             </div>');
                        }

                    }
                })
                //把页面消息定位到最底部，无须下拉查看最新消息
                $(".chat-content").scrollTop(3000);
            },
            "json"
        )
    }

    //点击加号触发#file的单击事件
    $(".image_up").click(function () {
        $("#file").click();
    })
    //当#file值发生改变的时候触发函数,发送图片
    $("#file").change(function () {
        console.log($("#file")[0].files);
        //new一个form表单数据对象
        formdata    =   new FormData();
        //在对象里添加数据
        formdata.append('fromid',fromId);
        formdata.append('toid',toid);
        formdata.append('online',online);
        //查找#file的文件值
        formdata.append('file',$("#file")[0].files[0]);
        $.ajax({
            url     :   API_URL + "uploadimg",
            type    :   "POST",
            //不缓存
            cache   :   false,
            //数据类型为formdata类型
            data    :   formdata,
            dataType:   "json",
            //把数据转换成对象类型
            processData :   false,
            //是否进行url编码
            contentType :   false,
            success:function (data,status,xhr) {

                if (data.status == 'ok'){
                    //为自己发送得消息在右侧,添加图片消息
                    $(".chat-content").append('<div class="chat-text section-right flex">\n' +
                        '            <span class="text"><i class="icon icon-sanjiao3 t-32"></i><img width="120" height="120" src="/static/uploads/'+data.img_name+'"></span>\n' +
                        '            <span class="char-img" style="background-image: url('+from_head+')"></span>\n' +
                        '           </div>');
                    //把页面消息定位到最底部，无须下拉查看最新消息
                    $(".chat-content").scrollTop(3000);

                    var message =   '{"data":"'+data.img_name+'","fromid":"'+fromId+'","toid":"'+toid+'","type":"say_img"}';
                    ws.send(message);
                    //发送成功则把附件值置空
                    $("#file").val('');
                }else{
                    console.log(data.status);
                }
            }
        });
    })

    //页面加载触发函数，引入表情列表
    $(function(){

        $('.icon-emoji1').qqFace({

            //表情输入在那个输入框，则该输入框需要设置id为saytext
            assign:'saytext',

            path:'http://www.chat.com/static/index/qqFace/arclist/'	//表情存放的路径

        });

        $(".sub_btn").click(function(){

            var str = $("#saytext").val();

            $("#show").html(replace_em(str));

        });

    });

    //查看结果,收到表情特殊字符后替换表情字符成表情GIF,如未匹配到表情，则返回原来的字符串
    function replace_em(str){

        str = str.replace(/\</g,'&lt;');

        str = str.replace(/\>/g,'&gt;');

        str = str.replace(/\n/g,'<br/>');

        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="http://www.chat.com/static/index/qqFace/arclist/$1.gif" border="0" />');

        return str;

    }
</script>
