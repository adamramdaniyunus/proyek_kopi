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
                    <tbody id="list">
                    </tbody>
                  </table>
                  {{-- modal --}}
                  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Hapus Pesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus pesanan ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
              </div>
              <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
              {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.1/socket.io.js"></script> --}}
              <script>

                 // ini untuk token secara global
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  })

                  // update orderlist agar list terus terupdate
                 function updateOrderList(orders) {
                      const orderList = document.getElementById('list');
                      orderList.innerHTML = '';

                      orders.forEach((order, index) => {
                          const row = document.createElement('tr');
                          // Menampilkan data
                          row.innerHTML = `
                              <td>${index + 1}</td>
                              <td>${order.nama}</td>
                              <td>${order.meja}</td>
                              <td>${order.jumlah}</td>
                              <td>${order.coffee.coffee}</td>
                              <td>
                                  <button class="btn btn-danger btn-delete" data-order-id="${order.id}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                              </td>
                          `;
                          orderList.appendChild(row);
                      });
                  }

                  // fetch data
                  function fetchOrders() {
                      fetch('/admin/api/orders')
                          .then(response => response.json())
                          .then(data => updateOrderList(data))
                          .catch(error => console.error(error));
                  }

                  // Tampilkan data setiap 1 detik
                  setInterval(fetchOrders, 1000);

                  fetchOrders();

                  $('body').on('click', '.btn-delete', function() {
                      const orderId = $(this).data('order-id');
                      // Menyertakan ID order ketika akan menghapus
                      $('#confirmDelete').data('order-id', orderId);
                  });

                  $('#confirmDelete').on('click', function() {
                      const orderId = $(this).data('order-id');

                      $.ajax({
                          url: `/admin/order/${orderId}`,
                          type: 'GET',
                          data: {
                              _token: $('meta[name="csrf-token"]').attr('content') // Menambahkan token CSRF ke dalam data permintaan
                          },
                          success: function(response) {
                              // alert('Pesanan berhasil dihapus.');
                              $('#deleteModal').modal('hide');
                              fetchOrders(); //ketika data berhasil dihapus tampilkan lagi list datanya
                          },
                      });
                  });
              </script>
@endsection  