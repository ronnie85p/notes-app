app.auth = {
    async login(event) {
        (new app.Form(event.target, {
            url: '/api/v1/auth',
            method: 'POST',
        })).submit(event);
    },

    async logout(event) {
        (new app.Form(event.target, {
            url: '/api/v1/auth/logout',
            method: 'GET',
        })).submit(event);
    },

    async register(event) {
        (new app.Form(event.target, {
            url: '/api/v1/auth/register',
            method: 'POST',
        })).submit(event);
    }
}