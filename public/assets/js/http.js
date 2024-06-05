app.http = {
    apiPath: 'api',
    apiVer: '1',

    requestOptions: {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    },

    /**
     * Получить csrf токен
     */
    getCsrfToken() {
        return document
            .querySelector("meta[name='csrf']")
            ?.getAttribute("content");
    },

    getRequestMethod(method) {
        switch (method) {
            case 'POST':
            case 'PUT':
                contentType = 'multipart/form-data';
                method = 'POST';

                data.set('_method', 'PUT');

        }
    },

    getRequestMethod(method) {
        return method.toUpperCase() === 'PUT' ? 'POST' : method;
    },

    getContentType(method) {
        let contentType = 'application/json';
        switch (method) {
            case 'POST':
                contentType = 'multipart/form-data';
        }

        return contentType;
    },

    getRequestData(method) {
        if (method === 'POST') {
            ret
        }
    },

    request(method, controller, data, options = {}) {

        let requestMethod = this.getRequestMethod(method);
        let contentType = this.getContentType(requestMethod);
        let data = this.getRequestData(requestMethod, data);

        return axios({
            url: `/${this.apiPath}/v${this.apiVer}/${controller}`,
            data,
            method,
            ...this.requestOptions,
            ...options
        });
    },

    get(controller, options) {
        return this.request('GET', controller, options);
    },

    post(controller, data, options) {
        return this.request('POST', controller, options);
    },

    put(controller, options) {
        return this.request('PUT', controller, options);
    },

    delete(controller, data, options) {
        return this.request('DELETE', controller, options);
    }

};

app.Http = function (options) {
    this.options = {
        prefixUri: '',
        ...options
    };

    this.prefixUri = this.options.prefixUri || '';
    
    this.get = function (uri, options = {}) {
        return axios.get(this.prefixUri + uri, options);
    };

    this.post = function (uri, data, options = {}) {
        options = {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
            ...options
        };

        return axios.post(this.prefixUri + uri, data, options);
    };

    this.put = function(uri, id, data, options = {}) {
        options = {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            ...options
        };

        data.set('_method', 'PUT');

        return this.post(uri + `/${id}`, data, options);
    };

    this.delete = function(uri, id, options = {}) {
        return axios.delete(this.prefixUri + uri + `/${id}`, options);
    };

    return this;
}