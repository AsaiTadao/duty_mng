import NotFound from "../pages/NotFound";
import Login from "../pages/Login";
import ChlidrenAttendances from "../pages/ChlidrenAttendances";
import ParentChlidrenAttendances from "../pages/ParentChlidrenAttendances";
import ChildrenDetail from '../pages/ChildrenDetail';
import ChildrenRegistry from '../pages/ChildrenRegistry';
import ChildrenList from '../pages/ChildrenList';
import MailList from '../pages/MailList';
import MailTable from '../pages/MailTable';
import ChildCarePlan from "../pages/ChildcarePlan";
import ChildCareCalendar from "../pages/ChildCareCalendar";
import PresentManagement from "../pages/PresentManagement";
import BroadcastMail from "../pages/BroadcastMail";
import EmergeMail from "../pages/EmergeMail";
import SendMail from "../pages/SendMail";
import ContactBook0 from "../pages/ContactBook0";
import ContactBook1 from "../pages/ContactBook1";
import ContactBook2 from "../pages/ContactBook2";
import ParentContactBook0 from "../pages/ParentContactBook0";
import ParentContactBook1 from "../pages/ParentContactBook1";
import ParentContactBook2 from "../pages/ParentContactBook2";
import ChildcareDiary from "../pages/ChildCareDiary";
import ApplicationTable from "../pages/ApplicationTable";
import BaseLayout from '../layout/BaseLayout';
import ParentBaseLayout from '../layout/ParentBaseLayout';
import { Guards } from "../global/consts";

export default [
    {
        path: "/",
        component: BaseLayout,
        children: [
            {
                path: "",
                name: "children-attendance",
                components: { default: ChlidrenAttendances },
                meta: {
                    icon: "fas fa-school",
                    anchor: "登降園状況",
                    menu: true,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "children-list",
                name: "children-list",
                components: { default: ChildrenList },
                meta: {
                    icon: "fas fa-address-book",
                    anchor: "園児台帳",
                    menu: true,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "children-detail/:id",
                name: "children-detail",
                components: { default: ChildrenDetail },
                meta: {
                    icon: "fas fa-address-book",
                    anchor: "園児台帳",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "children-register",
                name: "children-register",
                components: { default: ChildrenRegistry },
                meta: {
                    icon: "fas fa-address-book",
                    anchor: "園児台帳",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "children-edit/:id",
                name: "children-edit",
                components: { default: ChildrenRegistry },
                meta: {
                    icon: "fas fa-address-book",
                    anchor: "園児台帳",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "mail-list",
                name: "mail-list",
                components: { default: MailList },
                meta: {
                    icon: "far fa-envelope",
                    anchor: "一斉メール",
                    menu: true,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "mail-table",
                name: "mail-table",
                components: { default: MailTable },
                meta: {
                    icon: "far fa-envelope",
                    anchor: "一斉メール",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "childcare-plan",
                name: "childcare-plan",
                components: { default: ChildCarePlan },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "childcare-calendar",
                name: "childcare-calendar",
                components: { default: ChildCareCalendar },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "application-table",
                name: "application-table",
                components: { default: ApplicationTable },
                meta: {
                    icon: "fas fa-plus-square",
                    anchor: "申請用帳票",
                    menu: true,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "present-management",
                name: "present-management",
                components: { default: PresentManagement },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "broadcast-mail",
                name: "broadcast-mail",
                components: { default: BroadcastMail },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "emerge-mail",
                name: "emerge-mail",
                components: { default: EmergeMail },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "send-mail",
                name: "send-mail",
                components: { default: SendMail },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "contact-book0",
                name: "contact-book0",
                components: { default: ContactBook0 },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "contact-book1",
                name: "contact-book1",
                components: { default: ContactBook1 },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "contact-book2",
                name: "contact-book2",
                components: { default: ContactBook2 },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            },
            {
                path: "childcare-diary",
                name: "childcare-diary",
                components: { default: ChildcareDiary },
                meta: {
                    icon: "",
                    anchor: "",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER
                    ]
                }
            }
        ]
    },
    {
        path: "/parent",
        component: ParentBaseLayout,
        children: [
            {
                path: "",
                name: "parent-children-attendance",
                components: { default: ParentChlidrenAttendances },
                meta: {
                    icon: "fas fa-school",
                    anchor: "登降園",
                    menu: true,
                    guards: [
                        Guards.CHILD_MINDER,
                        Guards.PARENT
                    ]
                }
            },
            {
                path: "parent-contact-book0",
                name: "parent-contact-book0",
                components: { default: ParentContactBook0 },
                meta: {
                    icon: "fas fa-file-alt",
                    anchor: "連絡帳",
                    menu: true,
                    guards: [
                        Guards.CHILD_MINDER,
                        Guards.PARENT
                    ]
                }
            },
            {
                path: "parent-contact-book1",
                name: "parent-contact-book1",
                components: { default: ParentContactBook1 },
                meta: {
                    icon: "fas fa-file-alt",
                    anchor: "連絡帳",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER,
                        Guards.PARENT
                    ]
                }
            },
            {
                path: "parent-contact-book2",
                name: "parent-contact-book2",
                components: { default: ParentContactBook2 },
                meta: {
                    icon: "fas fa-file-alt",
                    anchor: "連絡帳",
                    menu: false,
                    guards: [
                        Guards.CHILD_MINDER,
                        Guards.PARENT
                    ]
                }
            }
        ]
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        guards: [
            Guards.CHILD_MINDER,
        ],
    },
    {
        path: "/parent/login",
        name: "login",
        component: Login,
        guards: [
            Guards.PARENT,
        ],
    },
    {
        path: "*",
        component: NotFound,
        guards: [
            Guards.CHILD_MINDER,
            Guards.PARENT
        ],
    }
];
