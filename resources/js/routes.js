// Page Components
import Home from "./views/pages/Home";


import loader from "./views/test/Loader";

import CM接待自評 from "./views/pages/CM接待自評";
import CMcreate from "./views/pages/CMcreate";
import CMsendSearch from "./views/pages/CMsendSearch";
import CMpage from "./views/pages/CMpage";
import CM日程管理 from "./views/pages/CM日程管理";

import OrdersendSearch from "./views/pages/OrdersendSearch";
import Orderpage from "./views/pages/Orderpage";

import PersonalData from "./views/pages/PersonalData";

export default [
    { path: "/", component: Home, name: 'Home' },

    { path: "/CM/接待自評", component: CM接待自評, name: 'CM接待自評' },
    { path: "/CM/create", component: CMcreate, name: 'CMcreate' },
    { path: "/CM/sendSearch", component: CMsendSearch, name: 'CMsendSearch' },

    { path: "/CM/page", component: CMpage, name: 'CMpage' },
    { path: "/CM/page/日程管理", component: CM日程管理, name: 'CM日程管理' },

    { path: "/Order/sendSearch", component: OrdersendSearch, name: 'OrdersendSearch' },
    { path: "/Order/page", component: Orderpage, name: 'Orderpage' },
    //{ path: "/CM/page/日程管理", component: CM日程管理, name: 'CM日程管理' },

    { path: "/PersonalData", component: PersonalData, name: 'PersonalData' },

    { path: "/loader", component: loader, name: 'loader' },
    
];
