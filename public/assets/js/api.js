const apiResources = {
    books: 'books',
    categories: 'categories',
    profileSettings: 'profile/settings',
    feedbacks: 'feedbacks'
};

const restApi = {
    prefix: 'api',
    url: '',

    getList(options = {}) {
        return http.get(`/${this.prefix}/${this.url}`, options);
    },

    get(id, options = {}) {
        return http.get(`/${this.prefix}/${this.url}/${id}`, options);
    },

    store(data, options = {}) {
        return http.post(`/${this.prefix}/${this.url}`, data, options);
    },

    update(id, data, options = {}) {
        return http.put(`/${this.prefix}/${this.url}/${id}`, data, options);
    },

    delete(id, options = {}) {
        return http.delete(`/${this.prefix}/${this.url}/${id}`, options);
    }
};

http.api = {};
for(let key in apiResources) {
    http.api[key] = {
        ...restApi,
        url: apiResources[key]
    };
}