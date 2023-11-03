import Form, {
    useForm,
    Input,
    Checkbox,
    Button,
    Label,
} from "../../components/Form";
import { Row, Col } from "../../components/Layers";

const LoginForm = (props) => {
    const form = useForm({
        action: "/api/auth/login",
    });

    const handleSubmit = (e) => {
        form.submit(e.target);
    };

    return (
        <>
            <Form
                {...props}
                onSubmit={handleSubmit}
                preventDefault={1}
                disabled={form.isSubmitting}
            >
                <Form.Message design="warning" visible={!!form.message}>
                    {form.message}
                </Form.Message>

                <Form.Group>
                    <Input
                        name="username"
                        placeholder="Username"
                        error={form.errors.username}
                    />
                </Form.Group>

                <Form.Group>
                    <Input
                        type="password"
                        name="password"
                        placeholder="Password"
                        error={form.errors.password}
                    />
                </Form.Group>

                <Row>
                    <Col col="8">
                        <Checkbox name="remember" id="remember" />
                        <Label htmlFor="remember" className="ml-2">
                            Запомнить меня
                        </Label>
                    </Col>

                    <Col col="4">
                        <Button
                            type="submit"
                            design="primary"
                            className="btn-block"
                        >
                            Войти
                        </Button>
                    </Col>
                </Row>
            </Form>
        </>
    );
};

export default LoginForm;
