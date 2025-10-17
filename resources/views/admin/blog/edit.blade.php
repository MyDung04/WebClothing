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

                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Title</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $blog->title}}">
                            </div>
                            <div class="mb-3">
                                <label for="name">Image</label>
                                <input type="file" name="image" id="" class="form-control" value="{{$blog->image}}">
                            </div>
                            <div class="mb-3">
                                <label for="name">Description</label>
                                <input type="text" name="description" id="" class="form-control"
                                    value="{{$blog->description}}">
                            </div>
                            <div class="mb-3">
                                <label for="name">Content</label>
                                <textarea name="txtContent" id="editor1" class="form-control"></textarea>
                            </div>
                            <button class="btn" style="background-color:chartreuse;">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection