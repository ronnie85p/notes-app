window.app = {

    csrf_token: null,

    getCSRFToken() {
        if (!this.csrf_token) {
            this.csrf_token = document
            .querySelector("meta[name='csrf']")
            ?.getAttribute("content");
        }

        return this.csrf_token;
    },

    setup() {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = this.getCSRFToken();
    }

};

window.app.setup();