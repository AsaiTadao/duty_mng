import Home from "./components/Home";
import OwnAttend from "./components/OwnAttend";
import NotFound from "./components/NotFound";
import UserLayout from "./User/layout/UserLayout";
import AttendStatus from "./components/AttendStatus";
import ManagerLayout from "./Manager/layout/ManagerLayout";
import ManagerAttendStatus from "./Manager/components/ManagerAttendStatus";
import ManagerMonthlySummery from "./Manager/components/ManagerMonthlySummery";
import ManagerShiftCreate from "./Manager/components/ManagerShiftCreate";
import ManagerShiftManage from "./Manager/components/ManagerShiftManage";
import AdminLayout from "./Admin/layout/AdminLayout";
import Master from "./Admin/components/Master";
import WorkTotal from "./Admin/components/WorkTotal";
import AdminSetting from "./Admin/components/AdminSetting";
import OfficeMaster from "./Admin/components/OfficeMaster";
import AreaMaster from "./Admin/components/AreaMaster";
import EmployeeMaster from "./Admin/components/EmployeeMaster";
import TimezoneMaster from "./Admin/components/TimezoneMaster";
import HourlyMaster from "./Admin/components/HourlyMaster";
import VacationMaster from "./Admin/components/VacationMaster";
import ScheduleMaster from "./Admin/components/ScheduleMaster";
import MemberStatus from "./Admin/components/MemberStatus";
import Login from "./Auth/Login";

export default [
    {
        path: "/user",
        component: UserLayout,
        children: [
            {
                path: "",
                name: "user-action-board",
                components: { default: Home },
                icon: "fas fa-clock",
                anchor: "打刻"
            },
            {
                path: "status",
                name: "user-status",
                components: { default: AttendStatus },
                icon: "fas fa-file-alt",
                anchor: "勤怠状況"
            }
        ]
    },
    {
        path: "/manager",
        component: ManagerLayout,
        children: [
            {
                path: "",
                name: "manager-action-board",
                components: { default: Home },
                icon: "fas fa-clock",
                anchor: "打刻"
            },
            {
                path: "status",
                name: "manager-status",
                components: { default: AttendStatus },
                icon: "fas fa-file-alt",
                anchor: "勤怠状況"
            },
            {
                path: "attend-status",
                name: "manager-attend-status",
                components: { default: ManagerAttendStatus },
                icon: "fas fa-history",
                anchor: "出勤状況"
            },
            {
                path: "monthly-summery",
                name: "manager-monthly-summery",
                components: { default: ManagerMonthlySummery },
                icon: "fas fa-plus-square",
                anchor: "月間集計"
            },
            // {
            //     path: "shift-manage",
            //     name: "manager-shift-manage",
            //     components: { default: ManagerShiftManage },
            //     icon: "fas fa-calendar-alt",
            //     anchor: "シフト管理"
            // }
            {
                path: "shift-create",
                name: "manager-shift-create",
                components: { default: ManagerShiftCreate },
                icon: "fas fa-edit",
                anchor: "シフト計画"
            }
        ]
    },
    {
        path: "/admin",
        component: AdminLayout,
        children: [
            {
                path: "action-board",
                name: "admin-action-board",
                components: { default: Home },
                icon: "fas fa-clock",
                anchor: "打刻",
                menu: true
            },
            {
                path: "work-total",
                name: "admin-work-total",
                components: { default: WorkTotal },
                icon: "fas fa-plus-square",
                anchor: "勤務集計",
                menu: true
            },
            {
                path: "master",
                name: "admin-master",
                components: { default: Master },
                icon: "fas fa-network-wired",
                anchor: "マスタ管理",
                menu: true
            },
            {
                path: "setting",
                name: "admin-setting",
                components: { default: AdminSetting },
                icon: "fas fa-cog",
                anchor: "設定管理",
                menu: true
            },
            {
                path: "member/:id",
                name: "admin-member",
                components: { default: MemberStatus },
                icon: "",
                anchor: "勤務集計-個別一覧",
                menu: false
            },
            {
                path: "office-master",
                name: "admin-office-master",
                components: { default: OfficeMaster },
                icon: "",
                anchor: "事業所マスタ",
                menu: false
            },
            {
                path: "area-master",
                name: "admin-area-master",
                components: { default: AreaMaster },
                icon: "",
                anchor: "エリアマスタ",
                menu: false
            },
            {
                path: "employee-master",
                name: "admin-employee-master",
                components: { default: EmployeeMaster },
                icon: "",
                anchor: "社員マスタ",
                menu: false
            },
            {
                path: "timezone-master",
                name: "admin-timezone-master",
                components: { default: TimezoneMaster },
                icon: "",
                anchor: "時間帯マスタ",
                menu: false
            },
            {
                path: "hourly-master",
                name: "admin-hourly-master",
                components: { default: HourlyMaster },
                icon: "",
                anchor: "時給テーブルマスタ",
                menu: false
            },
            {
                path: "vacation-master",
                name: "admin-vacation-master",
                components: { default: VacationMaster },
                icon: "",
                anchor: "休暇マスタ",
                menu: false
            },
            {
                path: "schedule-master",
                name: "admin-schedule-master",
                components: { default: ScheduleMaster },
                icon: "",
                anchor: "所定労働時間マスタ",
                menu: false
            }
        ]
    },
    {
        path: "/login",
        name: "login",
        component: Login
    },
    {
        path: "/",
        name: "home",
        component: Login
    },
    {
        path: "*",
        component: NotFound
    }
];
