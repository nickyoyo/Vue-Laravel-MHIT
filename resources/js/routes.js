// Page Components
import Home from "./views/pages/Home";
import About from "./views/pages/About";
import Contact from "./views/pages/Contact";
import Help from "./views/pages/Help";

import Login from "./views/layouts/Login";

import CM接待自評 from "./views/pages/CM接待自評";
import CMcreate from "./views/pages/CMcreate";
import CMmodify from "./views/pages/CMmodify";
import CMsearch from "./views/pages/CMsearch";
import CMsendSearch from "./views/pages/CMsendSearch";
import CMpage from "./views/pages/CMpage";

import PersonalData from "./views/pages/PersonalData";

export default [
    { path: "/", component: Home, name: 'Home' },
    { path: "/about", component: About, name: 'About' },
    { path: "/contact", component: Contact, name: 'Contact' },
    { path: "/help", component: Help, name: 'Help' },

    { path: "/CM/接待自評", component: CM接待自評, name: 'CM接待自評' },
    { path: "/CM/create", component: CMcreate, name: 'CMcreate' },
    { path: "/CM/modify", component: CMmodify, name: 'CMmodify' },
    { path: "/CM/sendSearch", component: CMsendSearch, name: 'CMsendSearch' },
    { path: "/CM/search", component: CMsearch, name: 'CMsearch' },

    { path: "/CM/page", component: CMpage, name: 'CMpage' },

    { path: "/PersonalData", component: PersonalData, name: 'PersonalData' },

    { path: "/Login", component: Login, name: 'Login' },

];
