app.notes = {
    create(event) {
        (new app.Form(event.target, {
            resource: 'notes',
            method: 'POST',
        })).submit(event);
    },

    update(event, id) {
        (new app.Form(event.target, {
            resource: `notes/${id}`,
            method: 'PUT',
        })).submit(event);
    },

    delete(event, id) {
        (new app.Form(event.target, {
            resource: `notes/${id}`,
            method: 'DELETE',
        })).submit(event).then(response => {
            this.getList();
        });
    },

    getItem(id) {
        return app.apiHttp.get(`notes/${id}`);   
    },

    getList() {
        return app.apiHttp.get('notes');
    },

    async loadItem() {
        const pathname = (new URL(window.location.href)).pathname;
        if (!/(notes\/[0-9]+\/edit)/.test(pathname)) {
            return;
        } 

        const id = pathname.replace(/(edit|notes|\/+)/g, '');
        const resp = await this.getItem(id)
            .catch(error => {
                console.log('error', error);

                throw error;
            });

        document.querySelector('.created-at').innerText = resp.data?.updated_at;
        document.querySelector('[name=content]').value = resp.data?.content;    
    },

    async loadList() {
        const container = document.getElementById('notes-list');
        if (!container) return;

        const resp = await this.getList()
            .catch(error => {
                console.log('error', error);

                throw error;
            });

        this.showListOnPage(container, resp.data);
    },

    showListOnPage(container, items) {
        container.innerHTML = '';

        if (items?.length) {
            for (let i in items) {
                container.insertAdjacentHTML('BEFOREEND', this.buildListRow(items[i]));
            }
        } else {
            container.innerHTML = 'Список пуст';
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
                            <form onsubmit="app.notes.delete(event, '${item['id']}')">
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
        this.loadItem();
        this.loadList();
    },
};

app.notes.init();