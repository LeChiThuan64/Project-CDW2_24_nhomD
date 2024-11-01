@extends('viewAdmin.navigation')

@section('title', 'Contact')

@section('content')




<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Vocher</h6>
        </div>
      </div>
      <div class="row p-3">
        <!-- Thanh tìm kiếm -->
        <div class="col-md-5">
          <form action="#" method="GET">
            <div class="input-group">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <input type="text" name="search" class="form-control" placeholder="Tìm kiếm khách hàng..." aria-label="Tìm kiếm khách hàng" value="#">
            </div>
          </form>
        </div>

        <div class="col-md-2 text-right">
          <a href="#" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i>
          </a>
        </div>

      </div>


      <!-- Nút dấu cộng -->
    </div>

    <div class="card-body px-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên vocher  </th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> mô tả</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">giảm giá</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> ngày bắt đầu</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> ngày kết thúc</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Cho</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
          </thead>

          <tr>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">#</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">#</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">#</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">#</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">#</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">#</h6>
                </div>
              </div>
            </td>
            <td class="actions" style="text-align: center;">
         
              <button type="button" class="btn btn-warning btn-sm px-3" style="border-radius: 5px; font-size: 14px;"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <i class="fas fa-eye"></i> Xóa
              </button>
              <button type="button" class="btn btn-warning btn-sm px-3" style="border-radius: 5px; font-size: 14px;"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <i class="fas fa-eye"></i> Xem
              </button>


              
            </td>
          </tr>


        </table>
      </div>
    </div>
  </div>
</div>



@endsection