import { useContext } from "react";
import { Row, Col } from "../../../../components/Layers";
import ProfileContext from "../../../contexts/profile";

const MemberInfo = (props) => {
    const { additionalData } = useContext(ProfileContext);
    const { currentEventMember: member } = additionalData || {};

    return (
        <>
            <a href="#" className="text-muted mb-2">
                {member.event.name}
            </a>

            <h1 className="h3">Участник</h1>
            <div className="mb-2">
                {member.user.first_name + " " + member.user.last_name}
            </div>

            <Row>
                <Col col="3">Имя пользователя</Col>
                <Col col="9">{member.user.username}</Col>
            </Row>

            <Row>
                <Col col="3">Дата рождения</Col>
                <Col col="9">
                    {member.user.date_of_birth
                        ? member.user.date_of_birth
                        : "-"}
                </Col>
            </Row>
            <Row>
                <Col col="3">Дата регистрации</Col>
                <Col col="9">{member.user.created_at}</Col>
            </Row>
        </>
    );
};

export default MemberInfo;
