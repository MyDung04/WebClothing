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
                                @foreach($data as $country)
                                <tr>

                                    <td class="txt-oflo">{{$country->id}}</td>
                                    <td><span class="txt-oflo">{{$country->name}}</span> </td>
                                    <td>
                                        <div><a href="{{ url('/admin/country/edit/'.$country->id)}}">Edit</a></div>
                                        <div><a href="{{ url('/admin/country/delete/'.$country->id)}}">Delete</a></div>
                                    </td>

                                </tr>
                                @endforeach


                            </tbody>

                        </table>
                        <a href="{{ url('/admin/country/add') }}">
                            <button type="button" class="btn btn-primary">Add Country</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection