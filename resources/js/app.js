import Swal from 'sweetalert2';

window.Swal = Swal;

window.confirmDelete = function (event, message) {
    event.preventDefault();

    const form = event.target;

    Swal.fire({
        title: 'Konfirmasi',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, lanjutkan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#DC2626',
        cancelButtonColor: '#64748B',
        reverseButtons: true,
    }).then(function (result) {
        if (result.isConfirmed) {
            form.submit();
        }
    });

    return false;
};