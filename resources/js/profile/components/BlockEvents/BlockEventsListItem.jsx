import { useContext } from "react";
import ProfileContext from "../../contexts/profile";

const BlockEventsListItem = ({ item }) => {
    const { setPageKey, additionalData, setAdditionalData } =
        useContext(ProfileContext);

    const handleClick = () => {
        setPageKey(2);
        setAdditionalData({ ...additionalData, currentItem: item });
    };

    return (
        <div
            className="p-2 border-bottom mb-1"
            onClick={handleClick}
            style={{ cursor: "pointer" }}
        >
            <div className="row">
                <div className="col">
                    <div className="">{item.name}</div>
                    <div className="text-muted text-sm">{item.description}</div>
                </div>
            </div>
        </div>
    );
};

export default BlockEventsListItem;
