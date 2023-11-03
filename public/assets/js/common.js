var common = {
    forms: {
        'feedback-form': (event) => common.feedback.send(event),
        'auth-login-form': (event) => common.auth.login(event),
        'auth-register-form': (event) => common.auth.register(event),
        'profile-settings-form': (event) => common.profile.settings.store(event),
        'profile-book-create-form': (event) => common.profile.books.store(event),
        'profile-book-edit-form': (event) => common.profile.books.update(event),
        'profile-category-create-form': (event) => common.profile.categories.store(event),
        'profile-category-edit-form': (event) => common.profile.categories.update(event),
    },

    containers: {
        'categories': (elem) => common.categories.getList(elem),
        'books': (elem) => common.books.getList(elem),
        'book': (elem) => common.books.loadPage(elem),
        'profile-settings-form': (elem) => common.profile.settings.getItem(elem),
        'profile-feedbacks': (elem) => common.profile.feedbacks.getList(elem),
        'profile-categories': (elem) => common.profile.categories.getList(elem),
        'profile-books': (elem) => common.profile.books.getList(elem)
    },

    init() {
        this.initForms();
        this.initContainers();

        const posterFile = document.getElementById('poster-file');
        common.event(posterFile, 'change', (event) =>  common.handleFile(event));

        const booksFilterForm = document.getElementById('books-filter-form');
        common.event(booksFilterForm, 'change', () => {
            window.history.pushState(null)
        });
    },

    initForms() {
        document.querySelectorAll('.form').forEach(form => {
            const id = form.getAttribute('id');

            if (id in this.forms) {
                form.addEventListener('submit', event => {
                    event.preventDefault();

                    this.forms[id](event);
                }, false);
            }
        });
    },

    initContainers() {
        for (let key in this.containers) {
            let elem = document.getElementById(key);
            if (elem) {
                this.containers[key](elem);
            }
        }
    },

    fetchList(promise, container, options = {}) {
        return promise.then(response => {
            let out = '';

            if (response.data.length !== 0) {
                if (options.listCallback) {
                    out = options.listCallback(response.data);
                } else {
                    if (options.itemCallback) {
                        for (let i in response.data) {
                            out += options.itemCallback(response.data[i]);
                        }
                    }
                }
            } else {
                out = options.emptyTpl || '';
            }

            if (options.wrapperCallback && options.wrapperCallback(response.data)) {
                out = options.wrapperCallback(out, response);
            }

            container.innerHTML = out;
        })
    },

    fetchData(promise, container, options = {}) {
        return promise.then(response => {
            let out = '';

            if (response.data) {
                if (options.dataCallback) {
                    out = options.dataCallback(response.data);
                }    
            } else {
                out = options.emptyTpl;
            }

            container.innerHTML = out;
            return response;
        });
    },

    auth: {
        login(event) {
            common.form(event.target, (data) => {
                return http.put('/api/auth', data);
            });
        },

        logout() {
            http.get('/api/auth').then(response => {
                if (response.data.url) {
                    window.location.href = response.data.url;
                }
            });
        },

        register(event) {
            common.form(event.target, (data) => {
                return http.post('/api/auth', data);
            });
        }
    },

    categories: {
        buildList(items, searchParams, has_parent = false) {
            let categories =  searchParams.get('categories')?.split(',').map(id => parseInt(id));
            let out = `<ul class="list-unstyled${has_parent ? ' ml-4' : ''}">`;

            for (let i in items) {
                let item = items[i];
                let is_active = categories?.includes(item.id);
                let inner_list = is_active || item.items.some(v => categories?.includes(v.id)) 
                    ? this.buildList(item.items, searchParams, true) : '';
                let cats = [item.id, ...item.items.map(v => v.id)];

                out += this.buildListItem(items[i], is_active, inner_list, cats);
            }
            
            out += '</ul>';
            return out;
        },

        buildListItem(item, actived, inner_list, cats) {
            return `<li>
                <a  
                    href="/books?categories=${cats}"
                    class="${actived ? 'font-weight-bold' : ''}"
                >
                    ${item.name}
                </a>

                ${inner_list}
            </li>`;
        },

        getList(container) {
            const searchParams= http.getSearchParams();

            common.fetchList(http.api.categories.getList({ params: searchParams }), container, {
                listCallback: (items) => this.buildList(items, searchParams),
                emptyTpl: '<li class="text-center">Нет данных для вывода</li>',
            });

        }, 

    },

    books: {
        buildListRowLayout(item) {
            return `<div class="border-bottom py-4">
                    <div class="row">
                        <div class="col-3">
                            <img src="${item.thumbnail_url}" />
                        </div>
        
                        <div class="col">
                            <div class="text-muted">${item.category.name}</div>
                            <h2 class="h4"><a href="/books/${item.id}">${item.title}</a></h2>
                            <p class="text-muted">${item.short_description}</p>
                            <p class="text-warning">${item.status.name}</p>
                        </div>
                    </div>
                </div>`;
        },

        buildCategoryListRowLayout(item) {
            return `<div class="col-3"><div class="card">
                <div class="card-body">
                    <div class="text-muted">${item.category.name}</div>
                    <div class="mb-2"><img src="/${item.thumbnail_url}" /></div>
                    <h2 class="h4"><a href="/books/${item.id}">${item.title}</a></h2>
                </div>
            </div></div>`;
        },

        buildDataLayout(data) {
            return `
                <div class="row">
                    <div class="col-3">
                        <img src="/${data.thumbnail_url}" />
                        <p class="text-muted">ISBN: ${data.isbn}</p>
                    </div>

                    <div class="col">
                        <h1>${data.title}</h1>
                        <p>${data.long_description}</p>
                        <p class="text-muted">Дата публикации: ${data.published_at}</p>
                    </div>
                </div>
            `;
        },

        getList(container) {
            const searchParams = http.getSearchParams();

            common.fetchList(http.api.books.getList({ params: searchParams }), container, {
                itemCallback: (item) => this.buildListRowLayout(item),
                emptyTpl: '<div class="text-center">Нет данных для вывода</div>'
            });
        },

        loadPage(container) {
            const url = new URL(window.location.href);
            const id = url.pathname.replace(/\D+/, '');

            common.fetchData(http.api.books.get(id), container, {
                dataCallback: (data) => {
                    const categoryBooks = document.getElementById('category-books');
                    if (categoryBooks) {
                        this.getCategoryList(categoryBooks, data.category_id);
                    }

                    return this.buildDataLayout(data);
                }   
            });
        },

        getCategoryList(container, categoryId) {
            common.fetchList(http.api.books.getList({ params: { category_id: categoryId} }), container, {
                itemCallback: (item) => this.buildCategoryListRowLayout(item),
                wrapperCallback: (out) => `<div class="row">${out}</div>`,
                emptyTpl: '<div class="text-center">Нет данных для вывода</div>'
            });
        },
    },

    form(form, handler) {
        const options = {
            contentType: 'multipart/form-data'
        };

        const data = new FormData(form);

        let handlers = {
            setMessage: (msg) => {
                const fm = form.querySelector('.form-message');
                if (!fm) return;
    
                fm.classList[msg ? 'add': 'remove']('show');
                fm.innerHTML = msg;
            },
    
            setFeedback: (elem, message) => {
                const fb = elem.parentNode.querySelector('.invalid-feedback');
                if (!fb) return;
        
                fb.innerText = message;
            },

            setError: (elem, msg) => {
                elem.classList.add('is-invalid');
                handlers.setFeedback(elem, msg);
            },
    
            setErrors: (errors) => {
                for (let k in errors) {
                    const elem = form.elements[k];
                    if (!elem) continue;
    
                    handlers.setError(elem, errors[k][0]);
                }
            },
    
            setErrorResponse: (response) => {
                if (!response.data) return;
                handlers.setMessage(response.data.message);
                handlers.setErrors(response.data.errors);
            },
    
            resetErrors: () => {
                handlers.setMessage('');
                form.querySelectorAll('.is-invalid').forEach(elem => {
                    elem.classList.remove('is-invalid');
                    handlers.setFeedback(elem, '');
                });
            }
        };

        handlers.resetErrors();
        form.classList.add('submitting');
        handler(data, options, handlers).then(response => {
            if (response.data.url) {
                window.location.href = response.data.url;
            }

            return response;
        }).catch(error => {
            if (error.response) {
                handlers.setErrorResponse(error.response);
            }
        }).finally(() => {
            form.classList.remove('submitting');
        });
    },

    event(node, evt, callback) {
        node?.addEventListener(evt, callback, false);
    },

    events(node, callbacks) {
        for (let evt in callbacks) {
            this.event(node, evt, callbacks[evt]);
        }
    },

    createElement(nodeName, attrs) {
        const elem = document.createElement(nodeName);
        const aliases = {
            text: 'innerText',
            html: 'innerHTML',
            class: 'className'
        };

        for (let attr in attrs) {
            let value = attrs[attr];
            if (attr in aliases) {
                attr = aliases[attr];
            }

            if (attr.indexOf('_') == 0) {
                let event = attr.replace('_', '');
                let callback = value;
         
                common.event(elem, event, callback);
                continue;
            }

            elem[attr] = value;
        }

        return elem;
    },

    handleFile({ target }) {
        const file = target.files[0];
        if (!file) return;

        const prev = document.getElementById('poster-prev');
        if (!prev) return;

        const handleFileDelete = (evt) => {
            evt.preventDefault();
            target.value = null;
            prev.innerHTML = '';
        };

        const fr = new FileReader();
        common.events(fr, {
            loadend() {
                const delBtn = common.createElement('a', {
                    text: 'Удалить',
                    class: 'text-danger',
                    href: '#',
                    _click: handleFileDelete
                });

                const prevImg = common.createElement('div', {
                    class: 'poster-prev-img',
                    html: `<img class="img-thumbnail mb-2 d-block" src="${fr.result}" width="300"/>`
                });

                prevImg.append(delBtn);
                prev.append(prevImg);
            },

            error() {
                prev.innerHTML = `<span class="text-danger">Error occurred reading file: ${file.name}</span>`;
            }
        });

        fr.readAsDataURL(file);
    },

    feedback: {
        send(event) {
            common.form(event.target, (data, options, handlers) => {
                return http.api.feedbacks.store(data).then(data => {
                    event.target.reset();
                    handlers.setMessage('Сообщение отправлено!');
                });
            });
        }
    },

    profile: {
        feedbacks: {
            buildItemLayout(item) {
                return `<div class="row">
                    <div class="col">
                        <div class="mb-2 text-muted">Создано: ${item.created_at}</div>
                        <div class="mb-2">${item.name}, ${item.email}, ${item.phone}</div>
                        <div class="text-muted">${item.message}</div>
                    </div>
                </div> <hr />`;
            },

            getList(container) {
                common.fetchList(http.api.feedbacks.getList(), container, {
                    itemCallback: (item) => this.buildItemLayout(item),
                    emptyTpl: '<div class="text-center">Нет сообщений</div>'
                });
            }
        },

        categories: {
            buildItemLayout(item) {
                return `<div class="mb-2 border p-2">
                    <div class="d-flex">
                        <div class="flex-grow-1">${item.name}</div>
                        <div>
                            <a href="/profile/categories/${item.id}/edit" 
                                class="text-muted" 
                                >Редактировать</a>
                            <a href="#" 
                                class="text-danger" 
                                onclick="common.profile.categories.delete(event, ${item.id})">Удалить</a>
                        </div>
                    </div>
                </div>`;
            },

            getList(container) {
                common.fetchList(http.api.categories.getList(), container, {
                    itemCallback: (item) => this.buildItemLayout(item),
                    emptyTpl: '<div class="text-center">Нет категорий</div>'
                });
            },

            store(event) {
                common.form(event.target, (data) => {
                    return http.api.categories.store(data).then(data => {
                        return data;
                    });
                });
            },

            update(event) {
                common.form(event.target, (data, options) => {
                    options.contentType = 'application/json';
                    return http.api.categories.update(data.get('id'), data, options).then(data => {
                        return data;
                    });
                });
            },

            delete(event, id) {
                event.preventDefault();
                if (!confirm('Удалить категорию?')) return;

                http.api.categories.delete(id).then(data => {
                    common.profile.categories.getList(document.getElementById('profile-categories'));
                    // window.location.reload();
                });
            }
        },

        books: {
            buildItemLayout(item) {
                return `<div class="border-bottom py-4">
                    <div class="row">
                        <div class="col-3">
                            <img src="/${item.thumbnail_url}" />
                        </div>
        
                        <div class="col">
                            <div class="text-muted">${item.category.name}</div>
                            <h2 class="flex-grow-1 h4">
                                <a href="/profile/books/${item.id}">${item.title}</a>
                            </h2>
                            <p class="text-muted">${item.short_description}</p>
                            <p class="text-warning">${item.status.name}</p>
                            <p>
                                <a class="text-muted mr-2" href="/profile/books/${item.id}/edit">
                                    Редактировать
                                </a>

                                <a class="text-danger" 
                                    href="/profile/books/${item.id}" 
                                    onclick="common.profile.books.delete(event, ${item.id})">
                                        Удалить
                                </a>
                            </p>
                        </div>
                    </div>
                </div>`;
            },

            getList(container) {
                common.fetchList(http.api.books.getList(), container, {
                    itemCallback: (item) => this.buildItemLayout(item),
                    emptyTpl: '<div class="text-center">Нет добавленных книг</div>'
                });
            },

            store(event) {
                common.form(event.target, (data, options) => {
                    return http.api.books.store(data, options).then(data => {
                        return data;
                    });
                });
            },

            update(event) {
                common.form(event.target, (data, options) => {
                    options.contentType = 'application/json';
                    return http.api.books.update(data.get('id'), data, options).then(data => {
                        return data;
                    });
                });
            },

            delete(event, id) {
                event.preventDefault();
                if (!confirm('Delete book?')) return;

                http.api.books.delete(id).then(data => {
                    window.location.reload();
                });
            }
        },

        settings: {
            getItem(container) {

            },

            store(event) {
                common.form(event.target, (data) => {
                    return http.api.profileSettings.store(data).then(data => {
                        return data;
                    });
                });
            }
        }
    }
};

common.init();