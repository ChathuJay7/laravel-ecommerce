@extends('main')
@section("content")

<div class="container text-center my-5">
    <h1>Admin Dashboard</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body mx-auto">
                    <a href="admin-product" class="dashboard-button product-button">Manage Products</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body mx-auto">
                    <a href="admin-user" class="dashboard-button user-button">Manage Users</a>
                </div>
            </div>
        </div>
    </div>
</div>




<style>
    .dashboard-button {
        display: block;
        width: 400px;
        height: 100px;
        margin: 10px;
        text-align: center;
        line-height: 100px;
        text-decoration: none;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        background-color: #0a3547;
        border: 2px solid #0a3547;
    }

    .dashboard-button:hover {
        background-color: #ffffff;
        color: #0a3547;
    }


</style>


@endsection
