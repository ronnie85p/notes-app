var common_ = {
    csrf_token: null,

    init() {

        const forms = document.querySelectorAll('.form');
        forms.forEach(form => common.initForm(form));
        
        const categories = document.getElementById('categories');
        if (categories) {
            common.Category.getList(categories);
        }

        const books = document.getElementById('books');
        if (books) {
            common.Books.getList(books);
        }

        const book = document.getElementById('book');
        if (book) {
            common.Books.loadPage(book);
        }

        const feedback = document.getElementById('feedback');
        if (feedback) {
            feedback.addEventListener('submit', common.feedback.submit, false);
        }

        const profileFeedbacks = document.getElementById('profile-feedbacks');
        if (profileFeedbacks) {
            common.profile.feedback.getList(profileFeedbacks);
        }

        const profileSettingsForm = document.getElementById('profile-settings-form');
        if (profileSettingsForm) {
            common.profile.settings.getData(profileSettingsForm);
        }

        const profileBooks = document.getElementById('profile-books');
        if (profileBooks) {
            common.profile.books.getList(profileBooks);
        }

        const profileCategories = document.getElementById('profile-categories');
        if (profileCategories) {
            common.profile.category.getList(profileCategories);
        }

        const profileBookEdit = document.getElementById('profile-book-edit-form');
        if (profileBookEdit) {
            common.profile.books.getItem(profileBookEdit);
        }
    },

    forms: {
        'profile-settings-form': (event) => common.profile.settings.save(event),
        'profile-book-create-form': (event) => common.profile.books.create(event),
        'profile-book-edit-form': (event) => common.profile.books.edit(event),
    },

    initForm(form) {
        const id = form.getAttribute('id');
        if (id in this.forms) {
            form.addEventListener('submit', this.forms[id], false);
        }
    },

    getCSRFToken() {
        if (!this.csrf_token) {
            this.csrf_token = document
            .querySelector("meta[name='csrf-token']")
            ?.getAttribute("content");
        }

        return this.csrf_token;
    },

    getPreloader(options = {}) {
        let _options = {
            context: null,
            message: '',
            template: `<div class=""></div>`,
            ...options
        };

        let _methods = {
            isShown: false,
            isContext: _options.context instanceof HTMLElement,

            setMessage(message) {
                _options.message = message;
            },

            show() {
                if (this.isContext) {
                    _options.context.innerHTML = _options.message;
                    this.isShown = true;
                }
            },

            hide() {
                if (this.isShown) {
                    _options.context.innerHTML = '';
                    this.isShown = false;
                }
            }
        };

        if (_options.context) {
            if (_options.message) {
                _methods.setMessage(_options.message);
            }
        }

        return _methods;
    },

    request(url, options = {}) {
        const _options = {
            method: 'GET',
            responseType: "json",
            headers: {
                "Content-Type": options.contentType || "application/json",
                "X-CSRF-TOKEN": this.getCSRFToken(),
            },
            preloader: {},
            ...options
        };

        const preloader = common.getPreloader(_options.preloader);
        preloader.show();

        return axios(url, _options).then(response => {
            const data = response.data;
            if (data.result?.url) {
                window.location.href = data.result.url;
            }

            return response.data;
        }).finally(() => {
            if (preloader.isShown) {
                preloader.hide();
            }
        });
    },

    getUrl() {
        return new URL(window.location.href);
    },

    getSearchParams() {
        return this.getUrl().searchParams;
    },

    getForm(form) {
        const url = form.getAttribute('action');
        const method = form.getAttribute('method');
        const data = new FormData(form);

        const _methods = {
            getElement(name) {
                return form.elements[name];
            },

            setMessage(msg) {
                const fm = form.querySelector('.form-message');
                if (fm) {
                    fm.classList[msg ? 'add': 'remove']('show');
                    fm.innerHTML = msg;
                }
            },

            setFeedback(elem, message) {
                const fb = elem.parentNode.querySelector('.invalid-feedback');
                if (!fb) return;
        
                fb.innerText = message;
            },

            setError(elem, msg) {
                elem.classList.add('is-invalid');
                this.setFeedback(elem, msg);
            },

            resetError(elem) {
                elem.classList.remove('is-invalid');
                this.setFeedback(elem, '');
            },
        
            setErrors(errors) {
                for (let k in errors) {
                    const msgs = errors[k];
                    const elem = this.getElement(k);

                    if (elem) {
                        this.setError(elem, msgs[0]);
                    }
                }
            },

            resetErrors() {
                const elems = form.querySelectorAll('.is-invalid');
                elems.forEach(elem => this.resetError(elem));
            },

            resetFields() {
                this.setMessage('');
                this.resetErrors();
            },

            setFields(message, errors) {
                this.setMessage(message);
                this.setErrors(errors);
            },

            submit(event) {
                event.preventDefault();

                this.resetFields();
                event.submitter.classList.add('disabled');
                return common.request(url, {
                    contentType: 'multipart/form-data',
                    preloader: { },
                    method,
                    data
                }).catch(error => {
                    const data = error.response?.data;
    
                    if (data) {
                        this.setFields(data.message, data.errors);
                    }
                }).finally(() => {
                    event.submitter.classList.remove('disabled');
                });
            }
        };

        return _methods;
    },

    feedback: {
        submit(event) {
            const form = common.getForm(event.target);
            form.submit(event);
        }
    },



    // profile
    profile: {
        books: {
            delete(id) {
                common.book.delete(id).then(data => {
                    console.log('book.delete', id, data)
                });
            },

            store(form, event) {
                event.preventDefault();

                common.book.store(new FormData(form)).then(data => {
                    console.log('book.store', data);
                });
            },

            edit(id) {
                common.book.get(id).then(data => {
                    console.log('book.edit', id, data);
                });
            },

            getList() {
                const params = common.getSearchParams();

                common.book.getList(params).then(data => {
                    console.log('book.getList', data);
                });
            },

            getItem(container) {
                const url = new URL(window.location.href);
                const id = url.pathname.replace(/\D+/, '');
    
                return common.request(`/api/book/${id}`)
                    .then(response => {
                        if (response.result) {
                            for (let key in response.result) {
                                const value = response.result[key];
                                const elem = container.querySelector(`[name=${key}]`);

                                if (elem) {
                                    switch (elem.nodeName) {
                                        case 'INPUT':
                                        case 'SELECT':
                                            elem.value = value;
                                            break;
                                        default:
                                            elem.innerHTML = value;
                                    }
                                }
                            }
                        }
                    });
            },

            getList(container) {
                common.request('/api/book', {
                    params: common.getSearchParams(),
                    preloader: {
                        context: container,
                        message: 'Загружаем...'
                    }
                })
                    .then(response => {
                        let output = '';
    
                        if (response.result && Object.keys(response.result).length) {
                            for (let i in response.result) {
                                let item = response.result[i];
                                output += `<div class="border-bottom py-4">
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="/${item.thumbnail_url}" />
                                        </div>
                        
                                        <div class="col">
                                            <div class="text-muted">${item.category.name}</div>
                                            <h2 class="flex-grow-1 h4">
                                                <a href="/profile/book/${item.id}">${item.title}</a>
                                            </h2>
                                            <p class="text-muted">${item.short_description}</p>
                                            <p class="text-warning">${item.status.name}</p>
                                            <p>
                                                <a class="text-muted mr-2" href="/profile/book/${item.id}">
                                                    Редактировать
                                                </a>

                                                <a class="text-danger" 
                                                    href="/profile/book/${item.id}" 
                                                    onclick="common.book.delete(this, ${item.id})">
                                                        Удалить
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>`;
                            }
                        } else {
                            output = '<div class="text-center">Нет данных для вывода</div>';
                        }
    
                        container.innerHTML = output;
                    });
            }
        },

        feedback: {
            getList(container) {
                common.request('/api/feedback', {
                    params: common.getSearchParams(),
                    preloader: {
                        context: container,
                        message: 'Загружаем...'
                    }
                })
                    .then(response => {
                        let output = '';
    
                        if (response.result && Object.keys(response.result).length) {
                            for (let i in response.result) {
                                let item = response.result[i];
                                output += `<div class="border-bottom py-4">
                                    <div class="mb-2"><i class="fas fa-user"></i> ${item.name}</div>
                                    <div class="mb-2"><i class="fas fa-envelope"></i> ${item.email}</div>
                                    <div class="mb-2"><i class="fas fa-phone"></i> ${item.phone}</div>
                                    <div class="mb-2 text-muted">Сообщение: ${item.message}</div>
                                    <div class="text-muted"><i class="fas fa-clock"></i> ${item.created_at}</div>
                                </div>`;
                            }
                        } else {
                            output = '<div class="text-center">Нет данных для вывода</div>';
                        }
    
                        container.innerHTML = output;
                    });
            }
        },

        settings: {
            save(event) {
                event.target.action = '/api/settings';
                event.target.method = 'post';

                const form = common.getForm(event.target);
                form.submit(event);
            },

            getData(container) {
                common.request('/api/settings')
                    .then(response => {
                        if (response.result) {
                            for (let key in response.result) {
                                container.querySelector(`[name=${key}]`)?.setAttribute('value', response.result[key]);
                            }
                        }
                    });
            }
        },

        category: {
            getList(container) {
                common.request('/api/category', {
                    params: common.getSearchParams(),
                    preloader: {
                        context: container,
                        message: 'Загружаем...'
                    }
                })
                    .then(response => {
                        let output = '';
    
                        if (response.result && Object.keys(response.result).length) {
                            for (let i in response.result) {
                                let item = response.result[i];
                                output += `<div class="mb-2 border p-2">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">${item.name}</div>
                                        <div><a href="" class="text-danger">Удалить</a></div>
                                    </div>
                                </div>`;
                            }
                        } else {
                            output = '<div class="text-center">Нет данных для вывода</div>';
                        }
    
                        container.innerHTML = output;
                    });
            }
        }
    }
}