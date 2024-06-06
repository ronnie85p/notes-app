window.app = {

    csrfToken: null,
        
    /**
     * Получить csrf токен
     */
    getCsrfToken() {
        if (!this.csrfToken) {
            this.csrfToken = document
                .querySelector("meta[name='csrf']")
                ?.getAttribute("content");
        }
    
        return this.csrfToken;
    },

    setup() {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = this.getCsrfToken();
    }

};

window.app.setup();