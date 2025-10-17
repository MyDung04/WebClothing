@extends("frontend.layout.app")

@section('content')

<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">

            <h3>{{$blog->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
            </div>
            <a href="">
                <img src="{{ asset('images/blog/'.$blog->image)}}" alt="">
            </a>
            {!!$blog->content!!}
            <!-- <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur.</p> <br>

            <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo.</p> <br>

            <p>
                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
                dolores eos qui ratione voluptatem sequi nesciunt.</p> <br>

            <p>
                Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia
                non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
            </p> -->
            <div class="pager-area">
                <ul class="pager pull-right">
                    @if($prev)
                    <li><a href="{{url('/member/blogdetail/'.$prev->id)}}">Pre</a></li>
                    @endif
                    @if($next)
                    <li><a href="{{url('/member/blogdetail/'.$next->id)}}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!--/blog-post-area-->

    <div class="rating-area">
        <ul class="ratings">
            <li class="rate-this">Rate this item:</li>
            <li>
                <!-- <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star color"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> -->
                <!-- <div class="rate">
                                <div class="vote">

                                    <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                    <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                    <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                    <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                    <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                    <span class="rate-np">4.5</span>
                                </div>
                            </div> -->
                <div class="rate">
                    <div class="vote">
                        @for($i = 1; $i <= 5; $i++) <div
                            class="star_{{ $i }} ratings_stars{{ $i <= $avgRate ? ' ratings_over' : '' }}">
                            <input value="{{ $i }}" type="hidden">
                    </div>
                    @endfor

                </div>
    </div>
    </li>

    <li class="color">(6 votes)</li>
    @if($errors->any())
    <div class="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    </ul>
    <ul class="tag">
        <li>TAG:</li>
        <li><a class="color" href="">Pink <span>/</span></a></li>
        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
        <li><a class="color" href="">Girls</a></li>
    </ul>
</div>
<!--/rating-area-->

<div class="socials-share">
    <a href=""><img src="{{ asset('images/blog/socials.png') }}" alt=""></a>
</div>
<!--/socials-share-->

<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> -->
<!--Comments-->
<div class="response-area">
    <h2>3 RESPONSES</h2>

    <ul class="media-list">
        @foreach($cmt as $comment)
        @if($comment->level == 0)
        <li class="media" id="{{ $comment->id }}">

            <a class="pull-left" href="#">
                <img class="media-object" style="height: 100px; width:100px;"
                    src="{{ asset('assets/images/blogs/'.$comment->avatar) }}" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{ $comment->user_name }}</li>
                    <li><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</li>
                    <li><i class="fa fa-calendar"></i>{{ $comment->created_at }}</li>
                </ul>
                <p>{{ $comment->cmt }}</p>
                <button type="submit" class="btn btn-primary btn-reply" value="{{ $comment->id }}">
                    <i class="fa fa-reply"></i>Replay
                </button>
                <p></p>
                <div class="reply-list"></div>

                <form action="" id="{{ $comment->id }}" class="hide reply_form" method="post">
                    @csrf
                    <div class="text-area">
                        <div class="blank-arrow">
                            <label>{{ $comment->user_name }}</label>
                        </div>
                        <span>*</span>
                        <textarea name="cmt" rows="11" class="cmt"></textarea>
                        <button type="submit" class="btn btn-primary btnreply-comment">Reply
                            comment</button>
                    </div>
                </form>
                @foreach($cmt as $reply)
                @if(isset($reply->level) && $reply->level == $comment->id)
        <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" style="height:100px; width:100px;"
                    src="{{ asset('assets/images/blogs/'.$reply->avatar) }}" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{ $reply->user_name }}</li>
                    <li><i class="fa fa-clock-o"></i> {{ $reply->created_at }}</li>
                    <li><i class="fa fa-calendar"></i>{{ $reply->created_at }}</li>
                </ul>
                <p>{{ $reply->cmt }}</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>
        @endif
        @endforeach

        </li>
        @endif
        @endforeach
    </ul>
</div>
<!--/Response-area-->
<div class="replay-box">
    <div class="row">
        <div class="col-sm-12">

            <form action="{{ url('/member/blogdetail/cmt/'.$blog->id) }}" method="post" id="form">
                <h2>Leave a replay</h2>
                @csrf
                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <textarea name="cmt" rows="11" class="cmt"></textarea>
                    <button type="submit" class="btn btn-primary btn-comment">Post comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/Repaly Box-->

