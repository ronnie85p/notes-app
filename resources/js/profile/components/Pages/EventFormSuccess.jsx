import { useContext } from "react";
import { Button } from "../../../components/Form";
import ProfileContext from "../../contexts/profile";

const EventFormSuccess = (props) => {
    const { setPageKey } = useContext(ProfileContext);

    const handleClickMain = () => {
        setPageKey(0);
    };

    const handleClickMore = () => {
        setPageKey(1);
    };

    return (
        <>
            <div className="text-center mb-2">
                <h4 className="h5 text-success mb-4">Событие создано!</h4>
                <hr />
                <div className="">
                    <Button
                        className="mr-2"
                        design="secondary"
                        onClick={handleClickMore}
                    >
                        Создать еще
                    </Button>

                    <Button
                        className="mr-2"
                        design="secondary"
                        onClick={handleClickMain}
                    >
                        На главную
                    </Button>
                </div>
            </div>
        </>
    );
};

export default EventFormSuccess;
