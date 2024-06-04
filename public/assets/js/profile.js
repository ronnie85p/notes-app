app.profile = {
    async update(event) {
        const form = new app.Form(event.target, {
            url: '/profile',
            method: 'PUT',
            submitterMuted: false
        });

        console.log('updating...');

        const resp = await form.submit(event).catch(error => {
            throw error;
        });

        console.log('response', resp);
    },

    delete(event) {
        const form = new app.Form(event.target, {
            url: '/profile',
            method: 'DELETE',
        });

        console.log('deleting...');

        form.submit(event).then(response => {
            console.log('response', response)
        });
    },

    updatePassword(event) {
        const form = new app.Form(event.target, {
            url: '/profile/password',
            method: 'PUT',
        });

        console.log('updating...');

        form.submit(event).then(response => {
            console.log('response', response)
        });
    }
};