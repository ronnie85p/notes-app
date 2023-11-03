import Card from "../../components/Card";
import Page from "../../components/Page";
import LoginForm from "./Form";

const App = () => {
    return (
        <Page.Wrapper>
            <div className="login-page" style={{ minHeight: "495.6px" }}>
                <div className="login-box">
                    <div className="login-logo">Вход</div>

                    <Card>
                        <Card.Body className="login-card-body">
                            <p className="login-box-msg">
                                Авторизация в системе!
                            </p>

                            <LoginForm />

                            <p className="mb-0">
                                <a href="/register" className="text-center">
                                    Регистрация
                                </a>
                            </p>
                        </Card.Body>
                    </Card>
                </div>
            </div>
        </Page.Wrapper>
    );
};

export default App;
