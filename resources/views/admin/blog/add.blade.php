@extends("admin.layout.app")
@section("content")
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Latest Sales</h4> -->
                    </div>
                    <div class="table-responsive">

                        <h1>Add Blog</h1>

                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Title</label>
                                <input type="text" name="title" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name">Image</label>
                                <input type="file" name="image" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name">Description</label>
                                <input type="text" name="description" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name">Content</label>
                                <textarea name="content" id="editor1" class="form-control"></textarea>
                            </div>
                            <button class="btn" style="background-color:chartreuse;">Submit</button>
                            @if($errors->any())
                            <div class="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection