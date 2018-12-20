<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <!--[if IE]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
    <title><?php echo $this->pageHead; ?></title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style2.css" type="text/css"
          media="screen, projection"/>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/github.css'); ?>
    <script>hljs.initHighlightingOnLoad();</script>
    <!--[if lte IE 7]>
    <style type="text/css">
        html, body {
            height: 100%;
            overflow: hidden;
        }

        .oldIE {
            color: #000;
            position: absolute;
            height: 100%;
            width: 100%;
        }
    </style>
    <![endif]-->
    <style>
        pre.blog {
            padding: 0;
            margin: 0;
            font: 13px/16px Tahoma, Verdana, sans-serif;
            border: 0;
            background-color: transparent;
            word-break: normal;
        }
        pre.blog code {
            white-space: normal;
        }

        @font-face {
            font-family: 'PasswordFont'; /*a name to be used later*/
            src: url('/themes/new/css/password.ttf'); /*URL to font*/
        }
        .pwd_custom {
            font-family: 'PasswordFont';
        }
    </style>
    <!-- Asynchronous Tracking GA top piece counter -->
    <script type="text/javascript">
        var _gaq = _gaq || [];

        var rsrc = /mgd_src=(\d+)/ig.exec(document.URL);
        if(rsrc != null) {
            _gaq.push(['_setCustomVar', 1, 'mgd_src', rsrc[1], 2]);
        }

        _gaq.push(['_setAccount', 'UA-17715832-1']);
        _gaq.push(['_addOrganic', 'm.yandex.ru', 'text', true]);
        _gaq.push(['_addOrganic', 'images.yandex.ru', 'text', true]);
        _gaq.push(['_addOrganic', 'blogs.yandex.ru', 'text', true]);
        _gaq.push(['_addOrganic', 'video.yandex.ru', 'text', true]);
        _gaq.push(['_addOrganic', 'go.mail.ru', 'q']);
        _gaq.push(['_addOrganic', 'm.go.mail.ru', 'q', true]);
        _gaq.push(['_addOrganic', 'mail.ru', 'q']);
        _gaq.push(['_addOrganic', 'google.com.ua', 'q']);
        _gaq.push(['_addOrganic', 'images.google.ru', 'q', true]);
        _gaq.push(['_addOrganic', 'maps.google.ru', 'q', true]);
        _gaq.push(['_addOrganic', 'nova.rambler.ru', 'query']);
        _gaq.push(['_addOrganic', 'm.rambler.ru', 'query', true]);
        _gaq.push(['_addOrganic', 'gogo.ru', 'q']);
        _gaq.push(['_addOrganic', 'nigma.ru', 's']);
        _gaq.push(['_addOrganic', 'search.qip.ru', 'query']);
        _gaq.push(['_addOrganic', 'webalta.ru', 'q']);
        _gaq.push(['_addOrganic', 'sm.aport.ru', 'r']);
        _gaq.push(['_addOrganic', 'akavita.by', 'z']);
        _gaq.push(['_addOrganic', 'meta.ua', 'q']);
        _gaq.push(['_addOrganic', 'search.bigmir.net', 'z']);
        _gaq.push(['_addOrganic', 'search.tut.by', 'query']);
        _gaq.push(['_addOrganic', 'all.by', 'query']);
        _gaq.push(['_addOrganic', 'search.i.ua', 'q']);
        _gaq.push(['_addOrganic', 'index.online.ua', 'q']);
        _gaq.push(['_addOrganic', 'web20.a.ua', 'query']);
        _gaq.push(['_addOrganic', 'search.ukr.net', 'search_query']);
        _gaq.push(['_addOrganic', 'search.com.ua', 'q']);
        _gaq.push(['_addOrganic', 'search.ua', 'q']);
        _gaq.push(['_addOrganic', 'poisk.ru', 'text']);
        _gaq.push(['_addOrganic', 'go.km.ru', 'sq']);
        _gaq.push(['_addOrganic', 'liveinternet.ru', 'ask']);
        _gaq.push(['_addOrganic', 'gde.ru', 'keywords']);
        _gaq.push(['_addOrganic', 'affiliates.quintura.com', 'request']);
        _gaq.push(['_trackPageview']);
        _gaq.push(['_trackPageLoadTime']);
    </script>
    <!-- Asynchronous Tracking GA top piece end -->
    <!--[if lt IE 9]>
    <script>document.createElement('figure');</script>
    <![endif]-->
</head>

<body>
<!--[if lte IE 7]>
<div class="oldIE">
    <h1>Please, download or update new browser.</h1>
