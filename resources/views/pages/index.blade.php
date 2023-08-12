
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>KenanganSenja</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/css/our.css')}}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
 
    <div class="alerts" id="toast">
        Terimakasih, Pesanan segera diantar!
    </div>
    <div class="alerts" id="toast-error">
      Isi Input Dengan Benar (Refresh Terlebih Dahulu!)
    </div>

    {{-- Jumbotron --}}
        <div>
           <div class="jumbotron">
                <h1>Selamat Datang di KenanganSenja <br/>
                Silahkan Menikmati Kopi buatan Kami</h1>
                <div class="black"></div>
           </div>
        </div>
    {{-- End Jumbotron --}}

    {{-- List Menu --}}
        <div class="menu">
            <div class="judul-menu">
                <h1>
                    Daftar Menu :
                </h1>
            </div>
           <div class="sub-menu">
                @if(count($data) > 0)
                @foreach($data as $item)
                    <div class="cards" style="width: 18rem;">
                        <img src="{{ Storage::url($item->img) }}" class="card-img-top" alt="{{ $item->coffee }}" height="200">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; font-size: 2rem; text-decoration: underline">{{ $item->coffee }}</h5>
                            <p class="card-text">{{ $item->desc }}</p>
                            <p class="card-text">IDR: {{ $item->price }}</p>
                        <div class="button">
                            <button class="btn btn-btn button-add" data-bs-target="#exampleModal{{ $item->id }}">Pesan Sekarang</button>
                           <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content modal-pesan">
                                        <form>
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan Sekarang</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="hidden" id="coffee_id" value="{{ $item->id }}" name="coffee_id">
                                                        <label for="nama" class="form-label text-white">Atas Nama</label>
                                                        <input type="text" class="form-control text-white" id="nama" name="nama" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="meja" class="form-label text-white">Nomor Meja</label>
                                                        <input type="number" class="form-control text-white" name="meja" id="meja" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jumlah" class="form-label text-white">Jumlah Pesanan</label>
                                                        <input type="number" class="form-control text-white" name="jumlah" id="jumlah" required>
                                                    </div>
                                                </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-pesan">Pesan</button>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="w-full">
                    <h3>
                        Belum Ada Menu
                    </h3>
                </div>
                @endif
            </div>
        </div>
    {{-- End List Menu --}}


    {{-- Footer --}}
    <div class="footer">
        copyright@adamramdaniyunus
    </div>
    {{-- End Footer --}}



  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.1/socket.io.js"></script>
  <script type="module">
    // import io from 'socket.io-client';

        // url dari node js
        const socket = io('http://localhost:5000')
        
        // ini untuk token secara global
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // ini untuk modal, dan membuat sebuah permintan ke pesanan
        $('body').on('click', '.button-add', function(e){
            e.preventDefault()
            const modalId = $(this).data('bs-target') 
            $(modalId).modal('show');

            $(modalId).find('.btn-pesan').one('click', function() {
                    // console.log([coffee_id, nama, meja, jumlah]);
                    $.ajax({
                        url: 'pesanan',
                        type: 'POST',
                        data: {
                            coffee_id : $(modalId).find('#coffee_id').val(),
                            nama : $(modalId).find('#nama').val(),
                            meja : $(modalId).find('#meja').val(),
                            jumlah : $(modalId).find('#jumlah').val(),
                        },
                        success:function(response) {
                            $(modalId).modal('hide');
                            $(modalId).find('#coffee_id').val('');
                            $(modalId).find('#nama').val('');
                            $(modalId).find('#meja').val('');
                            $(modalId).find('#jumlah').val('');
                            
                            // Kirim data ke WebSocket
                            socket.emit('Order', response);

                            const alert = $('#toast');
                            alert.addClass('hide');

                            setTimeout(() => {
                                alert.removeClass('hide');
                            }, 2000);


                            // console.log(response);
                        },

                        error: function() {
                            $(modalId).modal('hide');
                            $(modalId).find('#coffee_id').val('');
                            $(modalId).find('#nama').val('');
                            $(modalId).find('#meja').val('');
                            $(modalId).find('#jumlah').val('');
                            const alert = $('#toast-error');
                            alert.addClass('hide');

                            setTimeout(() => {
                                alert.removeClass('hide');
                            }, 2000);

                        }
                    })

            })
        })
  </script>
</body>

</html>