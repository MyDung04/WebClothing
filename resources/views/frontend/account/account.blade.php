@extends("frontend.layout.app")
@section('content')

<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Update user</h2>
        <div class="signup-form">
            <!--sign up form-->


            <h2> User Signup!</h2>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" value="{{ $data->name }}" />
                <input type="email" name="email" value="{{$data->email}}" />
                <input type="password" name="password" />
                <input type=" text" name="phone" value="{{$data->phone}}" />
                <input type="file" name="avatar" id="">
                <button type="submit" class="btn btn-default">Signup</button>

            </form>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i>Thong bao</h4>
                {{session('success')}}
                @endif

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
            </div>
        </div>
    </div>
</div>

@endsection