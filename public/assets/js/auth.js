app.auth = {
    async login(event) {
        (new app.Form(event.target, {
            resource: 'auth',
            method: 'POST',
        })).submit(event);
    },

    async logout(event) {
        (new app.Form(event.target, {
            resource: 'auth/logout',
            method: 'GET',
        })).submit(event);
    },

    async register(event) {
        (new app.Form(event.target, {
            resource: 'auth/register',
            method: 'POST',
        })).submit(event);
    }
}