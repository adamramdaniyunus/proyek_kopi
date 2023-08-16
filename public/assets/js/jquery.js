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