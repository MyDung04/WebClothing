@extends("frontend.layout.app")
@section("content")


<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Login to your account</h2>
                    <form action="" method="POST">
                        @csrf

                        <input type="email" name="email" placeholder="Email Address" />
                        <input type="text" name="password" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <p><a href="{{url('/forgot')}}">? Forgot Password</a></p>
                        <button type="submit" class="btn btn-default">Login</button>
                        @if($errors->any())
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i>Thong bao</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            {{session('success')}}

                        </div>
                        @endif
                    </form>
                </div>
                <!--/login form-->
            </div>


        </div>
    </div>
</section>
<!--/form-->


@endsection