</div>
<![endif]-->
<div id="head">
    <div class="mainImg">
        <?php echo CHtml::image('/themes/new/images/headerBack.jpg'); ?>
    </div>
</div>
<div id="wrapper">
    <header id="header">
        <?php $this->widget('application.modules.user.widgets.menu.ProfileWidget'); ?>
        <nav id="topMenu">
            <?php
            $this->widget('ext.menu.Menu', array(
                    'items' => array(
                        array('label' => 'Главная', 'url' => array('/post/index/index')),
                        array('label' => 'Фотографии', 'url' => array('/event/news/image')),
                        array('label' => 'Видеозаписи', 'url' => array('/event/news/video')),
                        array('label' => 'Аудиозаписи', 'url' => array('/event/news/audio')),
                        array('label' => 'Комментарии', 'url' => array('/event/comment/index')),
                        array('label' => 'Сообщества', 'url' => array('/community/request/index')),
                        array('label' => 'Опросы', 'url' => array('/poll/request/index')),
                        //array('label' => 'Поиск', 'url' => array('/site/search')),
                        array('label' => 'Радио', 'url' => array('/radio/request/index', 'visible' => Yii::app()->user->isAdmin())),
                    ),
                    'htmlOptions' => array('class' => 'menu')
                ));
            ?>
        </nav>
    </header>
    <!-- #header-->
    <section id="middle">
        <section id="headerInfo">
            <div class="content"><?php $this->widget('ext.breadcrumbs.Breadcrumbs', array('links' => $this->breadcrumbs)); ?></div>
        </section>
        <div id="container">
            <div id="content">
                <?php $this->widget('bootstrap.widgets.TbAlert', array(
                        'block'=>true, // display a larger alert block?
                        'fade'=>true, // use transitions?
                        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                        //'alerts'=>array( // configurations per alert type
                        //    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                        //),
                    ));
                echo $content;
                ?>
            </div>
        </div>
        <aside id="sideLeft">
            <?php $this->widget('application.widgets.menu.MenuWidget', array(
                    'guest'      => $this->guest,
                    'user'       => $this->user,
                    'main'       => $this->main,
                    'event'      => $this->event,
                    'subscribe'  => $this->subscribe,
                    'advert'  	 => false,
                )); ?>
        </aside><!-- #sideLeft -->
        <aside id="sideRight">
            <?php $this->widget('application.widgets.menu.MenuWidget', array(
                    'friend'     => $this->friend,
                    'community' => $this->community,
                    'rating'    => $this->rating,
                    'moder'     => $this->moder,
                )); ?>
            <?php $this->widget('application.widgets.poll.PollWidget'); ?>
            <?php $this->widget('application.widgets.online.OnlineWidget'); ?>
        </aside><!-- #sideRight -->
        <div class="clear"></div>
        <div id="tagWrap">
            <div id="tags">
                <?php $this->widget('application.widgets.tagCloud.TagCloudWidget', array(
                        'id' => 'tagCloud',
                        'maxTags'=>Yii::app()->params['tagCount'],
                    )); ?>
            </div>
        </div>

    </section>
    <!-- #middle-->

    <footer id="footer">
        ©2013 <a href=" https://oldbk.com/" target="_blank">OLDBK.COM</a>. All rights reserved
    </footer>
    <!-- #footer -->

</div>
<style>
    #go_advert {
        -ms-filter: "progid:DXImageTransform.Microsoft.Matrix(M11=-0.00000000, M12=1.00000000, M21=-1.00000000, M22=-0.00000000,sizingMethod='auto expand')";
        filter: progid:DXImageTransform.Microsoft.Matrix(M11=-0.00000000, M12=1.00000000, M21=-1.00000000, M22=-0.00000000,sizingMethod='auto expand');
        -moz-transform:  matrix(-0.00000000, -1.00000000, 1.00000000, -0.00000000, 0, 0);
        -webkit-transform:  matrix(-0.00000000, -1.00000000, 1.00000000, -0.00000000, 0, 0);
        -o-transform:  matrix(-0.00000000, -1.00000000, 1.00000000, -0.00000000, 0, 0);
        -moz-transform: rotate(270deg);
        -webkit-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        -sand-transform: rotate(270deg);
        transform: rotate(270deg);
        height: 32px;
        width: 170px;
        border: 2px solid #fff6db;
        color: #624d15;
        font: bold 11px Tahoma;
        margin: -50px 63px -50px -61px;
        position: fixed;
        top: 50%;
        left: 0;
        text-align: center;
        padding-top: 14px;
        cursor: pointer;
        background-color: #fdcc00;
    }

    #go_advert:hover {
        background-color: #ffe600;
    }
