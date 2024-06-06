app.apiHttp = {
    ver: 1,
    path: '/api',
    csrfToken: null,

    defaultOptions: {
        url: '',
        method: 'GET',
        contentType: 'application/json',
        data: {},
        headers: {}
    },

    requestData: {
        data: null,

        set(data) {
            this.data = data;
        },

        setValues(values) {
            for (let key in values) {
                let value = values[key];
    
                if (this.data instanceof FormData) {
                    this.data.set(key, value);
                } else if (typeof this.data === 'object') {
                    this.data[key] = value;
                }
            }
        },
    },

    getRequestMethod(method) {
        method = method.toUpperCase();
        if (method === 'PUT') {
            method = 'POST';

            this.requestData.setValues({ _method: 'PUT' });
        }

        return method;
    },

    getContentType(data) {
        let contentType = 'application/json';
        if (data instanceof FormData) {
            contentType = 'multipart/form-data';
        }

        return contentType;
     },

    getFullUrl(uri) {
        return new URL(`${this.path}/v${this.ver}/${uri}`, window.location.origin);
    },

    request(resource, options) {
        const defaultOptions = {
            ...this.defaultOptions,
            ...options
        };

        this.requestData.set(defaultOptions['data']);

        defaultOptions['url'] = this.getFullUrl(resource);
        defaultOptions['method'] = this.getRequestMethod(defaultOptions['method']);
        defaultOptions['headers']['Content-Type'] = defaultOptions['contentType'] || 'application/json';
        // this.getContentType(defaultOptions['data']);

        return axios(defaultOptions)
            .then(response => response.data)
            .catch(error => {
                // etc...

                throw error;
            });
    },

    get(uri, options) {
        return this.request(uri, { method: 'GET', ...options });
    },

    put(uri, options) {
        return this.request(uri, { method: 'PUT', ...options });
    },

    post(uri, options) {
        return this.request(uri, { method: 'POST', ...options });
    },

    delete(uri, options) {
        return this.request(uri, { method: 'DELETE', ...options });
    },
};