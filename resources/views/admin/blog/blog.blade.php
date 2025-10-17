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
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="border-top-0">ID</th>
                                    <th class="border-top-0">TITLE</th>
                                    <th class="border-top-0">IMAGE</th>
                                    <th class="border-top-0">DESCRIPTION</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $blog)
                                <tr>
                                    <td class="txt-oflo">{{$blog->id}}</td>
                                    <td><span class="txt-oflo">{{$blog->title}}</span> </td>
                                    <td><span class="txt-oflo">{{$blog->image}}</span> </td>
                                    <td><span class="txt-oflo">{{$blog->description}}</span> </td>
                                    <td>
                                        <div><a href="{{ url('/admin/blog/edit/'.$blog->id)}}">Edit</a></div>
                                        <div><a href="{{ url('/admin/blog/delete/'.$blog->id)}}">Delete</a></div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Hiển thị link phân trang -->
                        {{ $data->links('pagination::bootstrap-4') }}
                        <!-- {{$data->links()}} -->

                        <a href="{{ url('/admin/blog/add') }}">
                            <button type="button" class="btn btn-primary">Add blog</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection