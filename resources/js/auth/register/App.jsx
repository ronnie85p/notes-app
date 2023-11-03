import Page from "../../components/Page";
import RegisterForm from "./Form";

const App = () => {
    return (
        <Page.Wrapper>
            <div className="register-page" style={{ minHeight: "569.6px" }}>
                <div className="register-box">
                    <div className="register-logo">Регистрация</div>

                    <div className="card">
                        <div className="card-body register-card-body">
                            <p className="login-box-msg">
                                Регистрация нового пользователя
                            </p>

                            <RegisterForm />

                            <a href="/login" className="text-center">
                                Войти
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </Page.Wrapper>
    );
};

export default App;
