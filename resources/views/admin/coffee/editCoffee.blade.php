@extends('admin.layout')
@section('content')
            <div class="card-body p-4">
                <div class="">
                    <form action="/admin/update/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Coffee</label>
                            <input type="text" class="form-control" id="coffee" aria-describedby="emailHelp" name="coffee" placeholder="Coffee" value="{{ $data->coffee }}">
                        </div>
                        <div class="mb-3">
                            <label for="rumahSakit" class="form-label" id="labelRumahSakit">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{ $data->price }}">
                        </div>
                        <div class="d-flex flex-column">
                           <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <input type="text" id="desc" class="form-control" name="desc" placeholder="Description" value="{{ $data->desc }}">
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Image</label>
                                <input type="file" id="img" class="form-control" name="img" placeholder="Description" value="{{ $data->img }}">
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection  