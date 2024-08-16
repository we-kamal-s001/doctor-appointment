let routes= [];
let routes_list= [];

import List from '../pages/appoinments/List.vue'
import Form from '../pages/appoinments/Form.vue'
import Item from '../pages/appoinments/Item.vue'

routes_list = {

    path: '/appoinments',
    name: 'appoinments.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'appoinments.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'appoinments.view',
            component: Item,
            props: true,
        }
    ]
};

routes.push(routes_list);

export default routes;