@endsection
@section('zoom')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote'); 
            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        $('.ratings_stars').click(function() {
            var checkLogin = "{{Auth::Check()}}";

            if (checkLogin) {
                // if ($(this).hasClass('ratings_over')) {
                var rate = $(this).find("input").val();
                var a = $(this).prevAll().andSelf();
                // alert(rate);
                // if ($(this).hasClass('ratings_over')) {
                //     $('.ratings_stars').removeClass('ratings_over');
                //     $(this).prevAll().andSelf().addClass('ratings_over');
                // } else {
                //     $(this).prevAll().andSelf().addClass('ratings_over');
                // }
                $.ajax({
                    type: 'POST',
                    url: '{{ url("/member/blog/rate/ajax") }}',
                    data: {
                        rate: rate,
                        id_blog: "{{$blog->id}}",
                        id_user: "{{Auth::id()}}"
                    },
                    success: function(response) {
                        if (response === 'Fail') {
                            alert('Vui long khong danh gia lai');
                        }
                        if (response === 'success') {

                            alert('Sucess');
                            a.addClass('ratings_over');

                        }
                    }
                });
            } else {
                alert("Vui long login de rate");

            }
        });
        //php +js
        // $('.btn-comment').click(function(e) {
        //     e.preventDefault();
        //     var checkLogin = "{{ Auth::check()}}";
        //     if (checkLogin) {
        //         $(this).closest('form').submit();
        //     } else {
        //         alert('Vui long Login');
        //     }
        // });
        $('.btn-reply').click(function(e) {
            var checkLogin = "{{Auth::check()}}";
            if (checkLogin) {
                var $form = $(this).closest('.media').find('.reply_form');
                if ($form.hasClass('hide')) {
                    $form.removeClass('hide').addClass('show');
                } else {
                    $form.removeClass('show').addClass('hide');
                }
            } else {
                alert("Vui long login");
            }
        });

        $(".btnreply-comment").click(function(e) {
            e.preventDefault();
            var id = $(this).closest(".reply_form").attr('id');
            var cmt = $(this).closest(".reply_form").find(".cmt").val();

            $.ajax({
                type: 'POST',
                url: '{{url("/member/blog/cmt/ajax")}}',
                data: {
                    cmt: cmt,
                    id_blog: "{{$blog->id}}",
                    id_user: "{{Auth::id() }}",
                    user_name: "{{ Auth::check() ? Auth::user()->name: ''  }}",
                    avatar: "{{ Auth::check() ?  Auth::user()->avatar : ''}}",
                    level: id,
                },
                success: function(response) {
                    if (response.status === "success") {
                        var data = response.data;
                        var html = `
                    <li class="media second-media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="/assets/images/blogs/${data.avatar}" alt="">
                        </a>
                        <div class="media-body">
                            <ul class="sinlge-post-meta">
                                <li><i class="fa fa-user"></i>${data.user_name}</li>
                                <li><i class="fa fa-clock-o"></i> ${data.created_at}</li>
                                <li><i class="fa fa-calendar"></i>${data.created_at}</li>
                            </ul>
                            <p>${data.cmt}</p>
                            <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                        </div>
                    </li>
                `;
                        $('#' + data.level).find('.reply-list').append(html);
                    } else {
                        alert(response.message);
                    }
                }
            });
        });


        // $('.btn-reply').click(function(e) {
        //     e.preventDefault();
        //     var checkLogin = "{{ Auth::check() ? 1 : 0 }}";
        //     if (checkLogin == 1) {

        //         var id = $(this).val();
        //         var cmt = $(this).closest(".text-area").find(".cmt").val();
        //         alert(id);
        //         $.ajax({
        //             type: 'POST',
        //             url: '{{url("/member/blog/reply/ajax")}}',
        //             data: {
        //                 cmt: cmt,
        //                 id_blog: "{{$blog->id}}",
        //                 id_user: "{{ Auth::check() ? Auth::id() : '' }}",
        //                 user_name: "{{ Auth::check() ? Auth::user()->name : '' }}",
        //                 avatar: "{{ Auth::check() ? Auth::user()->avatar : '' }}",
        //                 level: id,

        //             },
        //             success: function(response) {
        //                 console.log(response);
        //                 addReply(response.data);
        //             }
        //         });

        //     } else {
        //         alert("Vui lòng login để cmt");
        //     }
        // });

        //THUC HIEN BANG AJAX
        $('.btn-comment').click(function(e) {
            e.preventDefault();
            var checkLogin = "{{ Auth::check() ? 1 : 0 }}";
            if (checkLogin == 1) {

                var cmt = $(this).closest(".text-area").find(".cmt").val();
                alert(cmt);
                $.ajax({
                    type: 'POST',
                    url: '{{url("/member/blog/cmt/ajax")}}',
                    data: {

                        cmt: cmt,
                        id_blog: "{{$blog->id}}",
                        id_user: "{{Auth::id() }}",
                        user_name: "{{ Auth::check() ? Auth::user()->name: ''  }}",
                        avatar: "{{ Auth::check() ?  Auth::user()->avatar : ''}}",



                    },
                    success: function(response) {
                        // console.log(response);
                        // if (response === 'Fail') {
                        //     alert('Loi');
                        // }
                        // addComment(response.data);
                        if (response.status === "success") {
                            var data = response.data;
                            alert(data.avatar);
                            var html = `
                                    <li class="media">

                                        <a class="pull-left" href="#">
                                        <img class="media-object" style="height:100px; width:100px;" src="/WebShop/public/assets/images/blogs/${data.avatar}" alt="">
                                        <div class="media-body">
                                            <ul class="sinlge-post-meta">
                                                <li><i class="fa fa-user"></i>${data.user_name}</li>
                                                <li><i class="fa fa-clock-o"></i>${data.created_at}</li>
                                                <li><i class="fa fa-calendar"></i>${data.created_at}</li>
                                            </ul>
                                            <p>${data.cmt}</p>
                                            <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                        </div>
                                    </li>
                                    `;
                            $('.media-list').prepend(
                                html); // them vao dau tien trong the media-list
                            //append: them vao cuoi cua the duoc chon
                            //after: them vao ngay phan tu duoc chon(ben ngoai)
                            //before: nguoc lai

                        } else {
                            alert(response.message);
                        }
                    },
                });
            } else {
                alert("Vui lòng login để cmt");
            }
        });


        // $('.btn-reply').click(function(e) {
        //     e.preventDefault();
        //     var checkLogin = "{{ Auth::check() ? 1 : 0 }}";
        //     if (checkLogin == 1) {

        //         var id = $(this).val();
        //         var cmt = $(this).closest(".text-area").find(".cmt").val();
        //         alert(id);
        //         $.ajax({
        //             type: 'POST',
        //             url: '{{url("/member/blog/reply/ajax")}}',
        //             data: {
        //                 cmt: cmt,
        //                 id_blog: "{{$blog->id}}",
        //                 id_user: "{{ Auth::check() ? Auth::id() : '' }}",
        //                 user_name: "{{ Auth::check() ? Auth::user()->name : '' }}",
        //                 avatar: "{{ Auth::check() ? Auth::user()->avatar : '' }}",
        //                 level: id,

        //             },
        //             success: function(response) {
        //                 console.log(response);
        //                 addReply(response.data);
        //             }
        //         });

        //     } else {
        //         alert("Vui lòng login để cmt");
        //     }
        // });



        // function addReply(data) {
        //     var html = `
        //         <li class="media second-media">
        //             <a class="pull-left" href="#">
        //                 <img class="media-object" src="/images/blog/${data.avatar}" alt="">
        //             </a>
        //             <div class="media-body">
        //                 <ul class="sinlge-post-meta">
        //                     <li><i class="fa fa-user"></i>${data.user_name}</li>
        //                     <li><i class="fa fa-clock-o"></i>${data.created_at}</li>
        //                     <li><i class="fa fa-calendar"></i>${data.created_at}</li>
        //                 </ul>
        //                 <p>${data.cmt}</p>
        //                 <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
        //             </div>
        //         </li>
        //         `;
        //     $(data.level + ' .reply-list').append(html);
        // }

        // function addComment(data) {
        var html = `
             <li class="media">

                <a class="pull-left" href="#">
                   <img class="media-object" src="/images/blog/${data.avatar}" alt="">
                </a>
                <div class="media-body">
                    <ul class="sinlge-post-meta">
                        <li><i class="fa fa-user"></i>${data.user_name}</li>
                        <li><i class="fa fa-clock-o"></i>${data.created_at}</li>
                        <li><i class="fa fa-calendar"></i>${data.created_at}</li>
                    </ul>
                    <p>${data.cmt}</p>
                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                </div>
            </li>
            `
        //     $('.media-list').prepend(html);
        // }


    });
</script>
@endsection