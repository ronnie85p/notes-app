app.profile = {
    async update(event) {
        const form = new app.Form(event.target, {
            url: '/api/v1/profile',
            method: 'PUT',
        });

        console.log('updating...');

        const resp = await form.submit(event).catch(error => {
            throw error;
        });

        console.log('response', resp);
    },

    async delete(event) {
        const form = new app.Form(event.target, {
            url: '/api/v1/profile',
            method: 'DELETE',
        });

        console.log('updating...');

        const resp = await form.submit(event).catch(error => {
            throw error;
        });

        console.log('response', resp);
    },

    async updatePassword(event) {
        const form = new app.Form(event.target, {
            url: '/api/v1/profile/password',
            method: 'PUT',
        });

        console.log('updating...');

        const resp = await form.submit(event).catch(error => {
            throw error;
        });

        console.log('response', resp);
    }
};