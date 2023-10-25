import { useContext } from "react";
import { Button } from "../../../components/Form";
import ProfileContext from "../../contexts/profile";

const MainPage = (props) => {
    const { setPageKey } = useContext(ProfileContext);
    const handleClick = (e) => {
        setPageKey(1);
    };

    return (
        <>
            <Button design="primary" onClick={handleClick}>
                Создать событие
            </Button>

            <hr />

            <div className="text-muted text-center">Выберите событие</div>
        </>
    );
};

export default MainPage;
