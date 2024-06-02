app.auth = {
    http: {},

    redirectTo(uri = '/') {
        window.location.href = uri;
    },

    setMessage(msg) {
        const el = document.querySelector('#auth-msg');
        if (!el) return;

        if (msg) {
            msg = `<div class="alert alert-danger">${msg}</div>`;
        }

        el.innerHTML = msg;
    },

    setErrors(errs) {
        for (let name in errs) {
            const el = document.querySelector(`[name=${name}]`);
            if (el) {
                el.classList.add('is-invalid');

                el.addEventListener('focus', () => {
                    el.classList.remove('is-invalid');
                }, false)
            }
        }
    },

    setErrorResponse(response) {
        if (!response) return;
        
        const { data } = response;

        this.setMessage(data.message);
        this.setErrors(data.errors);
        
    },

    async login(data) {

        this.setMessage('');

        try{
            const resp = await this.http.post('login', data);
            const rdata = resp.data.data;
    
            this.redirectTo(rdata.redirect);

        } catch (e) {
            this.setErrorResponse(e.response);
        }

    },

    async logout() {
        const resp = await this.http.get('logout');
        const rdata = resp.data.data;

        this.redirectTo(rdata.redirect);
    },

    async register(data) {
        this.setMessage('');

        try {

            const resp = await this.http.post('register', data);
            const rdata = resp.data.data;
    
            this.redirectTo(rdata.redirect);

        } catch (e) {
            this.setErrorResponse(e.response);
        }

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

app.auth.init();