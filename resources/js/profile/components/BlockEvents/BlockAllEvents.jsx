import {
    getResponse,
    useRequest,
    FetchRequest,
} from "../../../components/request";
import { useEffect } from "react";
import FetchList from "../../../components/FetchList";
import Block from "../Block";
import BlockEventsError from "./BlockEventsError";
import BlockEventsFallback from "./BlockEventsFallback";
import BlockEventsListEmpty from "./BlockEventsListEmpty";
import BlockEventsListItem from "./BlockEventsListItem";

const reloadTimeout = 30000;
const getAllEventsRequest = () => {
    return useRequest({
        method: "GET",
        url: "/api/events",
    });
};

const BlockAllEvents = (props) => {
    const request = getAllEventsRequest();
    const data = getResponse(request, "data");

    useEffect(() => {
        setInterval(() => {
            request.send();
        }, reloadTimeout);
    }, []);

    return (
        <Block title="Все события">
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

export default BlockAllEvents;
