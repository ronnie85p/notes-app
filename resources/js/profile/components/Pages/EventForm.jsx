import { useContext } from "react";
import Form, { Input, Button, useForm } from "../../../components/Form";
import ProfileContext from "../../contexts/profile";

const EventFormPage = (props) => {
    const { setPageKey } = useContext(ProfileContext);
    const form = useForm({
        action: "/api/events",
        onSuccess() {
            setPageKey(3);
        },
    });

    const handleSubmit = (e) => {
        form.submit(e.target);
    };

    return (
        <>
            <h1 className="mb-4 h4">Новое событие</h1>

            <Form
                onSubmit={handleSubmit}
                preventDefault={1}
                disabled={form.isSubmitting}
            >
                <Form.Message visible={!!form.message}>
                    {form.message}
                </Form.Message>

                <Form.Group>
                    <Input
                        name="name"
                        placeholder="Название"
                        error={form.errors.name}
                    />
                </Form.Group>

                <Form.Group>
                    <Input
                        name="description"
                        placeholder="Описание"
                        error={form.errors.description}
                    />
                </Form.Group>

                <hr />

                <Form.Group>
                    <Button type="submit" design="primary">
                        Создать
                    </Button>
                </Form.Group>
            </Form>
        </>
    );
};

export default EventFormPage;
