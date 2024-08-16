let routes= [];
let routes_list= [];

import List from '../pages/patients/List.vue'
import Form from '../pages/patients/Form.vue'
import Item from '../pages/patients/Item.vue'

routes_list = {

    path: '/patients',
    name: 'patients.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'patients.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'patients.view',
            component: Item,
            props: true,
        }
    ]
};

routes.push(routes_list);

export default routes;

