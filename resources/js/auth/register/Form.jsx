import { useState } from "react";

import Form, {
    useForm,
    Input,
    Checkbox,
    Button,
    Label,
    Feedback,
} from "../../components/Form";

const RegisterForm = (props) => {
    const [isAgreed, setIsAgreed] = useState(0);
    const form = useForm({
        action: "/api/auth/register",
    });

    const handleSubmit = (e) => {
        form.submit(e.target);
    };

    return (
        <Form onSubmit={handleSubmit} disabled={form.isSubmitting}>
            <Form.Message visible={!!form.message} design="warning">
                {form.message}
            </Form.Message>

            <Form.Group>
                <Label htmlFor="last_name" text="Имя" />
                <Input
                    name="first_name"
                    placeholder=""
                    error={form.errors.first_name}
                />
            </Form.Group>

            <Form.Group>
                <Label htmlFor="last_name" text="Фамилия" />
                <Input
                    name="last_name"
                    placeholder=""
                    error={form.errors.last_name}
                />
            </Form.Group>

            <Form.Group>
                <Label htmlFor="last_name" text="Дата рождения" />
                <Input
                    type="date"
                    name="date_of_birth"
                    placeholder="Last Name"
                    error={form.errors.date_of_birth}
                />
            </Form.Group>

            <hr />

            <Form.Group>
                <Label htmlFor="last_name" text="Имя пользователя" />
                <Input
                    name="username"
                    placeholder=""
                    error={form.errors.username}
                />
            </Form.Group>

            <Form.Group>
                <Label htmlFor="last_name" text="Пароль" />
                <Input.Password
                    name="password"
                    placeholder=""
                    error={form.errors.password}
                />
            </Form.Group>

            <Form.Group>
                <Label htmlFor="last_name" text="Повторите пароль" />
                <Input.Password
                    name="password_again"
                    placeholder=""
                    error={form.errors.password_again}
                />
            </Form.Group>

            <Form.Group>
                <Checkbox
                    className="mr-2"
                    id="agreed"
                    name="agreed"
                    checked={isAgreed}
                    onChange={() => setIsAgreed(!isAgreed)}
                />
                <Label htmlFor="agreed" className="d-inline">
                    Я принимаю <a href="#">лицензионное соглашение</a>
                </Label>
                <Feedback>{form.errors.agreed}</Feedback>
            </Form.Group>

            <Form.Group>
                <Button
                    type="submit"
                    design="primary"
                    className="btn-block"
                    disabled={!isAgreed}
                >
                    Зарегистрироваться
                </Button>
            </Form.Group>
        </Form>
    );
};

export default RegisterForm;
