const http = {
    csrf_token: null,

    getCSRFToken() {
        if (!this.csrf_token) {
            this.csrf_token = document
            .querySelector("meta[name='csrf-token']")
            ?.getAttribute("content");
        }

        return this.csrf_token;
    },

    getUrl() {
        return new URL(window.location.href);
    },

    getSearchParams() {
        return this.getUrl().searchParams;
    },

    request(method, url, data, options = {}) {
        switch (method) {
            case 'put':
            case 'post':

                if (data instanceof FormData) {
                    options.contentType = 'multipart/form-data';
                }

                break;
        }

        const _options = {
            method,
            data,
            responseType: "json",
            headers: {
                "Content-Type": options.contentType || "application/json",
                "X-CSRF-TOKEN": this.getCSRFToken(),
            },
            ...options
        };
        console.log('_options', _options)
        return axios(url, _options)
            .then(response => response.data);
    },

    delete(url, options = {}) {
        return this.request('DELETE', url, options);
    },

    post(url, data, options = {}) {
        return this.request('POST', url, data, options);
    },

    put(url, data, options = {}) {
        return this.request('PUT', url, data, options)
    },

    get(url, options = {}) {
        return this.request('GET', url, null, options);
    }
};