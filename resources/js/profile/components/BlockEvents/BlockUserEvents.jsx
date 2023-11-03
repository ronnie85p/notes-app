import { useEffect } from "react";
import {
    getResponse,
    useRequest,
    FetchRequest,
} from "../../../components/request";
import FetchList from "../../../components/FetchList";
import Block from "../Block";
import BlockEventsError from "./BlockEventsError";
import BlockEventsFallback from "./BlockEventsFallback";
import BlockEventsListEmpty from "./BlockEventsListEmpty";
import BlockEventsListItem from "./BlockEventsListItem";

const reloadTimeout = 30000;
const getUserEventsRequest = () => {
    return useRequest({
        method: "GET",
        url: "/api/events/owner",
    });
};

const BlockUserEvents = (props) => {
    const request = getUserEventsRequest();
    const data = getResponse(request, "data");

    useEffect(() => {
        setInterval(() => {
            request.send();
        }, reloadTimeout);
    }, []);

    return (
        <Block title="Мои события">
            <FetchRequest
                request={request}
                Fallback={<BlockEventsFallback />}
                Error={(error) => <BlockEventsError error={error} />}
            >
                <FetchList
                    list={data?.result}
                    Empty={<BlockEventsListEmpty />}
                    Item={(item, i) => (
                        <BlockEventsListItem key={i} item={item} />
                    )}
                />
            </FetchRequest>
        </Block>
    );
};

export default BlockUserEvents;
