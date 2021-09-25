import Home from "./components/Home";
import OwnAttend from "./components/OwnAttend";
import NotFound from "./components/NotFound";
import UserLayout from "./User/layout/UserLayout";
import UserStatus from "./User/components/UserStatus";
import ManagerLayout from "./Manager/layout/ManagerLayout";
import ManagerAttendStatus from "./Manager/components/ManagerAttendStatus";
import ManagerMonthlySummery from "./Manager/components/ManagerMonthlySummery";
import ManagerShiftCreate from "./Manager/components/ManagerShiftCreate";
import ManagerShiftManage from "./Manager/components/ManagerShiftManage";
import AdminLayout from "./Admin/layout/AdminLayout";
import Master from "./Admin/components/Master";
import WorkTotal from "./Admin/components/WorkTotal";
import AdminSetting from "./Admin/components/AdminSetting";

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
                components: { default: UserStatus },
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
            {
                path: "shift-manage",
                name: "manager-shift-manage",
                components: { default: ManagerShiftManage },
                icon: "fas fa-calendar-alt",
                anchor: "シフト管理"
            },
            {
                path: "shift-create",
                name: "manager-shift-create",
                components: { default: ManagerShiftCreate },
                icon: "fas fa-edit",
                anchor: "シフト作成"
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
                anchor: "打刻"
            },
            {
                path: "work-total",
                name: "admin-work-total",
                components: { default: WorkTotal },
                icon: "fas fa-plus-square",
                anchor: "勤務集計"
            },
            {
                path: "master",
                name: "admin-master",
                components: { default: Master },
                icon: "fas fa-network-wired",
                anchor: "マスタ管理"
            },
            {
                path: "setting",
                name: "admin-setting",
                components: { default: AdminSetting },
                icon: "fas fa-cog",
                anchor: "設定管理"
            }
        ]
    },
    {
        path: "*",
        component: NotFound
    }
];