</style>
<!--[if lte IE 8]>
<style>
    #bug_report {
        margin:-50px -123px 27px 50px;
    }
    #go_advert {
        margin:-50px -123px 27px 0px;
    }
</style>
<![endif]-->
<style>
    .new_advert {
        color: red;
        font-weight: bold;
        font-size: 10px;
    }
</style>
<div id="bug_report">Сообщить об ошибке</div>
<?php if(Yii::app()->user->isGuest): ?>
    <a href="https://blogadv.oldbk.com/login.html" target="_blank"><div id="go_advert">Реклама на сайте</div></a>
<?php endif; ?>
<script>
    $(function () {
        $(".fancybox.preview_image").fancybox({
            openEffect	: 'none',
            closeEffect	: 'none'
        });

        $(document.body).on('click', '#bug_report', function () {
            $.fancybox({
                type: 'ajax',
                openEffect: 'none',
                closeEffect: 'none',
                href: '<?php echo Yii::app()->createUrl('/site/bug'); ?>',
                autoHeight: true,
                autoWidth: true,
                afterClose  : function(){
                    if($('.sp-container').exists())
                        $('.sp-container').remove();
                },
                afterOpen : function() {
                    setTimeout(function(){
                        $.fancybox.update();
                    }, 1000);
                }
            });
        });

        $(document.body).on('click', '.update.item', function (event) {
            event.preventDefault();
            var $self = $(this);
            $self.fancybox({
                type: 'ajax',
                openEffect: 'none',
                closeEffect: 'none',
                href: $self.attr('href'),
                afterClose  : function(){
                    if($('.sp-container').exists())
                        $('.sp-container').remove();
                }
            });
        });
        $('.update.item').trigger('click');
    });
</script>
<!-- Asynchronous Tracking GA bottom piece counter-->
<script type="text/javascript">
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
    })();
</script>
<!-- Asynchronous Tracking GA bottom piece end -->
<div class="counters">
    <!--noindex-->
    <!--LiveInternet counter--><script type="text/javascript">
        <!--
        document.write("<a href='https://www.liveinternet.ru/click' "+
        "target=_blank><img style='float:left; margin-left:10px;' src='https://counter.yadro.ru/hit?t54.2;r"+
        escape(document.referrer)+((typeof(screen)=="undefined")?"":
        ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
        ";"+Math.random()+
        "' alt='' title='LiveInternet: показано число просмотров и"+
        " посетителей за 24 часа' "+
        "border='0' ><\/a>")
        //-->
    </script><!--/LiveInternet-->
    <!--Rating@Mail.ru counter-->
    <script type="text/javascript"><!--
        d=document;var a='';a+=';r='+escape(d.referrer);js=10;//--></script>
    <script type="text/javascript"><!--
        a+=';j='+navigator.javaEnabled();js=11;//--></script>
    <script type="text/javascript"><!--
        s=screen;a+=';s='+s.width+'*'+s.height;
        a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script>

    <script type="text/javascript"><!--
        js=13;//--></script><script type="text/javascript"><!--
        d.write('<a style="float:left; margin-left:10px;" href="https://top.mail.ru/jump?from=1765367" target="_blank">'+
        '<img src="https://df.ce.ba.a1.top.mail.ru/counter?id=1765367;t=49;js='+js+
        a+';rand='+Math.random()+'" alt="Рейтинг@Mail.ru" border="0" '+
        'height="31" width="88"><\/a>');if(11<js)d.write('<'+'!-- ');//--></script>
    <noscript><a target="_top" href="https://top.mail.ru/jump?from=1765367">
            <img src="https://df.ce.ba.a1.top.mail.ru/counter?js=na;id=1765367;t=49"
                 height="31" width="88" alt="Рейтинг@Mail.ru"></a></noscript>
    <script type="text/javascript"><!--
        if(11<js)d.write('--'+'>');//
        -->
    </script>
    <!--// Rating@Mail.ru counter-->
    <!--/noindex-->
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter1256934 = new Ya.Metrika({id:1256934,
                        accurateTrackBounce:true, webvisor:true});
                } catch(e) {}
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/1256934" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</div>
<?php
if (date("H") == 0 && date("i") < 8) $diff = mktime(0, 9, 0, date("n"), date("j"))-time();
else $diff = mktime(0, 9, 0, date("n"), date("j") + 1)-time();
?>
<script>
    function getRandomArbitary(min, max)
    {
        return Math.random() * (max - min) + min;
    }


    setTimeout(function(){location.reload()}, getRandomArbitary(<?= $diff ?>, <?= $diff ?> + 120) * 1000);
</script>
</body>
</html>