let routes= [];
let routes_list= [];

import List from '../pages/doctors/List.vue'
import Form from '../pages/doctors/Form.vue'
import Item from '../pages/doctors/Item.vue'

routes_list = {

    path: '/doctors',
    name: 'doctors.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'doctors.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'doctors.view',
            component: Item,
            props: true,
        }
    ]
};

routes.push(routes_list);

export default routes;

