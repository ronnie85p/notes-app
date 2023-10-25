import { useContext, useEffect } from "react";
import {
    FetchRequest,
    useRequest,
    getResponse,
} from "../../../../components/request";
import FetchList from "../../../../components/FetchList";
import ProfileContext from "../../../contexts/profile";

const reloadTimeout = 30000;
const getEventMembers = (evtId) => {
    return useRequest({
        method: "GET",
        url: `/api/events/${evtId}/members`,
    });
};

const MembersList = (props) => {
    if (!props.data) return <></>;
    const request = getEventMembers(props.data.id);
    const { result } = getResponse(request, "data");

    useEffect(() => {
        setInterval(() => {
            request.send();
        }, reloadTimeout);
    }, []);

    return (
        <FetchRequest
            request={request}
            Fallback={<>Loading...</>}
            Error={({ error }) => <>{error.message}</>}
        >
            <FetchList
                list={result}
                Empty={<>Нет данных</>}
                Item={(item, i) => <MemberItem key={i} item={item} />}
            />
        </FetchRequest>
    );
};

const MemberItem = (props) => {
    const { setPageKey, additionalData, setAdditionalData } =
        useContext(ProfileContext);
    const { item } = props;

    const handleClick = () => {
        setAdditionalData({ ...additionalData, currentEventMember: item });
        setPageKey(4);
    };

    return (
        <>
            <div
                className="card mb-2"
                style={{ cursor: "pointer" }}
                onClick={handleClick}
            >
                <div className="card-body p-1">
                    {item.user.first_name + " " + item.user.last_name}
                </div>
            </div>
        </>
    );
};

export default MembersList;
