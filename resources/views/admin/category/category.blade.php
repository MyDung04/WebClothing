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
                                    <th class="border-top-0">NAME</th>
                                    <th class="border-top-0">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $category)
                                <tr>

                                    <td class="txt-oflo">{{$category->id}}</td>
                                    <td><span class="txt-oflo">{{$category->name}}</span> </td>
                                    <td>
                                        <div><a href="{{ url('/admin/category/edit/'.$category->id)}}">Edit</a></div>
                                        <div><a href="{{ url('/admin/category/delete/'.$category->id)}}">Delete</a>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach


                            </tbody>

                        </table>
                        <a href="{{ url('/admin/category/add') }}">
                            <button type="button" class="btn btn-primary">Add Category</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection