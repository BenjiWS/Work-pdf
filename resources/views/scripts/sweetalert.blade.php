<script>

    window.addEventListener('swalmodal', event =>{
        swal({
            title:event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            timer: 2500,
            buttons:false,
        });
    });

    window.addEventListener('swalConfirm', event =>{
        swal({
            title:event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            buttons:true,
            dangerMode:true,
        })
        .then((willDelete) => {
            if(willDelete){
                window.livewire.emit('destroy', event.detail.id);
            }
        });
    });

</script>
