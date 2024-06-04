window.app = {

    setup() {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }

};

window.app.setup();