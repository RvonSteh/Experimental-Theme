class NpThemeScript {
    constructor() {
        this.$root = document;
        this.$createTableForm = this.$root.querySelectorAll('.create-data-form');
        this.$body = this.$root.body;
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
                this.sendData(form, formData);
            });
        });

    }

    sendData(form, formData) {
        this.$body.classList.add('-loading');
        jQuery.ajax({
            type: 'POST',
            url: np.ajax_url,
            data: {
                action: 'create_db_user_data',
                'user_data': formData
            },
            success: (response) => {
                const usernameInput = form.querySelector('input#username');
                const inputFields = form.querySelectorAll('input');
                const user_exists = response.data.user_exists;
                if (user_exists) {
                    usernameInput.classList.add('error');
                } else {
                    inputFields.forEach(input => {
                        input.value = input.value + ' ✅';
                    });
                }
                this.$body.classList.remove('-loading');
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