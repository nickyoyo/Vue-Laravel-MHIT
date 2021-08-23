// Page Components
import Home from "./views/pages/Home";
import About from "./views/pages/About";
import Contact from "./views/pages/Contact";
import Help from "./views/pages/Help";

import smallwindow from "./views/test/smallwindow";
import quickButton from "./views/test/quickButton";
import BVTest from "./views/test/BVTest";
import 日程web from "./views/test/日程web";

import ReservePicture from "./views/dropwindow/ReservePicture";

import CM接待自評 from "./views/pages/CM接待自評";
import CMcreate from "./views/pages/CMcreate";
import CMsendSearch from "./views/pages/CMsendSearch";
import CMpage from "./views/pages/CMpage";
import CM日程管理 from "./views/pages/CM日程管理";

import PersonalData from "./views/pages/PersonalData";

export default [
    { path: "/", component: Home, name: 'Home' },
    { path: "/about", component: About, name: 'About' },
    { path: "/contact", component: Contact, name: 'Contact' },
    { path: "/help", component: Help, name: 'Help' },

    { path: "/CM/接待自評", component: CM接待自評, name: 'CM接待自評' },
    { path: "/CM/create", component: CMcreate, name: 'CMcreate' },
    { path: "/CM/sendSearch", component: CMsendSearch, name: 'CMsendSearch' },

    { path: "/CM/page", component: CMpage, name: 'CMpage' },
    { path: "/CM/page/日程管理", component: CM日程管理, name: 'CM日程管理' },

    { path: "/PersonalData", component: PersonalData, name: 'PersonalData' },

    { path: "/smallwindow", component: smallwindow, name: 'smallwindow' },
    { path: "/quickButton", component: quickButton, name: 'quickButton' },
    { path: "/BVTest", component: BVTest, name: 'BVTest' },
    { path: "/日程web", component: 日程web, name: '日程web' },
    { path: "/ReservePicture", component: ReservePicture, name: 'ReservePicture' },
   // { path: "/quickButton", component: quickButton, name: 'quickButton' },
    
];
