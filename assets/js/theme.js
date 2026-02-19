class NpThemeScript {
    constructor() {
        this.$root = document;
        this.$createTableForm = this.$root.querySelectorAll('.create-data-form');
    }
    mount() {
        this.getFormData();
    }
    getFormData() {

        this.$createTableForm.forEach(form => {
            const button = form.querySelector('button');
            const inputFields = form.querySelectorAll('input');

            button.addEventListener('click', (e) => {
                e.preventDefault();
                let formData = {};

                inputFields.forEach(input => {
                    const value = input.value;
                    const label = input.id;
                    formData[label] = value;
                });
                this.sendData(formData);
            });
        });

    }

    sendData(formData) {

        jQuery.ajax({
            type: 'POST',
            url: np.ajax_url,
            data: {
                action: 'create_db_user_data',
                'user_data': formData
            },
            success: (response) => {
                console.log(response.data.message)
            },
            error: () => {

            }
        })
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const loadNpThemeScript = new NpThemeScript();
    loadNpThemeScript.mount();
})