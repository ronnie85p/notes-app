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