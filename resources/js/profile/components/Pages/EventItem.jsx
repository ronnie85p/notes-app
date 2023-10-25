import { useContext, useEffect, useState } from "react";
import {
    getResponse,
    useRequest,
    FetchRequest,
} from "../../../components/request";
import ProfileContext from "../../contexts/profile";
import MembersList from "./EventItem/MembersList";
import { Button } from "../../../components/Form";

const getEvent = (id) => {
    return useRequest({
        method: "GET",
        url: `api/events/${id}`,
    });
};

const EventItemPage = (props) => {
    const { additionalData } = useContext(ProfileContext);
    const request = getEvent(additionalData.currentItem.id);
    const { result: data } = getResponse(request, "data");

    useEffect(() => {
        request.send();
    }, [additionalData.currentItem]);
    return (
        <>
            <FetchRequest
                request={request}
                Fallback={<>Loading...</>}
                Error={(error) => <>{error.message}</>}
            >
                <h1 className="h4">{data?.name}</h1>

                <div className="mb-3">
                    <div className="">Описание</div>
                    <div className="text-muted">{data?.description}</div>
                </div>

                <div className="mb-3 text-muted">
                    <div className="">Опубликовано</div>
                    <span className="mr-2">{data?.created_at}</span>
                    <span className="">
                        {data?.user?.first_name + " " + data?.user?.last_name}
                    </span>
                </div>

                <hr />

                <h2 className="h5">Участники</h2>
                <div className="mb-4">
                    <MembersList data={data} />
                </div>

                {data?.is_creator ? (
                    <CreatorBtns data={data} />
                ) : (
                    <AnotherBtns data={data} />
                )}
            </FetchRequest>
        </>
    );
};

const CreatorBtns = (props) => {
    return <DeleteBtn {...props} />;
};

const getEventDelete = (id) => {
    return useRequest({
        method: "DELETE",
        url: `/api/events/${id}`,
    });
};

const DeleteBtn = (props) => {
    const { setPageKey } = useContext(ProfileContext);
    const request = getEventDelete(props.data?.id);
    const handleClick = () => {
        if (
            !confirm(
                "Удалить событие?\n\nУчастники, подписанные на него, автоматически отпишутся.\nДанное действие не обратимо."
            )
        ) {
            return;
        }

        request.send().then((response) => {
            setPageKey(0);
            return response;
        });
    };

    return (
        <>
            <Button
                design="danger"
                onClick={handleClick}
                disabled={request.isSending}
            >
                Удалить
            </Button>
        </>
    );
};

const AnotherBtns = (props) => {
    const { data } = props;
    const [isMember, setIsMember] = useState(data?.is_member);

    return (
        <>
            {isMember ? (
                <LeaveBtn {...props} onSuccess={() => setIsMember(0)} />
            ) : (
                <JoinBtn {...props} onSuccess={() => setIsMember(1)} />
            )}
        </>
    );
};

const getEventLeave = (id) => {
    return useRequest({
        method: "GET",
        url: `/api/events/${id}/leave`,
    });
};

const LeaveBtn = (props) => {
    const { onSuccess } = props;
    const request = getEventLeave(props.data?.id);
    const handleClick = () => {
        request.send().then(onSuccess);
    };

    return (
        <>
            <Button
                design="secondary"
                onClick={handleClick}
                disabled={request.isSending}
            >
                Отказаться от участия
            </Button>
        </>
    );
};

const getEventJoin = (id) => {
    return useRequest({
        method: "GET",
        url: `/api/events/${id}/join`,
    });
};

const JoinBtn = (props) => {
    const { onSuccess } = props;
    const request = getEventJoin(props.data?.id);
    const handleClick = () => {
        request.send().then(onSuccess);
    };

    return (
        <>
            <Button
                design="secondary"
                onClick={handleClick}
                disabled={request.isSending}
            >
                Принять участие
            </Button>
        </>
    );
};

export default EventItemPage;
