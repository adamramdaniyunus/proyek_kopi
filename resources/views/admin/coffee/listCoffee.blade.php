@extends('admin.layout')
@section('content')
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Coffee</h5>
                <button type="button" class="btn btn-success p-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Coffee
                </button>
                <div class="table-responsive py-2">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="fs-4 bg-primary">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Coffee</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Price</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold text-light mb-0">Preview</h6>
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
                                    <h6 class="fw-semibold mb-1">{{ $item->coffee }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">IDR: {{ $item->price }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <img src="{{ Storage::url($item->img) }}" alt="{{ $item->coffee }}" width="100">
                                </td>
                                <td class="border-bottom-0">
                                    <a href="/admin/coffees/{{ $item->id }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>
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
                                                        <form action="/admin/coffees/{{ $item->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="py-4 d-flex justify-content-center">
                                                               <h4>Yakin ingin menghapus data menu?</h4>
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
                                <td colspan="10" class="text-center">Belum ada menu</td>
                            </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Coffee</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <form action="/admin/coffees" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Coffee</label>
                                            <input type="text" class="form-control" id="coffee" aria-describedby="emailHelp" name="coffee" placeholder="Coffee">
                                            </div>
                                            <div class="mb-3">
                                                <label for="rumahSakit" class="form-label" id="labelRumahSakit">Price</label>
                                                <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                                            </div>
                                            <div class="d-flex flex-column">
                                            <div class="mb-3">
                                                <label for="desc" class="form-label">Description</label>
                                                <input type="text" id="desc" class="form-control" name="desc" placeholder="Description">
                                            </div>
                                            <div class="mb-3">
                                                <label for="img" class="form-label">Image</label>
                                                <input type="file" id="img" class="form-control" name="img" placeholder="Description">
                                            </div>
                                        </div>
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                    </form>
                                </div>
                            </div>
                    </div>
               </div>
            </div>
@endsection  