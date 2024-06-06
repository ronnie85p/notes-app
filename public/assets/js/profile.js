app.profile = {
    async update(event) {
        (new app.Form(event.target, {
            resource: 'profile',
            method: 'PUT',
        })).submit(event);
    },

    async delete(event) {
        (new app.Form(event.target, {
            resource: 'profile',
            method: 'DELETE',
        })).submit(event);
    },

    async updatePassword(event) {
        (new app.Form(event.target, {
            resource: 'profile/password',
            method: 'PUT',
        })).submit(event);
    }
};