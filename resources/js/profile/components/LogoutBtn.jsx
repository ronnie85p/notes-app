import { useRequest } from "../../components/request";

const getLogoutRequest = () => {
    return useRequest({
        method: "GET",
        url: "/api/auth/logout",
    });
};

const LogoutBtn = (props) => {
    const request = getLogoutRequest();

    const handleClick = () => {
        if (confirm("Подтвердите выход?")) {
            request.send();
        }
    };

    return (
        <a href="#" onClick={handleClick}>
            Выйти
        </a>
    );
};

export default LogoutBtn;
