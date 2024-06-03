app.profile = {
    update(event) {
        const form = new app.Form(event.target, {
            url: '/profile',
            method: 'PUT',
        });

        console.log('update...');

        form.submit(event).then(response => {
            console.log('response', response)
        });
    },
};