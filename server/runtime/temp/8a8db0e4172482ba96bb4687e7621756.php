<?php /*a:1:{s:47:"/server/application/index/view/index/index.html";i:1574477960;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <title>沟通中</title>
    <link rel="stylesheet" type="text/css" href="../static/newcj/css/themes.css?v=2017129">
    <link rel="stylesheet" type="text/css" href="../static/newcj/css/h5app.css">
    <link rel="stylesheet" type="text/css" href="../static/newcj/fonts/iconfont.css?v=2016070717">
    <script src="../static/newcj/js/jquery.min.js"></script>
    <script src="../static/newcj/js/dist/flexible/flexible_css.debug.js"></script>
    <script src="../static/newcj/js/dist/flexible/flexible.debug.js"></script>
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

<!--            <div class="chat-text section-left flex">-->
<!--            <span class="char-img" style="background-image: url(http://index.tptest.com:99/static/newcj/img/123.jpg)"></span>-->
<!--            <span class="text"><i class="icon icon-sanjiao4 t-32"></i>你好</span>-->
<!--            </div>-->

<!--            <div class="chat-text section-right flex">-->
<!--            <span class="text"><i class="icon icon-sanjiao3 t-32"></i>你好</span>-->
<!--            <span class="char-img" style="background-image: url(http://index.tptest.com:99/static/newcj/img/132.jpg)"></span>-->
<!--            </div>-->

        </div>
    </div>
    <div class="fix-send flex footer-bar">
        <i class="icon icon-emoji1 t-50"></i>
        <input class="send-input t-28" maxlength="200">
        <i class="icon icon-add t-50" style="color: #888;"></i>
        <span class="send-btn">发送</span>
    </div>
</div>
</div>
    <script>

        var fromid = <?php echo htmlentities($fromid); ?>;
        var toid = <?php echo htmlentities($toid); ?>;
        console.log(fromid);
        console.log(toid);
        var ws = new WebSocket("ws://127.0.0.1:8282");
        ws.onmessage = function (e) {
            var message = eval("("+e.data+")");
            switch (message.type) {
                case 'text':
                    if (toid == message.fromid){
                        $('.chat-content').append('<div class="chat-text section-left flex">\n' + '<span class="char-img" style="background-image: url(http://index.tptest.com:99/static/newcj/img/123.jpg)">' +
                            '</span>\n' + '<span class="text"><i class="icon icon-sanjiao4 t-32"></i>'+message.data+'</span>\n' + '</div>');
                    }

                    break;
                case 'init':
                    var bild = '{"type":"bind","fromid":"'+fromid+'","toid":"'+toid+'"}';
                    ws.send(bild);
                    break;
            }
        }

        $(".send-btn").click(function () {
            var text = $('.send-input').val();

            var message = '{"data":"'+text+'","type":"say","fromid":"'+fromid+'","toid":"'+toid+'"}';
            $('.chat-content').append('<div class="chat-text section-right flex">\n' +
                '<span class="text"><i class="icon icon-sanjiao3 t-32"></i>'+text+'</span>\n' +
                '<span class="char-img" style="background-image: url(http://index.tptest.com:99/static/newcj/img/132.jpg)"></span>\n' +
                '</div>');
            ws.send(message);
            $('.send-input').val("");
        });

        
        
    </script>
</body>
</html>
