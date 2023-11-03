<x-layout title="Обратная связь">

    <div class="row">
        <div class="col-5 m-auto">
            <h2 class="mb-4">Обратная связь</h2>

            <div class="alert alert-warning">
                <p>Отправка писем на почту не происходит по техническим причинам.</p>
                <p>Все письма можно просмотреть в профиле.</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form class="form" id="feedback-form">
                        <div class="alert alert-danger form-message"></div>
                        <div class="alert alert-success form-message" data-type="success"></div>

                        <div class="form-group">
                            <label for="name">Имя<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="email">E-Mail<span class="text-danger">*</span></label>
                            <input type="email_" name="email" id="email" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="message">Сообщение<span class="text-danger">*</span></label>
                            <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Отправить сообщение</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>