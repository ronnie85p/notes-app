app.auth = {
    http: {},

    redirectTo(uri = '/') {
        window.location.href = uri;
    },

    async login(data) {
        const resp = await this.http.post('login', data);
        const rdata = resp.data.data;

        this.redirectTo(rdata.redirect);
    },

    async logout() {
        const resp = await this.http.get('logout');
        const rdata = resp.data.data;

        this.redirectTo(rdata.redirect);
    },

    async register(data) {
        const resp = await this.http.post('register', data);
        const rdata = resp.data.data;

        this.redirectTo(rdata.redirect);
    },

    init() {

        this.http = new app.Http({
            prefixUri: '/api/v1/auth/'
        });

        const typeForms = document.querySelectorAll('#auth-login, #auth-logout, #auth-register');

        for (const form of typeForms) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
   
                this[form.id.replace('auth-', '')](new FormData(e.target));
            }, false);   
        }

    }
}