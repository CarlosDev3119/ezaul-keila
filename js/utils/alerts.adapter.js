

export const alerts = {

    confirm: (title = '', text='', icon='') => {
        return Swal.fire({
            title: title,
            text: text,
            icon: icon
        });
    }

}