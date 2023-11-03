import { createContext, useContext, useEffect, useState } from "react";
import Form, { useForm, Button, Input } from "../components/Form";
import { useRequest, FetchRequest, getResponse } from "../components/request";
import Card from "../components/Card";
import Page from "../components/Page";
import { Row, Col } from "../components/Layers";
import LogoutBtn from "./components/LogoutBtn";
import BlockAllEvents from "./components/BlockEvents/BlockAllEvents";
import BlockUserEvents from "./components/BlockEvents/BlockUserEvents";
import MainPage from "./components/Pages/Main";
import EventFormPage from "./components/Pages/EventForm";
import EventFormSuccess from "./components/Pages/EventFormSuccess";
import EventItemPage from "./components/Pages/EventItem";
import MemberInfoPage from "./components/Pages/EventItem/MemberInfo";
import ProfileContext from "./contexts/profile";

const components = [
    () => <MainPage />,
    () => <EventFormPage />,
    () => <EventItemPage />,
    () => <EventFormSuccess />,
    () => <MemberInfoPage />,
];

const getUser = () => {
    const request = useRequest({
        method: "GET",
        url: "/api/user",
    });

    return request;
};

const App = (props) => {
    const [pageKey, setPageKey] = useState(0);
    const [additionalData, setAdditionalData] = useState(null);
    const request = getUser();
    const data = getResponse(request, "data");
    const ComponentPage = components[pageKey];

    return (
        <FetchRequest
            request={request}
            Fallback={<>Loading...</>}
            Error={(error) => <>{error.message}</>}
        >
            <ProfileContext.Provider
                value={{ setPageKey, setAdditionalData, data, additionalData }}
            >
                <Page.Wrapper>
                    <Row className="mb-4">
                        <Col col="12">
                            <span className="h4 mr-4">
                                {data?.first_name + " " + data?.last_name}
                            </span>

                            <LogoutBtn />
                        </Col>
                    </Row>

                    <Card>
                        <Card.Body>
                            <Row>
                                <Col col="4" className="border-right">
                                    <BlockAllEvents />
                                    <div className="my-4"></div>
                                    <BlockUserEvents />
                                </Col>

                                <Col col="8">
                                    <ComponentPage {...additionalData} />
                                </Col>
                            </Row>
                        </Card.Body>
                    </Card>
                </Page.Wrapper>
            </ProfileContext.Provider>
        </FetchRequest>
    );
};

const TryEventItemPage = ({ eventId }) => {
    return (
        <RequestLayer
            request={{
                method: "get",
                url: `/api/events/${eventId}`,
            }}
            Loading={() => <>Loading...</>}
            Error={({ error }) => <>{error.message}</>}
            Response={({ response }) => (
                <EventItemPage data={response?.data?.result} />
            )}
        />
    );
};

const EventDeleteBtn = ({ data }) => {
    const request = useRequest({
        method: "DELETE",
        url: `/api/events/${data.id}`,
    });

    const handleClick = () => {
        request.send();
    };

    return (
        <button
            className={
                "btn btn-sm btn-danger" + (request.isSending ? "disabled" : "")
            }
            onClick={handleClick}
        >
            Удалить событие
        </button>
    );
};

const EventLeaveBtn = ({ data }) => {
    const request = useRequest({
        method: "GET",
        url: `/api/events/${data.id}/leave`,
    });

    const handleClick = () => {
        request.send();
    };

    return (
        <button
            className={
                "btn btn-sm btn-primary" + (request.isSending ? "disabled" : "")
            }
            onClick={handleClick}
        >
            Отказаться от участия
        </button>
    );
};

const EventJoinBtn = ({ data }) => {
    const request = useRequest({
        method: "GET",
        url: `/api/events/${data.id}/join`,
    });

    const handleClick = () => {
        request.send();
    };

    return (
        <button
            className={
                "btn btn-sm btn-primary" + (request.isSending ? "disabled" : "")
            }
            onClick={handleClick}
        >
            Принять участие
        </button>
    );
};

const EventBtnsForCreator = ({ data }) => {
    return <EventDeleteBtn data={data} />;
};

const EventBtnsForUser = ({ data }) => {
    return data.is_member ? (
        <EventLeaveBtn data={data} />
    ) : (
        <EventJoinBtn data={data} />
    );
};

export default App;
