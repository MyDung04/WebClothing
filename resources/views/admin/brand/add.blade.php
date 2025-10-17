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

                        <h1>Add Brand</h1>

                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Title</label>

                                <input type="text" name="name" id="name" class="form-control">
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