app.notes = {
    http: {},

    redirectTo(uri = '/') {
        window.location.href = uri;
    },

    setMessage(msg) {
        const el = document.querySelector('#notes-msg');
        if (!el) return;

        if (msg) {
            msg = `<div class="alert alert-danger">${msg}</div>`;
        }

        el.innerHTML = msg;
    },

    setErrors(errs) {
        for (let name in errs) {
            const el = document.querySelector(`[name=${name}]`);
            if (el) {
                el.classList.add('is-invalid');

                el.addEventListener('focus', () => {
                    el.classList.remove('is-invalid');
                }, false)
            }
        }
    },

    setErrorResponse(response) {
        if (!response) return;
        
        const { data } = response;

        this.setMessage(data.message);
        this.setErrors(data.errors);
        
    },

    async create(event) {
        (new app.Form(event.target, {
            url: '/api/v1/notes',
            method: 'POST',
        })).submit(event);

        try {
            const resp = await this.http.post('', data);
            const rdata = resp.data.data;
    
            if (rdata.redirect) {
                this.redirectTo(rdata.redirect)
            }
        } catch (e) {
            this.setErrorResponse(e.response);
        }
    },

    async update(data) {
        try {
            const resp = await this.http.put('', data.get('id'), data);
            const rdata = resp.data.data;
    
            if (rdata.redirect) {
                this.redirectTo(rdata.redirect)
            }
        } catch (e) {
            this.setErrorResponse(e.response);
        }
    },

    async delete(data) {
        try {
            const resp = await this.http.delete('', data.get('id'));

            this.getList();
        } catch (e) {
            console.log('err', e)
        }
    },

    async getList() {
        const container = document.getElementById('notes-list');
        if (!container) return;

        try {
            const resp = await this.http.get('');
            const items = resp.data.data;

            container.innerHTML = '';
    
            if (items?.length) {
                for (let i in items) {
                    container.insertAdjacentHTML('BEFOREEND', this.buildListRow(items[i]));
                }

                const actionForms = document.querySelectorAll('.notes-item-delete');
                for (let form of actionForms) {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();

                        this.delete(new FormData(form));
                    }, false);
                }
            } else {
                container.innerHTML = 'Список пуст';
            }
        } catch (e) {
            console.log('err', e)
        }
    },

    async getItem(container, id) {
        try {
            const resp = await this.http.get(`/${id}`);
            const data = resp.data.data;

            container.querySelector('.created-at').innerText = data.updated_at;
            container.querySelector('[name=content]').value = data.content;
        } catch (e) {
            console.log('err', e)
        }
    },

    buildListRow(item) {
        return `
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <a href="/notes/${item['id']}/edit">
                                ${item['content']}
                            </a>
                        </div>

                        <div class="col text-end">
                            <form class="notes-item-delete">
                                <input type="hidden" name="id" value="${item['id']}">

                                <button class="btn btn-sm btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <small class="text-muted">Создана: ${item['created_at']}</small>
                        </div>
                    </div>
                </div>
            </div>
        `
    },

    init() {
        this.http = new app.Http({
            prefixUri: '/api/v1/notes'
        });

        const typeForms = document.querySelectorAll('#notes-create, #notes-update');
        console.log('typeForms', typeForms)
        for (const form of typeForms) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                this[form.getAttribute('id').replace('notes-', '')](new FormData(e.target));
            }, false);   
        }

        this.getList();

        const editContainer = document.getElementById('notes-edit');
        if (editContainer) {
            this.getItem(editContainer, editContainer.dataset.id);
        }
    }
};

app.notes.init();