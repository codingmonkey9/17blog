@extends('layouts.home')

@section('main-wrap')
<meta name="csrf-token" content="{{ csrf_token() }}">
 <!-- Main Wrap -->
 <div id="main-wrap">
  <div id="sitenews-wrap" class="container"></div>
  <!-- Header Banner -->
  <!-- /.Header Banner -->
  <!-- CMS Layout -->
  <div class="container two-col-container cms-with-sidebar">
   <div id="main-wrap-left">
    <!-- Content -->
    <div class="content">
     <!-- Post meta -->
     <div id="single-meta">
      <span class="single-meta-author"><i class="fa fa-user">&nbsp;</i><a href="" title="{{ $art->art_title }}" rel="author">{{ $art->art_title }}</a></span>
      {{--时间戳判断多久前写的文章--}}
      
      @if($time<3600*24)
      <span class="single-meta-time"><i class="fa fa-calendar">&nbsp;</i> {{round($time/(3600))}}小时前</span>
      @elseif($time>3600*24 && $time<3600*24*30)
      <span class="single-meta-time"><i class="fa fa-calendar">&nbsp;</i> {{round($time/(3600*24))}}天前</span>
      @elseif($time>3600*24*30 && $time<3600*24*365)
      <span class="single-meta-time"><i class="fa fa-calendar">&nbsp;</i> {{round($time/(3600*24*30))}}月前</span>
      @else
      <span class="single-meta-time"><i class="fa fa-calendar">&nbsp;</i> {{round($time/(3600*24*365))}}年前</span>
      @endif

      <span class="single-meta-category"><i class="fa fa-folder-open">&nbsp;</i><a href="{{ url('lists/'.$art->cate_id) }}" rel="category tag">{{ $art->cate_name }}</a></span>
      <span class="single-meta-comments">|&nbsp;&nbsp;<i class="fa fa-comments"></i>&nbsp;<a href="#" class="commentbtn">抢沙发</a></span>
      <span class="single-meta-views" title="浏览次数"><i class="fa fa-fire" ></i>&nbsp;{{ $art->art_view }}&nbsp;</span>
     </div>
     <!-- /.Post meta -->
     <!-- Rating plugin -->
     <div class="rates" pid="5136">
      <span class="ratesdes">文章评分 <span class="ratingCount">0</span> 次，平均分 <span class="ratingValue">0.0</span> ： <span id="starone" class="stars" title="1星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="startwo" class="stars" title="2星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="starthree" class="stars" title="3星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="starfour" class="stars" title="4星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="starfive" class="stars" title="5星" times="0" solid="n"><i class="fa fa-star-o"></i></span> </span>
     </div>
     <!-- /.Rating plugin -->
     <!-- Single article intro -->
     <!-- /.Single article intro -->
     <!-- Top ad -->
     {{--<div id="singletop-banner">--}}
      {{--<script async="" src="js/adsbygoogle.js"></script>--}}
      {{--<!-- 自适应广告 -->--}}
      {{--<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8963660216421975" data-ad-slot="9559704844" data-ad-format="auto"></ins>--}}
      {{--<script>--}}
          {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
      {{--</script>--}}
     {{--</div>--}}
     <!-- /.Top ad -->
     <div class="single-thumb">
     </div>
     <div class="single-text">
     {!! $art->art_content !!}
      <!-- Page links -->
      <!-- /.Page links -->
     </div>
     <div class="single-tag">
      <i class="fa fa-tag"></i>&nbsp;&nbsp;
      <a href="javascript:;" rel="tag">{{ $art->art_tag }}</a>
     </div>

     <!-- Bottom ad -->
     {{--<div id="singlebottom-banner">--}}
      {{--<script async="" src="js/adsbygoogle.js"></script>--}}
      {{--<!-- 自适应广告 -->--}}
      {{--<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8963660216421975" data-ad-slot="9559704844" data-ad-format="auto"></ins>--}}
      {{--<script>--}}
          {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
      {{--</script>--}}
     {{--</div>--}}
     <!-- /.Bottom ad -->
     <!-- Single Activity -->
     <div class="single-activity">
      <div class="mark-like-btn tinlike clr">
       <a class="share-btn like-btn" pid="5136" style="cursor:default;" title="点击喜欢"> <i class="fa fa-heart"></i> <span>{{$art->art_collect}}</span>人已收藏 </a>
       
       @if($res)
       <a class="share-btn collect collect-no"  uid="{{session()->get('homeuser')->user_id}}" artid="{{ $art->art_id }}"  title="已收藏"> <i class="fa fa-star"></i> <span>已收藏 </span> </a>
       @else
       <a class="share-btn collect collect-no"  uid="{{session()->get('homeuser')->user_id}}" artid="{{ $art->art_id }}"  title="未收藏"> <i class="fa fa-star"></i> <span>未收藏 </span> </a>
       @endif
      </div>
      <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare baidu-share">
       <a href="#" class="bds_tsina weibo-btn share-btn" data-cmd="tsina"> <i class="fa fa-weibo"></i>分享到微博 </a>
       <a href="#" class="bds_weixin weixin-btn share-btn"> <i class="fa fa-weixin"></i>分享到朋友圈
        <div id="weixin-qt" style="display: none; top: 80px; opacity: 1;">
         <img src="http://qr.liantu.com/api.php?text=http://www.iydu.net/5136.html" width="120" />
         <div id="weixin-qt-msg">
          打开微信，点击底部的“发现”，使用“扫一扫”即可将网页分享至朋友圈。
         </div>
        </div> </a>
       <a href="#" class="bds_more more-btn share-btn" data-cmd="more"><i class="fa fa-share-alt fa-flip-horizontal"></i><span class="pc-text">更多</span><span class="mobile-text">分享</span></a>
      </div>
     </div>
     <!-- /.Single Activity -->
     <!-- Single Author Info -->
     {{--<div class="single-author clr">--}}
      {{--<div class="img">--}}
       {{--<img src="images/dcaf6a953ef7f2d89ba09c56e3327bf2?s=100&amp;d=wavatar&amp;r=g" class="avatar" width="100" height="100" />--}}
      {{--</div>--}}
      {{--<div class="single-author-info">--}}
       {{--<div class="word">--}}
        {{--<div class="wordname">--}}
         {{--关于--}}
         {{--<a href="http://www.iydu.net/author/tyuan629" title="由甲子田发布" rel="author">甲子田</a>--}}
        {{--</div>--}}
        {{--<div class="authordes"></div>--}}
        {{--<div class="authorsocial">--}}
         {{--<span class="social-icon-wrap"><a class="as-img as-email" href="mailto:tianguoliang629@126.com" title="给我写信"><i class="fa fa-envelope"></i></a></span>--}}
        {{--</div>--}}
       {{--</div>--}}
      {{--</div>--}}
     {{--</div>--}}
     <div class="clear"></div>
     <!-- /.Single Author Info -->
     <!-- Related Articles -->
     <div class="relatedposts">
      <!--h3 class="multi-border-hl"><span>相关文章</span></h3-->
      <ul>
       @foreach($similar as $v)
       <li>
        <div class="relatedposts-inner">
         <div class="relatedposts-inner-pic">
          <a href="{{ url('detail/'.$v->art_id) }}" title="{{ $v->art_title }}" class="">
           <div class="thumb-img">
            <img src="{{ $v->art_thumb }}" />
            <span><i class="fa fa-plus"></i></span>
           </div> </a>
         </div>
         <div class="relatedposts-inner-text">
          <a href="{{ url('detail/'.$v->art_id) }}" title="{{ $v->art_title }}">{{ $v->art_title }} </a>
         </div>
        </div>
        <div class="clear"></div> </li>
      @endforeach
      </ul>
     </div>
     <!-- /.Related Articles -->
     <!-- Prev or Next Article -->
     <div class="navigation">
      <div class="navigation-left">
       @if(is_object($pre))
       <span>上一篇</span>
       <a href="{{ url('detail/'.$pre->art_id) }}" rel="prev">{{ $pre->art_title }}</a>
        <a>&nbsp;</a>
       @else
        <span>没有上一篇了</span>
       @endif
      </div>
      <div class="navigation-right">
       @if(is_object($next))
       <span>下一篇</span>
        <a>&nbsp;</a>
       <a href="{{ url('detail/'.$next->art_id) }}" rel="next">{{ $next->art_title }}</a>
        @else
        <span>没有下一篇了</span>
       @endif
      </div>
     </div>
     <!-- /.Prev or Next Article -->
    </div>
    <!-- /.Content -->
    <!-- Comments -->
    <div class="comments-main">
     <div id="respond_box">
      <div style="margin:8px 0 8px 0">
       <h3 class="multi-border-hl"><span>发表评论</span></h3>
      </div>
      <div id="respond">
       <div class="cancel-comment-reply" style="margin-bottom:5px">
        <small><a rel="nofollow" id="cancel-comment-reply-link" href="/5136.html#respond" style="display:none;">点击这里取消回复。</a></small>
       </div>
       <form action="" method="" id="commentform">
        <div class="author">
         <div id="real-avatar">
          {{ csrf_field() }}
          <img alt="bye~" src="/uploads/49feb4b7a2a13ae864beae6d48b7126f.jpg" srcset="" class="avatar avatar-40 photo" height="40" width="40" />
         </div>
         <div id="welcome">
          欢迎回来
          <strong id="username" style="color: #f00;">{{session('homeuser')->user_name}}</strong>
          <!-- <a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info">更改</a> -->
         </div>
        </div>
        <script type="text/javascript" charset="utf-8">
            var changeMsg = "更改";
            var closeMsg = "隐藏";
            function toggleCommentAuthorInfo() {
                jQuery('#comment-author-info').slideToggle('slow', function(){
                    if ( jQuery('#comment-author-info').css('display') == 'none' ) {
                        jQuery('#toggle-comment-author-info').text(changeMsg);
                    } else {
                        jQuery('#toggle-comment-author-info').text(closeMsg);
                    }
                });
            }
            jQuery(document).ready(function(){
                jQuery('#comment-author-info').hide();
            });
        </script>
        <div id="comment-author-info">
         <p class="comment-form-input-info" style="width:30%"> <label for="author">昵称 *</label> <input type="text" name="author" id="author" class="commenttext" value="不错" size="22" tabindex="1" required="" /> </p>
         <p class="comment-form-input-info" style="width:35%"> <label for="email">邮箱 *</label> <input type="email" name="email" id="email" class="commenttext" value="3223123@qq.con" size="22" tabindex="2" required="" /> </p>
         <p class="comment-form-input-info" style="width:35%;padding-right:0"> <label for="url">网址</label> <input type="text" name="url" id="url" class="commenttext" value="" size="22" tabindex="3" /> </p>
        </div>
        <div class="clear"></div>
        <div class="comt-box">
         <textarea name="comment" id="comment" tabindex="5" rows="5" placeholder="说点什么吧..." required=""></textarea>
         {{--<div class="comt-ctrl">--}}
          {{--<span data-type="comment-insert-smilie" class="comt-smilie"><i class="fa fa-smile-o"></i> 表情</span>--}}
          {{--<span class="comt-format"><i class="fa fa-code"></i> 格式</span>--}}
          <button class="submit btn btn-submit" name="submit" type="button"  tabindex="6" onclick="submitbtn()"><i class="fa fa-check-square-o"></i> 提交评论</button>
          {{--<!--input class="reset" name="reset" type="reset" id="reset" tabindex="7" value="重　　写" /-->--}}
          <input type="hidden" name="comment_post_ID" value="{{ $art->art_id }}" id="comment_post_ID" />
          {{--<input type="hidden" name="comment_parent" id="comment_parent" value="0" />--}}
          {{--<p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="856f7f2a96" /></p>--}}
          {{--<span class="mail-notify-check"><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" style="vertical-align:middle;" /><label for="comment_mail_notify" style="vertical-align:middle;">有人回复时邮件通知我</label></span>--}}
          {{--<p style="display: none;"><input type="hidden" id="ak_js" name="ak_js" value="65" /></p>--}}
          {{--<div class="clr"></div>--}}
         {{--</div>--}}
        </div>
       </form>
       <div class="clear"></div>
      </div>
     </div>
     <div class="commenttitle">
      <a href="#normal_comments"><span id="comments" class="active"><i class="fa fa-comments-o"></i>{{$comment_num}} 评论</span></a>
      <a></a>
      <a href="#quote_comments"><span id="comments_quote"><i class="fa fa-share"></i>0 引用</span></a>
     </div>
     <ol class="commentlist" id="normal_comments">
      @foreach($comment as $k=>$v)
        @if($v->parent_id == 0)
          <li class="comment even thread-even depth-1" id="comment-22456">
           <div id="div-comment-22456" class="comment-body">
            <img src="{{$v->head_pic}}" class="avatar" width="54" height="54" />
            <span class="floor"> #{{$k+1}}楼 </span>
            <div class="comment-main"> 
                 <div class="comment-author"  onmouseout="removereply(this)" onmouseover="addreply(this)">
                  <span class="comment_author_link">{{ $v->nickname }}</span>:
                  <div class="comment-info">
                   <span style="color:#911; font-style:inherit; margin-top:5px; line-height:25px;">{{ $v->content }}</span>
                   <!-- <span class="comment_author_vip tooltip-trigger" title="评论达人 LV.1"><span class="vip vip1">评论达人 LV.1</span></span> -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   @if($v->create_time > (time()-24*3600))
                    <span class="datetime"><font color="yellowgreen">发表于：</font>{{round((time() - $v->create_time)/3600)}}小时前 </span>
                   @else
                    <span class="datetime"><font color="yellowgreen">发表于：</font>{{date('Y-m-d H:i:s',$v->create_time)}}</span>
                   @endif
                   <a href="javascript:;" style="display: none;" onclick="addcom(this)">#回复#</a>
                   <span class="parent_id" style="display: none;">{{$v->id}}</span>
                   <!-- <span class="reply"> <a rel="nofollow" class="comment-reply-login user-login" href="javascript:">登录以回复</a> </span> -->
                   <!-- edit_comment_link(__('编辑','tinection'));-->
                  </div>
                 <!--  <textarea id="addcom" name="content" style="display: none;"></textarea>
                  <button id="addcombtn" style="display: none;">发表评论</button> -->
                 </div><br/>
                 <div class="clear"></div>
              @foreach($comment as $key=>$val)
                @if($val->parent_id == $v->id) 
                 <div class="comment-author" onmouseover="addsubreply(this)" onmouseout="removesubreply(this)">
                  <img src="{{$val->head_pic}}" width="20" height="20"/>
                  <span class="comment_author_link" id="nickname">{{ $val->nickname }}</span>
                  <span><font color="yellowblue">&nbsp;&nbsp;回复&nbsp;&nbsp;</font></span>
                  <span>{{$val->replyname}}</span>
                  <div class="comment-info">
                   <span style="color:#911; font-style:inherit; margin-top:5px; line-height:25px;">{{ $val->content }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   @if($val->create_time > (time()-24*3600))
                   <span class="datetime"> <font color="blue">发表于：</font>{{round((time() - $val->create_time)/3600)}}小时前 </span>
                   @else
                   <span class="datetime"><font color="blue">发表于：</font>{{date('Y-m-d H:i:s',$val->create_time)}}</span>
                   @endif
                   <a href="javascript:;" style="display: none;" onclick="addsubcom(this)">#回复#</a>
                   <span class="parent_id_2" style="display: none;">{{$v->id}}</span>
                  </div>
                  <!-- <textarea id="addsubcom" name="content" style="display: none;"></textarea>
                  <button id="addsubcombtn" style="display: none;">发表评论</button> -->
                 </div><br/>
                 <div class="clear"></div>
                @endif
             @endforeach
            </div>
           </div> </li>
        @endif
      @endforeach
      <div class="cpagination"></div>
     </ol>
     <ol class="commentlist" id="quote_comments">
      <div class="go-trackback">
                {{-- <input type="text" class="trackback-url" value="{{'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$_SERVER['QUERY_STRING']}}" /> --}}

       <input type="text" class="trackback-url" value="{{'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']}}" />
       <button type="submit" class="quick-copy-btn">复制引用</button>

      </div>
     </ol>
    </div>
    <!-- /.Comments -->
   </div>
   @parent
  </div>
  <div class="clear">
  </div>
  <!-- Blocks Layout -->
 </div>
 <!--/.Main Wrap -->
@endsection
<script type="text/javascript">
  var isSubcomment = false; //false 默认是一级评论
  var pid;
  var len;
  //点击一级评论de回复触发此事件函数
  function addcom(obj) {
    //不这样写了，直接把回复的对象填到模板评论框中，就像博客园的回复一样。一级评论和回复都用同一个文本域。
    var replyname = $(obj).parent().prev().text();
    //在这里获取replyname的长度，因为在其他地方获取不到replyname的值,也就更不能获取长度了
    len = replyname.length;
    $('#comment').val('@'+replyname+'\n');
    //滚动到评论文本域位置
    scrollTo('#comment',300);
    isSubcomment = true; //true 表示提交二级评论
    pid = $(obj).siblings('.parent_id').text();
  }

  //点击二级评论的回复触发此事件函数
  function addsubcom(obj) {
    var replyname = $(obj).parent().siblings('#nickname').text();
    len = replyname.length;
    $('#comment').val('@'+replyname+'\n');
    scrollTo('#comment',300);
    isSubcomment = true; //true 表示提交二级评论
    pid = $(obj).siblings('.parent_id_2').text();
  }

  /*不能在addcom函数里触发.btn-submit点击事件，应该是交给.btn-submit事件回调函数自己判断触发那个函数。这样就不会和addcom
  * 耦合，否则在addcom函数里触发此事件耦合度太高。最主要的是在addcom里触发事件实现不了想要的功能。。。
  * 点击提交评论按钮的时候，需要判断提交的是一级评论还是二级评论。通过全局变量来判断。
  * 行内事件和其他类型绑定事件不能共存？
  */
  function submitbtn() {
    if(isSubcomment === true){
      //提交二级评论
      sentsubcomment();
    }else{
      sentcomment();
    }
    
  }

  //获取评论文本域提交按钮元素，调用此函数发送ajax
  function sentsubcomment() {
    // alert('提交二级评论');
    var content = $('#comment').val(); //评论内容,需要处理，把replyname去掉
    //截取content，已经获取到replyname的长度，直接把他截取掉即可"@+replyname",并且还可以通过截取获得replyname的值，不然没办法获取
    var replyname = content.substr(0,len+1).substr(1); //+1是因为还有个@
    content = content.substr(len+1); //不需要删除replyname，直接从replyname后开始截取不就OK了
    var parent_id = pid;//需要动态获取,获取parent_id=0的评论的id作为回复的parent_id
    var nickname = $('#username').text();//昵称即登录的用户名,本来想做为全局变量获取一次，但是声明为全局变量就是undefined，wtf?
    var head_pic = $('.photo').attr('src');//登录用户的头像
    var post_id = $('#comment_post_ID').val();
    $.ajax({
      type: 'post',
      url: '/comment',
      data: {content:content, parent_id:parent_id, nickname:nickname, head_pic:head_pic, post_id:post_id, replyname:replyname},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        if(data.status){
          location.reload();
        }else{
          alert('评论失败，请重试');
        }
      },
      error: function() {
        alert('未知错误，请重新发送');
      },
    })
  }

  //当发表评论的时候，是需要直接触发.btn-submit按钮事件的。所以这里就有分支。
  //1.通过事件执行顺序来判断是一级评论还是二级评论  2. 通过文本域中是否有replyname判断是一级评论还是二级评论
  function sentcomment() {
    // alert('提交一级评论');
    var content = $('#comment').val(); //评论内容
    var parent_id = 0;//需要动态获取
    var nickname = $('#username').text();//昵称即登录的用户名,本来想做为全局变量获取一次，但是声明为全局变量就是undefined，wtf?
    var head_pic = $('.photo').attr('src');//登录用户的头像
    var post_id = $('#comment_post_ID').val();
    $.ajax({
      type: 'post',
      url: '/comment',
      data: {content:content, parent_id:parent_id, nickname:nickname, head_pic:head_pic, post_id:post_id},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        if(data.status){
          location.reload();
        }else{
          alert('评论失败，请重试');
        }
      },
      error: function() {
        alert('未知错误，请重新发送');
      },
    })

  }

  //滚动到指定位置
  function scrollTo(element,speed) {
    if(!speed){
      speed = 300;
    }
    if(!element){
      $("html,body").animate({scrollTop:0},speed);
    }else{
      if(element.length>0){
        $("html,body").animate({scrollTop:$(element).offset().top-200},speed);
      }
    }
  }

  //一级评论移入显示回复按钮
  function addreply(obj) {
    // $(obj).append('<a href="javascript:;"> 回复# </a>'); //这种抓取不到回复文本，无法实现点击事件
    //想到了，我不用append动态添加“回复”，我用样式控制显示和隐藏
    $(obj).find('a').css('display','inline-block');
    
  }

  //一级评论移出隐藏回复按钮
  function removereply(obj) {
    // $(obj).find('a').remove();
    $(obj).find('a').css('display','none');
  }

  //二级评论移入显示回复按钮（所有一级评论之外的回复我都统称二级评论）
  function addsubreply(obj) {
    // alert(2);
    // $(obj).append('<a href="javascript:;">回复#</a>');
    // $(this).off('click');
    $(obj).find('a').css('display','inline-block');
  }

  //二级评论移出隐藏回复按钮
  function removesubreply(obj) {
    // $(obj).find('a').remove();
    $(obj).find('a').css('display','none');
  }

</script>