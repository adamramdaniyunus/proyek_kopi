@extends('admin.layout')
@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Pesanan</h5>
                <div class="table-responsive py-2">
                  <table class="table text-nowrap mb-0 align-middle" id="myta">
                    <thead class="fs-4 bg-primary">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Nama</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Meja</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Jumlah Pesanan</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Menu</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Action</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($data) > 0)
                          @foreach($data as $item)
                            <tr>
                                <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}.</h6></td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $item->nama }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">No: {{ $item->meja }}</p>
                                </td>
                                <td class="border-bottom-0">
                                     <p class="mb-0 fw-normal">{{ $item->jumlah }}</p>
                                </td>
                                <td class="border-bottom-0">
                                     <p class="mb-0 fw-normal">{{ $item->coffee->coffee }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
                                           <i class="bi bi-trash3-fill"></i>
                                        </button>

                                    <div class="modal fade" id="hapus{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Coffee</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                    <div class="modal-body">
                                                        <form action="/admin/order/{{ $item->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="py-4 d-flex justify-content-center">
                                                               <h4>Yakin ingin menghapus data pesanan?</h4>
                                                            </div>
                                                                <button type="submit" class="btn btn-danger" >Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else 
                           <tr>
                                <td colspan="10" class="text-center">Belum ada pesanan</td>
                            </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
      {{-- <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

      <script>
        $(document).ready(function(){
          $('#myTable').DataTable({

          })
        })
      </script> --}}
@endsection  