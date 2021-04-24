<a href="{{ route('bangunan.editinternal',$model)}}" class="btn blue accent-4 waves-effect waves-solid"><i class="material-icons">edit</i></a>
<button href="{{ route('bangunan.destroyinternal',$model)}}" class="btn orange accent-4 waves-effect waves-solid" id="delete"><i class="material-icons">delete_forever</i></button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $('button#delete').on('click', function(e){
        e.preventDefault();

        var href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data tidak akan bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').action =href;
                document.getElementById('deleteForm').submit();

                Swal.fire(
                'Terhapus!',
                'Data telah berhasil dihapus.',
                'success'
            )
        }
        })
    })
</script>